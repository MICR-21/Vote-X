@extends('layouts.election')

@section('content')
<div class="container">
    <h2>Add Election</h2>
    <form action="{{ route('elections.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Election Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group">
            <label for="candidates">Candidates</label>
            <div id="candidates">
                <div class="candidate">
                    <input type="text" name="candidates[0][name]" class="form-control" placeholder="Candidate Name" required>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addCandidate()">Add Another Candidate</button>
        </div>
        <button type="submit" class="btn btn-primary">Create Election</button>
        <a href="{{ route('admins') }}" class="btn btn-secondary">Back to Admin</a>
    </form>
</div>

<script>
    let candidateCount = 1;
    function addCandidate() {
        const candidatesDiv = document.getElementById('candidates');
        const newCandidate = document.createElement('div');
        newCandidate.classList.add('candidate');
        newCandidate.innerHTML = `<input type="text" name="candidates[${candidateCount}][name]" class="form-control" placeholder="Candidate Name" required>`;
        candidatesDiv.appendChild(newCandidate);
        candidateCount++;
    }
</script>
@endsection
