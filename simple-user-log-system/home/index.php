<!--

This is the home page
This file is part of a SIMPLE login system using PHP and MySQL.

The following files are used in this system:
- simple-login-form/index.php
- simple-signup-form/index.php
- session-checker/index.php
- session-checker/logout.php

The following files are globally used:
- connection.php
- functions.php

-->

<?php
    // This line is necessary for every page that uses sessions
    // Sessions are used to store user's data
    // and it what makes the users still logged in even after closing the browser
    session_start();
    
    // This part is optional but recommended since it makes the code cleaner
    // If you don't want to use this, you can just include the connection.php
    // and functions.php files directly in every file
    include("../connection.php");
    include("../functions.php");

    // Check if the user is already logged in
    // If is not logged in, redirects them to the login page
    // If is logged in, returns users data
    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page | Session Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">PHP Web Templates</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            Welcome,
                            
                            <!-- Sample code for using data outside the html code -->
                            <?php echo htmlspecialchars($user_data['username']); ?>

                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2" href="../logout/">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h3>Home Page</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3">
                            Hello,
                            <strong>
                                <!-- Sample code for using data outside the html code -->
                                <?php echo htmlspecialchars($user_data['username']); ?></strong>!
                        </h5>
                        <p class="lead">You are successfully logged in. If you can see this, that means you are logged on.</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Account Details</h6>
                                <ul class="list-group">

                                    <!-- Sample code for using data outside the html code -->
                                    <li class="list-group-item"><strong>User ID:</strong> <?php echo htmlspecialchars($user_data['userId']); ?></li>
                                    <li class="list-group-item"><strong>Username:</strong> <?php echo htmlspecialchars($user_data['username']); ?></li>
                                    
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>System Status</h6>
                                <?php if ($con): ?>
                                    <span class="badge bg-success mb-2">Database connection successful!</span>
                                <?php else: ?>
                                    <span class="badge bg-danger mb-2">Failed to connect to the database.</span>
                                <?php endif; ?>
                                <div class="alert alert-info mt-3">
                                    <strong>Tip:</strong> This page will serve as your session checker, as well as your home page.
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-danger" href="../logout/">Logout</a>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        &copy; <?php echo date('Y'); ?> PHP Web Templates. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>