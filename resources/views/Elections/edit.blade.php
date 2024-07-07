@extends('layouts.election')

@section('content')
<div>
    <h2 class="mb-4">Edit Election</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('elections.update', $election->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Election Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $election->name }}" required>
                </div>
                <button type="submit" class="btn btn-success">Update Election</button>
                <a href="{{ route('admins') }}" class="btn btn-secondary">Back to Admin</a>
                <a href="{{ route('elections.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
