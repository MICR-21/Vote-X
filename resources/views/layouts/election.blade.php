<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Elections</title>
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
                    <p class="lead text-muted">Manage the elections for the upcoming voting period.</p>
                    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addElectionModal">Add Election</button>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="row row-cols-1 row-cols-md-2 g-4" id="elections-container">
                        <!-- Elections will be rendered dynamically here -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Election Modal -->
    <div class="modal fade" id="addElectionModal" tabindex="-1" aria-labelledby="addElectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="add-election-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addElectionModalLabel">Add Election</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="electionName" class="form-label">Election Name</label>
                            <input type="text" class="form-control" id="electionName" required>
                        </div>
                        <div class="mb-3">
                            <label for="electionStart" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="electionStart" required>
                        </div>
                        <div class="mb-3">
                            <label for="electionEnd" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" id="electionEnd" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Election</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Election Modal -->
    <div class="modal fade" id="editElectionModal" tabindex="-1" aria-labelledby="editElectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="edit-election-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editElectionModalLabel">Edit Election</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-election-id">
                        <div class="mb-3">
                            <label for="edit-electionName" class="form-label">Election Name</label>
                            <input type="text" class="form-control" id="edit-electionName" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-electionStart" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="edit-electionStart" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-electionEnd" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" id="edit-electionEnd" required>
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

    <!-- Delete Election Modal -->
    <div class="modal fade" id="deleteElectionModal" tabindex="-1" aria-labelledby="deleteElectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteElectionModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this election?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="delete-election-id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-election">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
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
                                <p class="card-text"><small class="text-muted">Start: ${new Date(election.start).toLocaleString()}</small></p>
                                <p class="card-text"><small class="text-muted">End: ${new Date(election.end).toLocaleString()}</small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
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
                const start = document.getElementById('electionStart').value;
                const end = document.getElementById('electionEnd').value;

                fetch('/elections', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ name, start, end })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        elections.push(data.election);
                        renderElections();
                        document.getElementById('add-election-form').reset();
                        const addElectionModal = document.getElementById('addElectionModal');
                        const modalInstance = bootstrap.Modal.getInstance(addElectionModal);
                        modalInstance.hide();
                    } else {
                        alert('Failed to add election. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });

            window.editElection = function(index) {
                const election = elections[index];
                document.getElementById('edit-election-id').value = election.id;
                document.getElementById('edit-electionName').value = election.name;
                document.getElementById('edit-electionStart').value = election.start.slice(0, 16);
                document.getElementById('edit-electionEnd').value = election.end.slice(0, 16);
            }

            document.getElementById('edit-election-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const id = document.getElementById('edit-election-id').value;
                const name = document.getElementById('edit-electionName').value;
                const start = document.getElementById('edit-electionStart').value;
                const end = document.getElementById('edit-electionEnd').value;

                fetch(`/elections/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ name, start, end })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const index = elections.findIndex(e => e.id === data.election.id);
                        elections[index] = data.election;
                        renderElections();
                        const editElectionModal = document.getElementById('editElectionModal');
                        const modalInstance = bootstrap.Modal.getInstance(editElectionModal);
                        modalInstance.hide();
                    } else {
                        alert('Failed to update election. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });

            window.deleteElection = function(index) {
                const election = elections[index];
                document.getElementById('delete-election-id').value = election.id;
            }

            document.getElementById('confirm-delete-election').addEventListener('click', function() {
                const id = document.getElementById('delete-election-id').value;

                fetch(`/elections/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const index = elections.findIndex(e => e.id === parseInt(id));
                        elections.splice(index, 1);
                        renderElections();
                        const deleteElectionModal = document.getElementById('deleteElectionModal');
                        const modalInstance = bootstrap.Modal.getInstance(deleteElectionModal);
                        modalInstance.hide();
                    } else {
                        alert('Failed to delete election. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });

            // Initial load of elections
            fetch('/elections')
                .then(response => response.json())
                .then(data => {
                    elections.push(...data);
                    renderElections();
                });
        });
    </script>
</body>
</html>
