<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates Management</title>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Modal for deleting candidate -->
    <div class="modal fade" id="deleteCandidateModal" tabindex="-1" aria-labelledby="deleteCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCandidateModalLabel">Delete Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-candidate-name"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCandidateBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset("assets/dist/js/adminlte.min.js") }}"></script>
    <script>
        $(document).ready(function() {
            // Toggle image input based on selected radio button
            $('input[name="imageSource"]').change(function() {
                if ($('#addImageFileRadio').is(':checked')) {
                    $('#addImageFileInput').show();
                    $('#addImageURLInput').hide();
                } else {
                    $('#addImageFileInput').hide();
                    $('#addImageURLInput').show();
                }
            });

            $('input[name="editImageSource"]').change(function() {
                if ($('#editImageFileRadio').is(':checked')) {
                    $('#editImageFileInput').show();
                    $('#editImageURLInput').hide();
                } else {
                    $('#editImageFileInput').hide();
                    $('#editImageURLInput').show();
                }
            });

            // Handle form submissions, candidate editing, deletion, etc.
            $('#add-candidate-form').on('submit', function(event) {
                event.preventDefault();
                // Add candidate logic here
                $('#add-candidate-form').on('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const imageSource = $('input[name="imageSource"]:checked').val();

        if (imageSource === 'url') {
            formData.delete('image_file');
        } else {
            formData.delete('image_url');
        }

        $.ajax({
            url: '/api/candidates', // Replace with your API endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#addCandidateModal').modal('hide');
                // Add candidate card dynamically
                addCandidateCard(response.id, response.name, response.description, response.party, response.image_url);
            },
            error: function(xhr, status, error) {
                console.error('Error adding candidate:', error);
            }
        });
    });

            });

            $('#edit-candidate-form').on('submit', function(event) {
                event.preventDefault();
                // Edit candidate logic here
                const candidateId = $('#edit-candidate-id').val();
        const formData = new FormData(this);
        const imageSource = $('input[name="editImageSource"]:checked').val();

        if (imageSource === 'url') {
            formData.delete('image_file');
        } else {
            formData.delete('image_url');
        }

        $.ajax({
            url: `/api/candidates/${candidateId}`, // Replace with your API endpoint
            type: 'PUT',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#editCandidateModal').modal('hide');
                // Update the candidate card dynamically
                updateCandidateCard(response.id, response.name, response.description, response.party, response.image_url);
            },
            error: function(xhr, status, error) {
                console.error('Error editing candidate:', error);
            }
        });
    });


            });

            $('#confirmDeleteCandidateBtn').on('click', function() {
                // Delete candidate logic here
                const candidateId = $(this).data('candidate-id');

        $.ajax({
            url: `/api/candidates/${candidateId}`, // Replace with your API endpoint
            type: 'DELETE',
            success: function(response) {
                $('#deleteCandidateModal').modal('hide');
                // Remove the candidate card dynamically
                removeCandidateCard(candidateId);
            },
            error: function(xhr, status, error) {
                console.error('Error deleting candidate:', error);
            }
        });
            });

            // Example function to add a candidate card to the container (replace this with actual logic)
            function addCandidateCard(id, name, description, party, imageUrl) {
                const cardHtml = `
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="${imageUrl}" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="${name}">
                            <div class="card-body">
                                <h5 class="card-title">${name}</h5>
                                <p class="card-text">${description}</p>
                                <p class="card-text"><small class="text-muted">Party: ${party}</small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewCandidateModal" onclick="viewCandidate(${id})">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editCandidateModal" onclick="editCandidate(${id})">Edit</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteCandidateModal" onclick="deleteCandidate(${id})">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#candidates-container').append(cardHtml);
            }
            //Example function to view candidate details (replace this with actual logic)
            function viewCandidate(id) {
                    // Logic to fetch and display candidate details
                }

// Example function to edit candidate details (replace this with actual logic)
function editCandidate(id) {
    // Logic to fetch and fill candidate details in the edit form
    $.ajax({
        url: `/api/candidates/${id}`, // Replace with your API endpoint
        type: 'GET',
        success: function(response) {
            $('#edit-candidate-id').val(response.id);
            $('#edit-candidateName').val(response.name);
            $('#edit-candidateDescription').val(response.description);
            $('#edit-candidateParty').val(response.party);
            if (response.image_url) {
                $('#editImageURLRadio').prop('checked', true).trigger('change');
                $('#edit-candidateImageURL').val(response.image_url);
            } else {
                $('#editImageFileRadio').prop('checked', true).trigger('change');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching candidate details:', error);
        }
    });
}

// Example function to delete candidate (replace this with actual logic)
function deleteCandidate(id) {
    $('#confirmDeleteCandidateBtn').data('candidate-id', id);
    // Logic to handle candidate deletion confirmation
    const candidateName = document.getElementById('delete-candidate-id').value;
        const candidateCards = document.querySelectorAll('#candidates-container .card');
        candidateCards.forEach(card => {
            if (card.querySelector('.card-title').textContent === candidateName) {
                card.closest('.col').remove();
            }
        });

        const deleteCandidateModal = new bootstrap.Modal(document.getElementById('deleteCandidateModal'));
        deleteCandidateModal.hide();
    }
}

// Example function to update a candidate card (replace this with actual logic)
function updateCandidateCard(id, name, description, party, imageUrl) {
    const card = $(`#candidate-card-${id}`);
    card.find('.card-title').text(name);
    card.find('.card-text').first().text(description);
    card.find('.card-text small').text(`Party: ${party}`);
    card.find('.card-img-top').attr('src', imageUrl);
}

// Example function to remove a candidate card (replace this with actual logic)
function removeCandidateCard(id) {
    $(`#candidate-card-${id}`).remove();
}


            // Mock data for demonstration (replace this with actual logic)
            addCandidateCard(1, 'John Doe', 'A candidate description.', 'Party A', 'https://via.placeholder.com/150');
            addCandidateCard(2, 'Jane Smith', 'Another candidate description.', 'Party B', 'https://via.placeholder.com/150');

    </script>
</body>
</html>
