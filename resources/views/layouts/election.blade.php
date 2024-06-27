<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("assets/plugins/fontawesome-free/css/all.min.css") }}">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
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
                <h1 class="fw-light">Elections</h1>
                <p class="lead text-muted">Manage the elections for the upcoming voting period. Add new elections to the list, edit existing ones, and view results.</p>
                <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addElectionModal">Add Election</button>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="row row-cols-6 row-cols-sm-2 row-cols-md-3 g-3" id="elections-container">
                  <!-- Election cards will be dynamically added here -->
                </div>
            </div>
        </div>
    </div>
</main>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->


<!-- Modal for adding election -->
<div class="modal fade" id="addElectionModal" tabindex="-1" aria-labelledby="addElectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addElectionModalLabel">Add New Election</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-election-form">
                    <div class="mb-3">
                        <label for="electionName" class="form-label">Election Name</label>
                        <input type="text" class="form-control" id="electionName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="electionDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="electionDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="electionStart" class="form-label">Start Date & Time</label>
                        <input type="datetime-local" class="form-control" id="electionStart" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="electionEnd" class="form-label">End Date & Time</label>
                        <input type="datetime-local" class="form-control" id="electionEnd" name="end" required>
                    </div>
                    <div class="mb-3">
                        <label for="electionCandidates" class="form-label">Candidates</label>
                        <textarea class="form-control" id="electionCandidates" name="candidates" rows="3" placeholder="Enter candidate names separated by commas" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Election</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for viewing election -->
<div class="modal fade" id="viewElectionModal" tabindex="-1" aria-labelledby="viewElectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewElectionModalLabel">View Election</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="view-election-name" class="mt-3"></h5>
                <p id="view-election-description"></p>
                <p><strong>Start Date & Time:</strong> <span id="view-election-start"></span></p>
                <p><strong>End Date & Time:</strong> <span id="view-election-end"></span></p>
                <p><strong>Candidates:</strong></p>
                <ul id="view-election-candidates"></ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing election -->
<div class="modal fade" id="editElectionModal" tabindex="-1" aria-labelledby="editElectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editElectionModalLabel">Edit Election</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-election-form">
                    <input type="hidden" id="edit-election-id">
                    <div class="mb-3">
                        <label for="edit-electionName" class="form-label">Election Name</label>
                        <input type="text" class="form-control" id="edit-electionName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-electionDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="edit-electionDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-electionStart" class="form-label">Start Date & Time</label>
                        <input type="datetime-local" class="form-control" id="edit-electionStart" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-electionEnd" class="form-label">End Date & Time</label>
                        <input type="datetime-local" class="form-control" id="edit-electionEnd" name="end" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-electionCandidates" class="form-label">Candidates</label>
                        <textarea class="form-control" id="edit-electionCandidates" name="candidates" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for deleting election -->
<div class="modal fade" id="deleteElectionModal" tabindex="-1" aria-labelledby="deleteElectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteElectionModalLabel">Delete Election</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this election?</p>
                <input type="hidden" id="delete-election-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-delete-election">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="{{ asset("assets/dist/js/adminlte.min.js") }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const elections = [];

        function renderElections() {
            const container = document.getElementById('elections-container');
            container.innerHTML = '';
            elections.forEach((election, index) => {
                const card = document.createElement('div');
                card.className = 'col';
                card.innerHTML = `
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">${election.name}</h5>
                            <p class="card-text">${election.description}</p>
                            <p class="card-text"><small class="text-muted">Start: ${new Date(election.start).toLocaleString()}</small></p>
                            <p class="card-text"><small class="text-muted">End: ${new Date(election.end).toLocaleString()}</small></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewElectionModal" onclick="viewElection(${index})">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editElectionModal" onclick="editElection(${index})">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteElectionModal" onclick="deleteElection(${index})">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        document.getElementById('add-election-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const name = document.getElementById('electionName').value;
            const description = document.getElementById('electionDescription').value;
            const start = document.getElementById('electionStart').value;
            const end = document.getElementById('electionEnd').value;
            const candidates = document.getElementById('electionCandidates').value.split(',');

            elections.push({ name, description, start, end, candidates });

            renderElections();
            document.getElementById('add-election-form').reset();
            const addElectionModal = document.getElementById('addElectionModal');
            const modalInstance = bootstrap.Modal.getInstance(addElectionModal);
            modalInstance.hide();
        });

        window.viewElection = function(index) {
            const election = elections[index];
            document.getElementById('view-election-name').textContent = election.name;
            document.getElementById('view-election-description').textContent = election.description;
            document.getElementById('view-election-start').textContent = new Date(election.start).toLocaleString();
            document.getElementById('view-election-end').textContent = new Date(election.end).toLocaleString();
            const candidatesList = document.getElementById('view-election-candidates');
            candidatesList.innerHTML = '';
            election.candidates.forEach(candidate => {
                const listItem = document.createElement('li');
                listItem.textContent = candidate;
                candidatesList.appendChild(listItem);
            });
        }

        window.editElection = function(index) {
            const election = elections[index];
            document.getElementById('edit-election-id').value = index;
            document.getElementById('edit-electionName').value = election.name;
            document.getElementById('edit-electionDescription').value = election.description;
            document.getElementById('edit-electionStart').value = election.start;
            document.getElementById('edit-electionEnd').value = election.end;
            document.getElementById('edit-electionCandidates').value = election.candidates.join(',');
        }

        document.getElementById('edit-election-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const index = document.getElementById('edit-election-id').value;
            elections[index].name = document.getElementById('edit-electionName').value;
            elections[index].description = document.getElementById('edit-electionDescription').value;
            elections[index].start = document.getElementById('edit-electionStart').value;
            elections[index].end = document.getElementById('edit-electionEnd').value;
            elections[index].candidates = document.getElementById('edit-electionCandidates').value.split(',');

            renderElections();
            const editElectionModal = document.getElementById('editElectionModal');
            const modalInstance = bootstrap.Modal.getInstance(editElectionModal);
            modalInstance.hide();
        });

        window.deleteElection = function(index) {
            document.getElementById('delete-election-id').value = index;
        }

        document.getElementById('confirm-delete-election').addEventListener('click', function() {
            const index = document.getElementById('delete-election-id').value;
            elections.splice(index, 1);

            renderElections();
            const deleteElectionModal = document.getElementById('deleteElectionModal');
            const modalInstance = bootstrap.Modal.getInstance(deleteElectionModal);
            modalInstance.hide();
        });

        renderElections();
    });
</script>
@include('footer')
</body>
</html>
