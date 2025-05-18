<!--

This is the signup page
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

    // POST means you are sending data to the server
    // Basically, this is recommended for login and signup forms
    // This filters out if going to this page came from pressing enter, or just from link
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        // $_POST will contain the data that you sent to the server
        // It will be saved in the variables below for ease of access
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Checks if the username and password fields are not empty
        if(!empty($username) && !empty($password) && !is_numeric($username)) {

            // Generate a random number as a userId
            $userId = random_num($con, 20);

            // Hashes the password created for security
            // Meaning the developers would not know the password of the users
            // But can still verify what password they placed
            $password = password_hash($password, PASSWORD_BCRYPT);

            // Creates a mySQL query to check if the username exist in the database
            $check_query = "SELECT * FROM `simple-users` WHERE username = '$username' LIMIT 1";

            // Runs the query
            $result = mysqli_query($con, $check_query);

            // Check if the query was successful
            if (!$result){
                $error = "Database error: " . mysqli_error($con);
            }
            
            // Check if the username already exists (mysqli_num_rows($result) > 0)
            else if(mysqli_num_rows($result) > 0) {
                $error = "Username already exists.";
            }

            else {
                // Creates a mySQL query for adding the user info to the database
                $query = "INSERT INTO `simple-users` (userId, username, password) VALUES ('$userId', '$username', '$password')";

                // Runs the query
                mysqli_query($con, $query);

                // Sets the userId session by the userId of the user
                // This what makes the user not logged out
                // even if the browser was closed
                $_SESSION['userId'] = $userId;

                // Redirects the user to the supposed home page after logging in
                header("Location: ../home/");
                die();
            }
        } else {
            // Empty fields
            $error = "Please enter valid information.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | PHP Web Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow border-success">
                    <div class="card-header text-center bg-success text-white">
                        <h4><i class="bi bi-person-plus"></i> Signup</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center mb-4">Create a new account</p>

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
                            <button class="btn btn-success w-100" type="submit">Signup</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <span class="text-muted">Already have an account?</span>
                        <a href="../login/" class="ms-1">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons CDN for icon usage -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>