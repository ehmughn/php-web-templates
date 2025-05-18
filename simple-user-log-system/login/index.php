<!--

This is the login page
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
    // and functions.phpfiles directly in every file
    include("../connection.php");
    include("../functions.php");

    // Check if the user is already logged in
    // If is logged in, redirects them to the home page
    check_logout($con);

    // POST means you are sending data to the server
    // Basically, this is recommended for login and signup forms
    // This filters out if going to this page came from pressing enter, or just from link
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        // $_POST will contain the data that you sent to the server
        // It will be saved in the variables below for ease of access
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Checks if the username and password fields are not empty
        if(!empty($username) && !empty($password)) {

            // Creates a mySQL query to check if the username exist in the database
            $query = "SELECT * FROM `simple-users` WHERE username = '$username' LIMIT 1";

            // Runs the query
            $result = mysqli_query($con, $query);
            
            // Check if the query was successful ($result)
            // and if the username exist (mysqli_num_rows($result) > 0)
            if($result && mysqli_num_rows($result) > 0) {

                // Get the result of the query
                // and store it in the $user_data variable for ease of access
                $user_data = mysqli_fetch_assoc($result);

                // Check if the password writen is correct
                // since it is hashed in the database, we use password_verify()
                if(password_verify($password, $user_data['password'])) {

                    // Sets the userId session by the userId of the user
                    // This what makes the user not logged out
                    // even if the browser was closed
                    $_SESSION['userId'] = $user_data['userId'];

                    // Redirects the user to the supposed home page after logging in
                    header("Location: ../home/");
                    die();
                    
                } else {

                    // Password does not match the username
                    $error = "Invalid password.";
                }
            } else {

                // Username not found in the database
                $error = "Invalid username.";
            }
        } else {

            // The fields are empty
            $error = "Please enter valid information.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHP Web Templates</title>

    <!-- Bootstrap stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow border-primary">
                    <div class="card-header text-center bg-primary text-white">
                        <h4><i class="bi bi-box-arrow-in-right"></i> Login</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center mb-4">Sign in to your account</p>

                        <!-- Error pops up at the top if there was an error-->
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <!--
                        When any form of enter is pressed (pressing Enter button, clicked the button)
                        Redirects to the same page with the $_POST data
                        -->
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" name="username" id="username" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                        </form>

                    </div>
                    <div class="card-footer text-center">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="../signup/" class="ms-1">Signup</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons CDN for icon usage -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>