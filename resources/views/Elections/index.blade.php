@extends('layouts.election')

@section('content')
<div class="container mt-5">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Manage Elections</h2>
        <div>
            <a href="{{ route('admins') }}" class="btn btn-secondary">Back to Admin</a>
            <a href="{{ route('elections.create') }}" class="btn btn-primary">Add Election</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($elections->isEmpty())
        <div class="alert alert-warning" role="alert">
            No elections available.
        </div>
    @else
        <div class="accordion" id="electionsAccordion">
            @foreach($elections as $election)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $election->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $election->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $election->id }}">
                            {{ $election->name }}
                        </button>
                    </h2>
                    <div id="collapse{{ $election->id }}" class="accordion-collapse collapse"
                         aria-labelledby="heading{{ $election->id }}" data-bs-parent="#electionsAccordion">
                        <div class="accordion-body">
                            @if($election->candidates->isEmpty())
                                <p>No candidates for this election.</p>
                            @else
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                    @foreach($election->candidates as $candidate)
                                        <div class="col">
                                            <div class="card shadow-sm">
                                                <img src="{{ $candidate->image_url }}" class="bd-placeholder-img card-img-top"
                                                     width="100%" height="225" alt="{{ $candidate->name }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $candidate->name }}</h5>
                                                    <p class="card-text">{{ $candidate->description }}</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn btn-sm btn-success view-candidate-btn"
                                                                data-bs-toggle="modal" data-bs-target="#viewCandidateModal"
                                                                data-name="{{ $candidate->name }}"
                                                                data-description="{{ $candidate->description }}"
                                                                data-party="{{ $candidate->party }}"
                                                                data-image="{{ $candidate->image_url }}">View</button>
                                                        <button type="button" class="btn btn-sm btn-primary edit-candidate-btn"
                                                                data-bs-toggle="modal" data-bs-target="#editCandidateModal"
                                                                data-id="{{ $candidate->id }}"
                                                                data-name="{{ $candidate->name }}"
                                                                data-description="{{ $candidate->description }}"
                                                                data-party="{{ $candidate->party }}"
                                                                data-image="{{ $candidate->image_url }}">Edit</button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-candidate-btn"
                                                                data-id="{{ $candidate->id }}">Delete</button>
                                                        <small class="text-muted">{{ $candidate->party }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
