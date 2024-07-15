<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

class SmartContractController extends Controller
{
    private $web3;
    private $contract;
    private $accountAddress;

    public function __construct()
    {
        $provider = new HttpProvider(new HttpRequestManager(env('ETHEREUM_NODE_URL'), 10));
        $this->web3 = new Web3($provider);

        $contractAddress = env('CONTRACT_ADDRESS');
        Log::debug('Contract Address: ' . $contractAddress);

        $abiPath = base_path('build\contracts\Election.json');
        Log::debug('ABI Path: ' . $abiPath);

        if (!file_exists($abiPath)) {
            Log::error('ABI file does not exist');
            throw new \Exception('ABI file not found');
        }

        $abiJson = file_get_contents($abiPath);
        $abi = json_decode($abiJson, true)['abi'];

        if (is_null($abi)) {
            Log::error('Failed to decode ABI JSON');
            throw new \Exception('Invalid ABI JSON');
        }

        $this->contract = new Contract($this->web3->provider, $abi);

        if (empty($contractAddress)) {
            Log::error('Contract address is empty');
            throw new \Exception('Contract address not set');
        }

        $this->contract->at($contractAddress);

        $this->accountAddress = env('ACCOUNT_ADDRESS');
        Log::debug('Account Address: ' . $this->accountAddress);
    }

    public function getContractAddress()
    {
        return $this->contract->address;
    }

    public function getAbi()
    {
        return $this->contract->abi;
    }

    public function getCandidates()
    {
        try {
            $candidatesCount = 0;
            $this->contract->call('candidatesCount', function($err, $result) use (&$candidatesCount) {
                if ($err !== null) {
                    throw new \Exception('Error calling candidatesCount: ' . $err->getMessage());
                }
                $candidatesCount = (int)$result[0]->toString();
            });

            $candidates = [];
            for ($i = 1; $i <= $candidatesCount; $i++) {
                $this->contract->call('candidates', $i, function($err, $result) use (&$candidates, $i) {
                    if ($err !== null) {
                        throw new \Exception('Error calling candidates: ' . $err->getMessage());
                    }
                    $candidates[$i] = $result;
                });
            }

            return view('elections.candidates', compact('candidates'));
        } catch (\Exception $e) {
            Log::error('Error fetching candidates: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function vote(Request $request)
    {
        try {
            $transaction = null;
            $this->contract->send('vote', $request->candidate_id, [
                'from' => $this->accountAddress,
                'gas' => '2000000'
            ], function($err, $result) use (&$transaction) {
                if ($err !== null) {
                    throw new \Exception('Error sending vote: ' . $err->getMessage());
                }
                $transaction = $result;
            });

            $receipt = null;
            $this->web3->eth->getTransactionReceipt($transaction, function($err, $result) use (&$receipt) {
                if ($err !== null) {
                    throw new \Exception('Error getting transaction receipt: ' . $err->getMessage());
                }
                $receipt = $result;
            });

            return view('elections.vote', compact('transaction', 'receipt'));
        } catch (\Exception $e) {
            Log::error('Error sending vote: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function determineWinner($electionId)
{
    try {
        Log::debug("Attempting to determine winner for election ID: " . $electionId);

        // Get the number of candidates
        $candidatesCount = 0;
        $this->contract->call('candidatesCount', function($err, $result) use (&$candidatesCount) {
            if ($err !== null) {
                throw new \Exception('Error calling candidatesCount: ' . $err->getMessage());
            }
            $candidatesCount = (int)$result[0]->toString();
        });

        Log::debug("Number of candidates: " . $candidatesCount);

        // Get all candidates and their vote counts
        $candidates = [];
        for ($i = 1; $i <= $candidatesCount; $i++) {
            $this->contract->call('candidates', $i, function($err, $result) use (&$candidates, $i) {
                if ($err !== null) {
                    throw new \Exception('Error calling candidates: ' . $err->getMessage());
                }
                $candidates[$i] = [
                    'id' => $result['id']->toString(),
                    'name' => $result['name'],
                    'voteCount' => $result['voteCount']->toString()
                ];
            });
        }

        Log::debug("Candidates data: " . json_encode($candidates));

        // Determine the winner
        $winner = null;
        $maxVotes = 0;
        foreach ($candidates as $candidate) {
            if ((int)$candidate['voteCount'] > $maxVotes) {
                $winner = $candidate;
                $maxVotes = (int)$candidate['voteCount'];
            }
        }

        Log::debug("Winner determined: " . json_encode($winner));
        return $winner;
    } catch (\Exception $e) {
        Log::error('Error determining winner: ' . $e->getMessage());
        throw $e;
    }
    }
}
