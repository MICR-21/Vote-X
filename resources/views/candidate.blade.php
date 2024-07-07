<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Candidates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("assets/plugins/fontawesome-free/css/all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/dist/css/adminlte.min.css") }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .modal-body img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    @include('navbar')
    @include('sidebar')

    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Candidates</h1>
                    <p class="lead text-muted">Manage the candidates for the upcoming elections. Add new candidates, edit existing ones, and view their details.</p>
                    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addCandidateModal">Add Candidate</button>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="row row-cols-1 row-cols-md-2 g-4" id="candidates-container">
                        @foreach($candidates as $candidate)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <img src="{{ $candidate->image }}" class="card-img-top" alt="Candidate Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $candidate->name }}</h5>
                                        <p class="card-text">{{ $candidate->description }}</p>
                                        <p class="card-text"><small class="text-muted">Party: {{ $candidate->party }}</small></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewCandidateModal" data-id="{{ $candidate->id }}">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editCandidateModal" data-id="{{ $candidate->id }}">Edit</button>
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteCandidateModal" data-id="{{ $candidate->id }}">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Candidate Modal -->
<div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCandidateModalLabel">Add Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="election_id" class="form-label">Election</label>
                        <select class="form-control" id="election_id" name="election_id" required>
                            <option value="">Select an Election</option>
                            @foreach ($elections as $election)
                                <option value="{{ $election->id }}">{{ $election->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Form Fields -->
                    <div class="mb-3">
                        <label for="candidateName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="candidateName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="candidateDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="candidateDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="candidateParty" class="form-label">Party</label>
                        <input type="text" class="form-control" id="candidateParty" name="party" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image Source</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="imageSource" id="imageFileRadio" value="file" checked>
                            <label class="form-check-label" for="imageFileRadio">Upload Image File</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="imageSource" id="imageURLRadio" value="url">
                            <label class="form-check-label" for="imageURLRadio">Image URL</label>
                        </div>
                    </div>
                    <div class="mb-3" id="imageFileInput">
                        <label for="candidateImageFile" class="form-label">Upload Image File</label>
                        <input type="file" class="form-control" id="candidateImageFile" name="image_file" accept="image/png, image/jpeg">
                    </div>
                    <div class="mb-3" id="imageURLInput" style="display: none;">
                        <label for="candidateImageURL" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="candidateImageURL" name="image_url">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Candidate</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- View Candidate Modal -->
    <div class="modal fade" id="viewCandidateModal" tabindex="-1" aria-labelledby="viewCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCandidateModalLabel">View Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="view-candidate-image" src="" class="img-fluid mb-4" alt="Candidate Image">
                    <h4 id="view-candidate-name"></h4>
                    <p id="view-candidate-description"></p>
                    <p><strong>Party:</strong> <span id="view-candidate-party"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Candidate Modal -->
    <div class="modal fade" id="editCandidateModal" tabindex="-1" aria-labelledby="editCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('candidates.update', ':id') }}" id="edit-candidate-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCandidateModalLabel">Edit Candidate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-candidate-id" name="id">
                        <div class="mb-3">
                            <label for="edit_election_id" class="form-label">Election</label>
                            <select class="form-control" id="edit_election_id" name="election_id" required>
                                @foreach ($elections as $election)
                                    <option value="{{ $election->id }}">{{ $election->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Other form fields -->
                        <div class="mb-3">
                            <label for="edit-candidateName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-candidateName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-candidateDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-candidateDescription" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-candidateParty" class="form-label">Party</label>
                            <input type="text" class="form-control" id="edit-candidateParty" name="party" required>
                        </div>
                        <!-- Image fields -->
                        <div class="mb-3">
                            <label class="form-label">Image Source</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imageSource" id="editImageFileRadio" value="file">
                                <label class="form-check-label" for="editImageFileRadio">Upload Image File</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imageSource" id="editImageURLRadio" value="url">
                                <label class="form-check-label" for="editImageURLRadio">Image URL</label>
                            </div>
                        </div>
                        <div class="mb-3" id="editImageFileInput">
                            <label for="edit-candidateImageFile" class="form-label">Upload Image File</label>
                            <input type="file" class="form-control" id="edit-candidateImageFile" name="image_file" accept="image/png, image/jpeg">
                        </div>
                        <div class="mb-3" id="editImageURLInput" style="display: none;">
                            <label for="edit-candidateImageURL" class="form-label">Image URL</label>
                            <input type="text" class="form-control" id="edit-candidateImageURL" name="image_url">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Candidate Modal -->
    <div class="modal fade" id="deleteCandidateModal" tabindex="-1" aria-labelledby="deleteCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCandidateModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this candidate?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('candidates.destroy', 0) }}" id="delete-candidate-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset("assets/dist/js/adminlte.min.js") }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle switching image source inputs for add modal
            document.querySelectorAll('input[name="imageSource"]').forEach(input => {
                input.addEventListener('change', function() {
                    document.getElementById('imageFileInput').style.display = this.value === 'file' ? 'block' : 'none';
                    document.getElementById('imageURLInput').style.display = this.value === 'url' ? 'block' : 'none';
                });
            });

            // Handle switching image source inputs for edit modal
            document.querySelectorAll('input[name="imageSource"]').forEach(input => {
                input.addEventListener('change', function() {
                    document.getElementById('editImageFileInput').style.display = this.value === 'file' ? 'block' : 'none';
                    document.getElementById('editImageURLInput').style.display = this.value === 'url' ? 'block' : 'none';
                });
            });

            // Handle passing data to view and edit modals
            var viewCandidateModal = document.getElementById('viewCandidateModal');
            viewCandidateModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                fetch(`/candidates/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('view-candidate-image').src = data.image;
                        document.getElementById('view-candidate-name').textContent = data.name;
                        document.getElementById('view-candidate-description').textContent = data.description;
                        document.getElementById('view-candidate-party').textContent = data.party;
                    });
            });

            var editCandidateModal = document.getElementById('editCandidateModal');
            editCandidateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var form = this.querySelector('#edit-candidate-form');
            form.action = form.action.replace(':id', id);

            fetch(`/candidates/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-candidate-id').value = data.id;
                    document.getElementById('edit_election_id').value = data.election_id;
                    document.getElementById('edit-candidateName').value = data.name;
                    document.getElementById('edit-candidateDescription').value = data.description;
                    document.getElementById('edit-candidateParty').value = data.party;
                    document.getElementById('editImageFileInput').style.display = 'block';
                    document.getElementById('editImageURLInput').style.display = 'none';
                    document.getElementById('editImageFileRadio').checked = true;
                });
            });

    });


    </script>
</body>
</html>
