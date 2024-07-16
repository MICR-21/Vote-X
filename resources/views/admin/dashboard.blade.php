@extends('layouts.app')

@section('content')
    <!-- Debug information -->
    <div style="background-color: #db1e1e; padding: 10px; margin-bottom: 20px;">
        <h3>Debug Information:</h3>
        <p>Contract Address: {{ $contractAddress ?? 'Not set' }}</p>
        <p>ABI: {{ isset($abi) && is_array($abi) ? 'Set (' . count($abi) . ' items)' : 'Not set or invalid' }}</p>
    </div>
    <div class="content-wrapper">
        @if (Auth::check() && Auth::user()->user_type == 1)
            <div class="row">
                <!-- Summary Cards -->
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Elections</h5>
                            <h3 class="mb-0">{{ $totalElections ?? 'N/A' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Candidates</h5>
                            <h3 class="mb-0">{{ $totalCandidates ?? 'N/A' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Votes</h5>
                            <h3 class="mb-0" id="totalVotes">Loading...</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Winner</h5>
                            <h3 class="mb-0" id="winner">
                                @if (isset($winner) && $winner !== null)
                                    {{ $winner['name'] }} (ID: {{ $winner['id'] }}) with {{ $winner['voteCount'] }} votes
                                @else
                                    No winner determined
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>
    <script>
        async function fetchElectionData() {
            if (window.ethereum) {
                window.web3 = new Web3(window.ethereum);
                await window.ethereum.enable();

                const contractAddress = '{{ $contractAddress ?? 'undefined' }}';
                if (contractAddress === "undefined") {
                    console.error("Contract address is not set");
                    document.getElementById('errorMessage').innerText =
                        "Error: Contract address is not set. Please check your configuration.";
                    return;
                }

                const abi = {!! !empty($abi) ? json_encode($abi) : '[]' !!};
                if (abi.length === 0) {
                    console.error("ABI is not set or empty");
                    document.getElementById('errorMessage').innerText += " ABI is not set or empty.";
                    return;
                }

                const contract = new web3.eth.Contract(abi, contractAddress);

                // Add your logic here to interact with the contract and update the UI
                // For example:
                try {
                    const totalVotes = await contract.methods.totalVotes().call();
                    document.getElementById('totalVotes').innerText = totalVotes;

                    const winner = await contract.methods.winner().call();
                    document.getElementById('winner').innerText = `${winner.name} (ID: ${winner.id}) with ${winner.voteCount} votes`;
                } catch (error) {
                    console.error("Error fetching election data", error);
                }
            } else {
                alert('Please install MetaMask to view election data.');
            }
        }

        window.onload = fetchElectionData;
    </script>
@endsection
