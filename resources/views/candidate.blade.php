<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates Management</title>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

<header class="bg-dark py-3">
    <div class="container">
        <a href="#" class="navbar-brand text-white">Manage Candidates</a>
    </div>
</header>

<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Candidates</h1>
                <p class="lead text-muted">Manage the candidates for the upcoming election. Add new candidates to the list.</p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="candidates-container">
                <!-- Candidate cards will be dynamically added here -->
            </div>
            <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addCandidateModal">Add Candidate</button>
        </div>
    </div>
</main>

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
                            <input class="form-check-input" type="radio" name="imageSource" id="imageFileRadio" value="file" checked>
                            <label class="form-check-label" for="imageFileRadio">
                                Upload Image File
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="imageSource" id="imageURLRadio" value="url">
                            <label class="form-check-label" for="imageURLRadio">
                                Image URL
                            </label>
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
                        <label for="edit-candidateImageURL" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="edit-candidateImageURL" name="image_url" required>
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
                <p>Are you sure you want to delete this candidate?</p>
                <input type="hidden" id="delete-candidate-id">
                <input type="hidden" id="delete-candidate-card">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDeleteCandidate()">Delete</button>
            </div>
        </div>
    </div>
</div>

<footer class="text-muted py-5">
    <div class="container">
        <p class="mb-1">Your footer content here.</p>
        <p class="mb-0"><a href="{{ route('admins') }}">Back to top</a></p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
<script>
    document.querySelectorAll('input[name="imageSource"]').forEach((input) => {
        input.addEventListener('change', function () {
            document.getElementById('imageFileInput').style.display = this.value === 'file' ? 'block' : 'none';
            document.getElementById('imageURLInput').style.display = this.value === 'url' ? 'block' : 'none';
        });
    });

    document.getElementById('add-candidate-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const imageSource = formData.get('imageSource');
        let imageUrl;

        if (imageSource === 'file') {
            const imageFile = formData.get('image_file');
            if (imageFile && imageFile.size > 0) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    imageUrl = event.target.result;
                    addCandidate(formData, imageUrl);
                };
                reader.readAsDataURL(imageFile);
            } else {
                alert('Please select an image file.');
            }
        } else {
            imageUrl = formData.get('image_url');
            if (imageUrl) {
                addCandidate(formData, imageUrl);
            } else {
                alert('Please enter an image URL.');
            }
        }
    });

    function addCandidate(formData, imageUrl) {
        const candidate = {
            name: formData.get('name'),
            description: formData.get('description'),
            party: formData.get('party'),
            image: imageUrl
        };

        const candidatesContainer = document.getElementById('candidates-container');
        const candidateCard = document.createElement('div');
        candidateCard.className = 'col';
        candidateCard.innerHTML = `
            <div class="card shadow-sm">
                <img src="${candidate.image}" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="${candidate.name}">
                <div class="card-body">
                    <h5 class="card-title">${candidate.name}</h5>
                    <p class="card-text">${candidate.description}</p>
                    <p class="card-text"><small class="text-muted">${candidate.party}</small></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="viewCandidate('${candidate.name}', '${candidate.description}', '${candidate.party}', '${candidate.image}')">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editCandidate('${candidate.name}', '${candidate.description}', '${candidate.party}', '${candidate.image}')">Edit</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteCandidate('${candidate.name}', this)">Delete</button>
                        </div>
                        <small class="text-muted">Just now</small>
                    </div>
                </div>
            </div>
        `;
        candidatesContainer.appendChild(candidateCard);

        // Close modal
        const addCandidateModal = new bootstrap.Modal(document.getElementById('addCandidateModal'));
        addCandidateModal.hide();

        // Reset form
        document.getElementById('add-candidate-form').reset();
    }

    function viewCandidate(name, description, party, image) {
        document.getElementById('view-candidate-image').src = image;
        document.getElementById('view-candidate-name').textContent = name;
        document.getElementById('view-candidate-description').textContent = description;
        document.getElementById('view-candidate-party').textContent = party;

        const viewCandidateModal = new bootstrap.Modal(document.getElementById('viewCandidateModal'));
        viewCandidateModal.show();
    }

    function editCandidate(name, description, party, image) {
        document.getElementById('edit-candidate-id').value = name;
        document.getElementById('edit-candidateName').value = name;
        document.getElementById('edit-candidateDescription').value = description;
        document.getElementById('edit-candidateParty').value = party;
        document.getElementById('edit-candidateImageURL').value = image;

        const editCandidateModal = new bootstrap.Modal(document.getElementById('editCandidateModal'));
        editCandidateModal.show();
    }

    document.getElementById('edit-candidate-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const candidateId = formData.get('id');
        const candidate = {
            name: formData.get('name'),
            description: formData.get('description'),
            party: formData.get('party'),
            image: formData.get('image_url')
        };

        // Update candidate card (assumes unique candidate names)
        const candidateCards = document.querySelectorAll('#candidates-container .card');
        candidateCards.forEach(card => {
            if (card.querySelector('.card-title').textContent === candidateId) {
                card.querySelector('.card-title').textContent = candidate.name;
                card.querySelector('.card-text').textContent = candidate.description;
                card.querySelector('.text-muted').textContent = candidate.party;
                card.querySelector('img').src = candidate.image;
                card.querySelector('img').alt = candidate.name;
            }
        });

        // Close modal
        const editCandidateModal = new bootstrap.Modal(document.getElementById('editCandidateModal'));
        editCandidateModal.hide();
    });

    function deleteCandidate(candidateName, deleteButton) {
        document.getElementById('delete-candidate-id').value = candidateName;
        document.getElementById('delete-candidate-card').value = deleteButton.closest('.col').innerHTML;

        const deleteCandidateModal = new bootstrap.Modal(document.getElementById('deleteCandidateModal'));
        deleteCandidateModal.show();
    }

    function confirmDeleteCandidate() {
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
</script>
</body>
</html>
