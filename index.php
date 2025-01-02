<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Registration</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

    <!-- Carousel -->
    <div id="carouselExampleAutoplay" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x400?text=Program+1" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400?text=Program+2" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400?text=Program+3" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplay" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplay" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Form Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-md-6 bg-white p-4 rounded shadow-sm">
            <h2 class="text-center mb-4">Program Registration Form</h2>

            <!-- Display error message if present -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form action="process.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name of the Candidate:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email ID:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City of Residence:</label>
                    <input type="text" id="city" name="city" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="specialization" class="form-label">P.G/U.G Specialization:</label>
                    <input type="text" id="specialization" name="specialization" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="college" class="form-label">College/University Name:</label>
                    <input type="text" id="college" name="college" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="passout" class="form-label">Pass Out Year:</label>
                    <select id="passout" name="passout" class="form-select" required>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Current Status:</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="Student">Student</option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Working Professional">Working Professional</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label">Course Interested In:</label>
                    <select id="course" name="course" class="form-select" required>
                        <option value="medical coding">Medical Coding</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="availability" class="form-label">Are you available for all 15 days of the program?</label><br>
                    <input type="radio" id="yes" name="availability" value="Yes" required> Yes
                    <input type="radio" id="no" name="availability" value="No" required> No
                </div>

                <div class="mb-3">
                    <label for="source" class="form-label">How did you hear about this program?</label>
                    <select id="source" name="source" class="form-select" required>
                        <option value="College Announcement">College Announcement</option>
                        <option value="Friends/Peers">Friends/Peers</option>
                        <option value="Social Media">Social Media</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>
