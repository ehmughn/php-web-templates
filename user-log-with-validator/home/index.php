<?php
    session_start();
    
    include("../connection.php");
    include("../functions.php");

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | PHP Web Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">PHP Web Templates</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            <i class="bi bi-person-circle"></i>
                            <?php echo htmlspecialchars($user_data['firstName'] . ' ' . $user_data['lastName']); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2" href="../logout/">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white text-center rounded-top-4">
                        <h2 class="mb-0"><i class="bi bi-house-door-fill"></i> Welcome to Your Dashboard</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center mb-4">
                            <strong>Success!</strong> You are logged in as <span class="fw-bold"><?php echo htmlspecialchars($user_data['firstName'] . ' ' . $user_data['lastName']); ?></span>.
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3 border rounded-3 bg-light h-100">
                                    <h5 class="mb-3 text-primary"><i class="bi bi-person-badge"></i> Account Details</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>User ID:</strong> <?php echo htmlspecialchars($user_data['userId']); ?></li>
                                        <li class="list-group-item"><strong>Name:</strong> <?php echo htmlspecialchars($user_data['firstName'] . ' ' . $user_data['lastName']); ?></li>
                                        <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded-3 bg-light h-100">
                                    <h5 class="mb-3 text-primary"><i class="bi bi-info-circle"></i> System Status</h5>
                                    <?php if ($con): ?>
                                        <span class="badge bg-success mb-2">Database connection successful!</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger mb-2">Failed to connect to the database.</span>
                                    <?php endif; ?>
                                    <div class="alert alert-info mt-3 mb-0">
                                        <strong>Tip:</strong> Use the navigation bar to securely log out or explore more features.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center mt-4">
                            <a class="btn btn-danger px-4" href="../logout/"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center rounded-bottom-4">
                        &copy; <?php echo date('Y'); ?> PHP Web Templates. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>