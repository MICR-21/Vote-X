<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Candidate list for voting">
    <meta name="author" content="Your Name">
    <title>Voting Candidates</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    {{-- <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3"> --}}

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .navbar-brand {
            font-size: 1.5rem;
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
            <a href="#" class="navbar-brand text-white">Voting Candidates</a>
        </div>
    </header>

    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Candidates</h1>
                    <p class="lead text-muted">Meet the candidates for the upcoming election. Learn more about their
                        background, policies, and vision for the future.</p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="candidates-container">
                    <!-- Existing candidate cards go here -->
                    <!-- Example Candidate 1 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="path_to_candidate_image.jpg" class="bd-placeholder-img card-img-top" width="100%"
                                height="225" alt="Candidate 1">
                            <div class="card-body">
                                <h5 class="card-title">Candidate 1</h5>
                                <p class="card-text">Brief description about Candidate 1. Background, policies, and vision.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-success view-candidate-btn"
                                        data-bs-toggle="modal" data-bs-target="#viewCandidateModal"
                                        data-name="Candidate 1"
                                        data-description="Brief description about Candidate 1. Background, policies, and vision."
                                        data-party="Candidate's Party"
                                        data-image="path_to_candidate_image.jpg">View</button>
                                    <button type="button" class="btn btn-sm btn-primary edit-candidate-btn"
                                        data-bs-toggle="modal" data-bs-target="#editCandidateModal" data-id="1"
                                        data-name="Candidate 1"
                                        data-description="Brief description about Candidate 1. Background, policies, and vision."
                                        data-party="Candidate's Party"
                                        data-image="path_to_candidate_image.jpg">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger delete-candidate-btn"
                                        data-id="1">Delete</button>
                                    <small class="text-muted">Candidate's Party</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addCandidateModal">Add
                    Candidate</button>
            </div>
        </div>
    </main>

    <!-- Modal for adding candidate -->
    <div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel"
        aria-hidden="true">
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
                            <input type="text" class="form-control" id="candidateName" required>
                        </div>
                        <div class="mb-3">
                            <label for="candidateDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="candidateDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="candidateParty" class="form-label">Party</label>
                            <input type="text" class="form-control" id="candidateParty" required>
                        </div>
                        <div class="mb-3">
                            <label for="candidateImageFile" class="form-label">Upload Image File</label>
                            <input type="file" class="form-control" id="candidateImageFile" accept="image/png, image/jpeg">
                            <small class="text-muted">Or</small>
                        </div>
                        <div class="mb-3">
                            <label for="candidateImage" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="candidateImage" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Candidate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing candidate -->
    <div class="modal fade" id="editCandidateModal" tabindex="-1" aria-labelledby="editCandidateModalLabel"
        aria-hidden="true">
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
                            <input type="text" class="form-control" id="edit-candidateName" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-candidateDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-candidateDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-candidateParty" class="form-label">Party</label>
                            <input type="text" class="form-control" id="edit-candidateParty" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-candidateImageURL" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="edit-candidateImageURL"
                                placeholder="https://example.com/image.jpg">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for viewing candidate -->
    <div class="modal fade" id="viewCandidateModal" tabindex="-1" aria-labelledby="viewCandidateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCandidateModalLabel">Candidate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="view-candidate-image" src="" class="img-fluid mb-3" alt="Candidate Image">
                    <h5 id="view-candidate-name"></h5>
                    <p id="view-candidate-description"></p>
                    <p><strong>Party:</strong> <span id="view-candidate-party"></span></p>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-muted py-5 bg-dark">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addCandidateForm = document.getElementById('add-candidate-form');
            const editCandidateForm = document.getElementById('edit-candidate-form');
            const candidatesContainer = document.getElementById('candidates-container');

            addCandidateForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const name = document.getElementById('candidateName').value;
                const description = document.getElementById('candidateDescription').value;
                const party = document.getElementById('candidateParty').value;
                const image = document.getElementById('candidateImage').value;

                const newCandidateHtml = `
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="${image}" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="${name}">
                            <div class="card-body">
                                <h5 class="card-title">${name}</h5>
                                <p class="card-text">${description}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-success view-candidate-btn" data-bs-toggle="modal" data-bs-target="#viewCandidateModal" data-name="${name}" data-description="${description}" data-party="${party}" data-image="${image}">View</button>
                                    <button type="button" class="btn btn-sm btn-primary edit-candidate-btn" data-bs-toggle="modal" data-bs-target="#editCandidateModal" data-id="new" data-name="${name}" data-description="${description}" data-party="${party}" data-image="${image}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger delete-candidate-btn" data-id="new">Delete</button>
                                    <small class="text-muted">${party}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                candidatesContainer.insertAdjacentHTML('beforeend', newCandidateHtml);
                addCandidateForm.reset();
                document.querySelector('#addCandidateModal .btn-close').click();
            });

            candidatesContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('view-candidate-btn')) {
                    const button = e.target;
                    const name = button.getAttribute('data-name');
                    const description = button.getAttribute('data-description');
                    const party = button.getAttribute('data-party');
                    const image = button.getAttribute('data-image');

                    document.getElementById('view-candidate-name').textContent = name;
                    document.getElementById('view-candidate-description').textContent = description;
                    document.getElementById('view-candidate-party').textContent = party;
                    document.getElementById('view-candidate-image').src = image;
                }

                if (e.target.classList.contains('edit-candidate-btn')) {
                    const button = e.target;
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const description = button.getAttribute('data-description');
                    const party = button.getAttribute('data-party');
                    const image = button.getAttribute('data-image');

                    document.getElementById('edit-candidate-id').value = id;
                    document.getElementById('edit-candidateName').value = name;
                    document.getElementById('edit-candidateDescription').value = description;
                    document.getElementById('edit-candidateParty').value = party;
                    document.getElementById('edit-candidateImageURL').value = image;
                }

                if (e.target.classList.contains('delete-candidate-btn')) {
                    const button = e.target;
                    const id = button.getAttribute('data-id');
                    const confirmation = confirm("Are you sure you want to delete this candidate?");
                    if (confirmation) {
                        button.closest('.col').remove();
                        console.log(`Candidate with id ${id} has been deleted.`);
                    }
                }
            });

            editCandidateForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const id = document.getElementById('edit-candidate-id').value;
                const name = document.getElementById('edit-candidateName').value;
                const description = document.getElementById('edit-candidateDescription').value;
                const party = document.getElementById('edit-candidateParty').value;
                const image = document.getElementById('edit-candidateImageURL').value;

                const candidateCards = candidatesContainer.querySelectorAll('.col');
                candidateCards.forEach(function (card) {
                    const viewButton = card.querySelector('.view-candidate-btn');
                    if (viewButton.getAttribute('data-id') === id) {
                        card.querySelector('.card-title').textContent = name;
                        card.querySelector('.card-text').textContent = description;
                        card.querySelector('.text-muted').textContent = party;
                        card.querySelector('.card-img-top').src = image;

                        viewButton.setAttribute('data-name', name);
                        viewButton.setAttribute('data-description', description);
                        viewButton.setAttribute('data-party', party);
                        viewButton.setAttribute('data-image', image);

                        const editButton = card.querySelector('.edit-candidate-btn');
                        editButton.setAttribute('data-name', name);
                        editButton.setAttribute('data-description', description);
                        editButton.setAttribute('data-party', party);
                        editButton.setAttribute('data-image', image);
                    }
                });

                document.querySelector('#editCandidateModal .btn-close').click();
            });
        });
    </script>
</body>

</html>
