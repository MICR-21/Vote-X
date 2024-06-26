<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Management</title>
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
                <!-- Dynamic content for candidates will be inserted here -->
            </div>
            <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addCandidateModal">Add Candidate</button>
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

<!-- JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addCandidateForm = document.getElementById('add-candidate-form');
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

                // Implement viewing logic (if needed)
            }

            if (e.target.classList.contains('edit-candidate-btn')) {
                const button = e.target;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const description = button.getAttribute('data-description');
                const party = button.getAttribute('data-party');
                const image = button.getAttribute('data-image');

                // Implement editing logic (if needed)
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
    });
</script>

</body>
</html>
