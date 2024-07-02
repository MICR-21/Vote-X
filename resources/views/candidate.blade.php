<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates Management</title>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
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
        .card-img-top {
            object-fit: cover;
        }
        .card-body {
            text-align: center;
        }
        footer a {
            color: #7952b3;
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
                    <p class="lead text-muted">Manage the candidates for the upcoming election. Add new candidates to the list.</p>
                    <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addCandidateModal">Add Candidate</button>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="candidates-container">
                        <!-- Candidate cards will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>

    <!-- Modal for adding candidate -->
    <div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCandidateModalLabel">Add New Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-candidate-form">
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
                                <input class="form-check-input" type="radio" name="imageSource" id="addImageFileRadio" value="file" checked>
                                <label class="form-check-label" for="addImageFileRadio">
                                    Upload Image File
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imageSource" id="addImageURLRadio" value="url">
                                <label class="form-check-label" for="addImageURLRadio">
                                    Image URL
                                </label>
                            </div>
                        </div>
                        <div class="mb-3" id="addImageFileInput">
                            <label for="candidateImageFile" class="form-label">Upload Image File</label>
                            <input type="file" class="form-control" id="candidateImageFile" name="image_file" accept="image/png, image/jpeg">
                        </div>
                        <div class="mb-3" id="addImageURLInput" style="display: none;">
                            <label for="candidateImageURL" class="form-label">Image URL</label>
                            <input type="text" class="form-control" id="candidateImageURL" name="image_url">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Candidate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for viewing candidate -->
    <div class="modal fade" id="viewCandidateModal" tabindex="-1" aria-labelledby="viewCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCandidateModalLabel">View Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="view-candidate-image" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="">
                    <h5 id="view-candidate-name" class="mt-3"></h5>
                    <p id="view-candidate-description"></p>
                    <p><strong>Party:</strong> <span id="view-candidate-party"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing candidate -->
    <div class="modal fade" id="editCandidateModal" tabindex="-1" aria-labelledby="editCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCandidateModalLabel">Edit Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-candidate-form">
                        <input type="hidden" id="edit-candidate-id">
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
                        <div class="mb-3">
                            <label class="form-label">Image Source</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="editImageSource" id="editImageFileRadio" value="file" checked>
                                <label class="form-check-label" for="editImageFileRadio">
                                    Upload Image File
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="editImageSource" id="editImageURLRadio" value="url">
                                <label class="form-check-label" for="editImageURLRadio">
                                    Image URL
                                </label>
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
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Sample data
        const candidates = [
            {
                id: 1,
                name: 'John Doe',
                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                party: 'Party A',
                image_url: 'https://via.placeholder.com/150'
            },
            {
                id: 2,
                name: 'Jane Smith',
                description: 'Pellentesque ac bibendum tortor. Integer pharetra mi nec elit fermentum.',
                party: 'Party B',
                image_url: 'https://via.placeholder.com/150'
            }
        ];

        // Function to render candidates
        function renderCandidates() {
            const container = $('#candidates-container');
            container.empty();

            candidates.forEach(candidate => {
                const card = `
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="${candidate.image_url}" class="card-img-top" width="100%" height="225" alt="Candidate Image">
                            <div class="card-body">
                                <h5 class="card-title">${candidate.name}</h5>
                                <p class="card-text">${candidate.description}</p>
                                <p class="card-text"><small class="text-muted">${candidate.party}</small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary btn-sm view-candidate" data-id="${candidate.id}">View</button>
                                    <button class="btn btn-secondary btn-sm edit-candidate" data-id="${candidate.id}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-candidate" data-id="${candidate.id}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.append(card);
            });
        }

        $(document).ready(function() {
            renderCandidates();

            // Toggle image input fields based on selection
            $('input[name="imageSource"]').change(function() {
                if (this.value === 'file') {
                    $('#addImageFileInput').show();
                    $('#addImageURLInput').hide();
                } else {
                    $('#addImageFileInput').hide();
                    $('#addImageURLInput').show();
                }
            });

            $('input[name="editImageSource"]').change(function() {
                if (this.value === 'file') {
                    $('#editImageFileInput').show();
                    $('#editImageURLInput').hide();
                } else {
                    $('#editImageFileInput').hide();
                    $('#editImageURLInput').show();
                }
            });

            // Add candidate form submission
            $('#add-candidate-form').submit(function(event) {
                event.preventDefault();
                const formData = new FormData(this);

                let newCandidate = {
                    id: candidates.length + 1,
                    name: formData.get('name'),
                    description: formData.get('description'),
                    party: formData.get('party')
                };

                if (formData.get('imageSource') === 'file') {
                    // Handle file upload (this is a simulation, actual file upload handling needed)
                    const file = formData.get('image_file');
                    newCandidate.image_url = URL.createObjectURL(file);
                } else {
                    newCandidate.image_url = formData.get('image_url');
                }

                candidates.push(newCandidate);
                renderCandidates();
                $('#addCandidateModal').modal('hide');
            });

            // View candidate
            $(document).on('click', '.view-candidate', function() {
                const candidateId = $(this).data('id');
                const candidate = candidates.find(c => c.id === candidateId);

                $('#view-candidate-image').attr('src', candidate.image_url);
                $('#view-candidate-name').text(candidate.name);
                $('#view-candidate-description').text(candidate.description);
                $('#view-candidate-party').text(candidate.party);

                $('#viewCandidateModal').modal('show');
            });

            // Edit candidate
            $(document).on('click', '.edit-candidate', function() {
                const candidateId = $(this).data('id');
                const candidate = candidates.find(c => c.id === candidateId);

                $('#edit-candidate-id').val(candidate.id);
                $('#edit-candidateName').val(candidate.name);
                $('#edit-candidateDescription').val(candidate.description);
                $('#edit-candidateParty').val(candidate.party);

                $('#editImageFileRadio').prop('checked', true);
                $('#editImageFileInput').show();
                $('#editImageURLInput').hide();

                $('#editCandidateModal').modal('show');
            });

            // Edit candidate form submission
            $('#edit-candidate-form').submit(function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const candidateId = parseInt($('#edit-candidate-id').val());

                const candidateIndex = candidates.findIndex(c => c.id === candidateId);
                candidates[candidateIndex].name = formData.get('name');
                candidates[candidateIndex].description = formData.get('description');
                candidates[candidateIndex].party = formData.get('party');

                if (formData.get('editImageSource') === 'file') {
                    // Handle file upload (this is a simulation, actual file upload handling needed)
                    const file = formData.get('image_file');
                    candidates[candidateIndex].image_url = URL.createObjectURL(file);
                } else {
                    candidates[candidateIndex].image_url = formData.get('image_url');
                }

                renderCandidates();
                $('#editCandidateModal').modal('hide');
            });

            // Delete candidate
            $(document).on('click', '.delete-candidate', function() {
                const candidateId = $(this).data('id');
                const candidateIndex = candidates.findIndex(c => c.id === candidateId);

                if (candidateIndex !== -1) {
                    candidates.splice(candidateIndex, 1);
                    renderCandidates();
                }
            });
        });
    </script>
</body>
</html>
