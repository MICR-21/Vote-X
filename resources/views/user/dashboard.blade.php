@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ Auth::user()->email }}</h6>
                </div>
            </div>
        </div>
    </div>

    @if(isset($getElections) && count($getElections) > 0)
        <div class="row">
            @foreach ($getElections as $election)
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $election->name }}</h5>
                            <a href="{{ url('admin/candidate/list', $election->id) }}" class="btn btn-primary">View Candidates</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            No elections found.
        </div>
    @endif

    @if(isset($selectedElection))
        <div class="row mt-4">
            <div class="col-12">
                <h4 class="text-center">Candidates for {{ $selectedElection->name }}</h4>
            </div>
            @foreach ($getCandidates as $candidate)
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h5 class="mb-0">{{ $candidate->name }}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img class="img-lg rounded-circle" src="{{ asset($candidate->profile_pic) }}" alt="">
                                </div>
                            </div>
                            <h6 class="text-success font-weight-normal">{{ $candidate->email }}</h6>
                            <a href="{{ url('user/voting/vote', $candidate->id) }}" class="btn btn-primary">Vote</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
