@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    @if(Auth::user()->user_type == 1)
    <div class="row">
        <!-- Summary Cards -->
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Elections</h5>
                    <h3 class="mb-0">{{ $totalElections }}</h3>
                </div>
            </div>
        </div>
        @if(Auth::user()->user_type == 1)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Debug Info</h5>
                            <p>Current Server Time: {{ now() }}</p>
                            <p>Active Elections Count: {{ $activeElections }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Candidates</h5>
                    <h3 class="mb-0">{{ $totalCandidates }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Votes</h5>
                    <h3 class="mb-0">{{ $totalVotes }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Election Status Pie Chart -->
        <div class="col-xl-6 col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Election Status</h5>
                    <canvas id="electionStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Voter Turnout Line Chart -->
        <div class="col-xl-6 col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Voter Turnout Over Time</h5>
                    <canvas id="voterTurnoutChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Elections Table with Winner -->
        <div class="col-xl-12 col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Elections</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Election Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total Votes</th>
                                    <th>Winner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentElections as $election)
                                <tr>
                                    <td style="color:white;">{{ $election->name }}</td>
                                    <td style="color:white;">{{ $election->start_date }}</td>
                                    <td style="color:white;">{{ $election->end_date }}</td>
                                    <td style="color:white;">{{ $election->total_votes }}</td>
                                    <td style="color:white;">{{ $election->winner ? $election->winner->name : 'Not yet determined' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Top Candidates Bar Chart -->
        <div class="col-xl-12 col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top Candidates (Across All Elections)</h5>
                    <canvas id="topCandidatesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Election Status Pie Chart
    var ctxStatus = document.getElementById('electionStatusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'pie',
        data: {
            labels: ['Active', 'Upcoming', 'Completed'],
            datasets: [{
                data: [{{ $activeElections }}, {{ $upcomingElections }}, {{ $completedElections }}],
                backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Voter Turnout Line Chart
    var ctxTurnout = document.getElementById('voterTurnoutChart').getContext('2d');
    new Chart(ctxTurnout, {
        type: 'line',
        data: {
            labels: {!! json_encode($voterTurnoutData->pluck('date')) !!},
            datasets: [{
                label: 'Voter Turnout',
                data: {!! json_encode($voterTurnoutData->pluck('turnout')) !!},
                borderColor: '#4BC0C0',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Top Candidates Bar Chart
    var ctxCandidates = document.getElementById('topCandidatesChart').getContext('2d');
    new Chart(ctxCandidates, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topCandidates->pluck('name')) !!},
            datasets: [{
                label: 'Total Votes',
                data: {!! json_encode($topCandidates->pluck('total_votes')) !!},
                backgroundColor: '#FF9F40'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
