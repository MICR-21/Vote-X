@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Confirm Your Vote</h2>
                        @include('message')

                        <div class="text-center mb-4">
                            <img class="img-lg rounded-circle"
                                 src="{{ $getRecord->profile_pic ? asset($getRecord->profile_pic) : asset('images/happy.png') }}"
                                 alt="{{ $getRecord->name }}">
                        </div>

                        <h3 class="text-center mb-4">{{ $getRecord->name }}</h3>

                        <form class="forms-sample" id="voteForm">
                            {{ csrf_field() }}
                            <input type="hidden" id="candidate_id" value="{{ $getRecord->id }}">
                            <input type="hidden" id="voter_id" value="{{ Auth::user()->voter_id }}">
                            <input type="hidden" id="election" value="{{ $getRecord->election }}">

                            <div class="alert alert-info" role="alert">
                                <strong>Election:</strong> {{ $getRecord->election }}<br>
                                <strong>Candidate:</strong> {{ $getRecord->name }}<br>
                                <strong>Your Voter ID:</strong> {{ Auth::user()->voter_id }}
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-primary btn-lg" onclick="confirmVote()">Confirm Vote</button>
                                <a href="{{ url('admin/user/list') }}" class="btn btn-dark btn-lg ml-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>
    <script>
        async function confirmVote() {
            const candidateId = document.getElementById('candidate_id').value;
            const voterId = document.getElementById('voter_id').value;
            const election = document.getElementById('election').value;

            if (window.ethereum) {
                window.web3 = new Web3(window.ethereum);
                await window.ethereum.enable();
                const accounts = await web3.eth.getAccounts();
                const account = accounts[0];
                const contractAddress = '{{ $contractAddress }}';
                const abi = {!! $abi !!};
                const contract = new web3.eth.Contract(abi, contractAddress);

                contract.methods.vote(candidateId).send({ from: account, gas: 2000000 })
                    .on('transactionHash', function(hash) {
                        alert('Vote cast successfully. Transaction hash: ' + hash);
                        window.location.href = '{{ url('admin/user/list') }}';
                    })
                    .on('error', function(error) {
                        alert('Error casting vote: ' + error.message);
                    });
            } else {
                alert('Please install MetaMask to cast your vote.');
            }
        }
    </script>
@endsection
