<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - WellBeingHub</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/styleDashboard.css">
</head>
<body>
    <?php
    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }

    // Retrieve user data
    $user = $_SESSION['user'];
    ?>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">WellBeingHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($user['Names']); ?>!</h1>
            <p class="lead">Manage your health efficiently with WellBeingHub.</p>
            <a href="#features" class="btn btn-light btn-lg">Explore Features</a>
        </div>
    </header>

    <!-- User Info Section -->
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Your Details</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Document:</strong> <?php echo htmlspecialchars($user['Document']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['Phone'] ?? 'Not Provided'); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['Address'] ?? 'Not Provided'); ?></p>
                        <p><strong>Birthdate:</strong> <?php echo htmlspecialchars($user['Birthdate'] ?? 'Not Provided'); ?></p>
                        <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['Gender'] ?? 'Not Provided'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Our Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card shadow-sm p-4">
                        <i class="fas fa-calendar-check text-primary mb-3"></i>
                        <h5>Appointment Scheduling</h5>
                        <p>Effortlessly book and manage your appointments with just a few clicks.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card shadow-sm p-4">
                        <i class="fas fa-file-medical text-primary mb-3"></i>
                        <h5>Digital Health Records</h5>
                        <p>Access and update your medical records securely from anywhere.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card shadow-sm p-4">
                        <i class="fas fa-notes-medical text-primary mb-3"></i>
                        <h5>Medication Reminders</h5>
                        <p>Stay on track with timely reminders for your medications and prescriptions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">What Our Users Say</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p>"HealthHub transformed how I manage my health. It’s a lifesaver!"</p>
                            <p class="text-muted">- Sarah, Patient</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p>"The scheduling tool is fantastic. It saves me so much time."</p>
                            <p class="text-muted">- Dr. John, Physician</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p>"Keeping track of my medication has never been easier."</p>
                            <p class="text-muted">- Emily, User</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-4">
        <p>&copy; 2024 WellBeingHub. All Rights Reserved. <a href="#" class="text-light text-decoration-underline">Privacy Policy</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
