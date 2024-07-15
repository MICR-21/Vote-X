<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateModel;
use App\Models\ElectionModel;
use App\Models\VotesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ElectionController extends Controller
{
    protected $smartContractController;

    public function __construct(SmartContractController $smartContractController)
    {
        $this->smartContractController = $smartContractController;
    }

    public function confirmVote($candidateId)
    {
        $candidate = CandidateModel::findOrFail($candidateId);
        return view('confirm_vote', compact('candidate'));
    }

    public function castVote(Request $request)
    {
        $validated = $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'voter_id' => 'required|exists:users,id',
            'election' => 'required|exists:elections,id',
        ]);

        try {
            // Check if user has already voted
            if (VotesModel::where('voter_id', $validated['voter_id'])
                    ->where('election', $validated['election'])
                    ->exists()) {
                return redirect()->back()->with('error', 'You have already voted in this election.');
            }

            VotesModel::create($validated);

            return redirect()->route('dashboard')->with('success', 'Vote cast successfully!');
        } catch (\Exception $e) {
            Log::error('Error casting vote: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while casting your vote. Please try again.');
        }
    }

    public function dashboard(Request $request)
{
    try {
        $now = Carbon::now();

        $data = [
            'totalElections' => ElectionModel::count(),
            'totalCandidates' => CandidateModel::count(),
            'totalVotes' => VotesModel::count(),
            'recentElections' => ElectionModel::orderBy('created_at', 'desc')->take(5)->get(),
            'activeElections' => ElectionModel::where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->where('is_delete', 0)
                ->count(),
            'upcomingElections' => ElectionModel::where('start_date', '>', $now)
                ->where('is_delete', 0)
                ->count(),
            'completedElections' => ElectionModel::where('end_date', '<', $now)
                ->where('is_delete', 0)
                ->count(),
            'topCandidates' => CandidateModel::withCount('votes')
                ->orderBy('votes_count', 'desc')
                ->take(5)
                ->get(),
        ];

        $latestCompletedElection = ElectionModel::where('end_date', '<', $now)
            ->where('is_delete', 0)
            ->orderBy('end_date', 'desc')
            ->first();

            if ($latestCompletedElection) {
                try {
                    $data['winner'] = $this->smartContractController->determineWinner($latestCompletedElection->id);
                } catch (\Exception $e) {
                    Log::error('Error getting winner from smart contract: ' . $e->getMessage());
                    $data['winner'] = null; // or handle it as needed
                }
            } else {
                $data['winner'] = null;
            }
        return view('admin.dashboard', $data);
    } catch (\Exception $e) {
        Log::error('Error in dashboard method: ' . $e->getMessage());
        return view('admin.dashboard')->with('error', 'An error occurred while loading the dashboard.');
    }
}


}
