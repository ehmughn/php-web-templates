<?php
    session_start();

    include("../connection.php");
    include("../functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        $verifyToken = md5($email);

        // Checks if the password and confirmPassword do not match
        if($password != $confirmPassword) {
            $error = "Passwords do not match.";
        }
        else {

            // Generate a random number as a userId
            $userId = random_num($con, 20);

            // Hashes the password created for security
            // Meaning the developers would not know the password of the users
            // But can still verify what password they placed
            $password = password_hash($password, PASSWORD_BCRYPT);

            // Creates a mySQL query to check if the email exist in the database
            $check_query = "SELECT * FROM `user-with-validator` WHERE email = '$email' LIMIT 1";

            // Runs the query
            $result = mysqli_query($con, $check_query);

            // Check if the query was successful
            if (!$result){
                $error = "Database error: " . mysqli_error($con);
            }
            
            // Check if the email already exists (mysqli_num_rows($result) > 0)
            else if(mysqli_num_rows($result) > 0) {
                $error = "Email already exists.";
            }

            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            }

            else {

                // Creates a mySQL query for adding the user info to the database
                $query = "INSERT INTO `user-with-validator` (userId, firstName, lastName, email, password, verifyToken) VALUES ('$userId', '$firstName', '$lastName', '$email', '$password', '$verifyToken')";

                // Runs the query
                mysqli_query($con, $query);

                
                send_email($email, $verifyToken);



                // Redirects the user to the supposed home page after logging in
                header("Location: ../see-verification/");
                die();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | PHP Web Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-7">
            <div class="row shadow rounded-4 overflow-hidden">
                <!-- Left: Info & Welcome -->
                <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center bg-success text-white p-4">
                    <div>
                        <h2 class="mb-3"><i class="bi bi-person-plus"></i> Join Us!</h2>
                        <p class="lead">Create your account to unlock:</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="bi bi-check-circle"></i> Personalized dashboard</li>
                            <li><i class="bi bi-check-circle"></i> Email verification for security</li>
                            <li><i class="bi bi-check-circle"></i> Fast, secure access</li>
                        </ul>
                        <div class="mt-4">
                            <span class="small">Already a member?</span>
                            <a href="../login/" class="btn btn-outline-light btn-sm ms-2">Sign In</a>
                        </div>
                    </div>
                </div>
                <!-- Right: Signup Form -->
                <div class="col-md-6 bg-white p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-1 text-success"><i class="bi bi-person-plus"></i> Create Account</h3>
                        <p class="text-muted">Fill in your details to get started</p>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post" action="">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="first-name" class="form-label">First Name</label>
                                    <input class="form-control" type="text" name="first-name" id="first-name" required autofocus>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="last-name" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last-name" id="last-name" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input class="form-control" type="password" name="confirm-password" id="confirm-password" required>
                        </div>
                        <button class="btn btn-success w-100" type="submit">Sign Up</button>
                    </form>
                    <div class="text-center mt-3 d-md-none">
                        <span class="text-muted">Already have an account?</span>
                        <a href="../login/" class="ms-1 text-success text-decoration-none">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons CDN for icon usage -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>