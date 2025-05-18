<?php
    session_start();

    include("../connection.php");
    include("../functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        // Get email and password from POST
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Checks if the email and password fields are not empty
        if(!empty($email) && !empty($password)) {
            // Query to check if the email exists in the database
            $query = "SELECT * FROM `user-with-validator` WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($con, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                // Check if the email is verified (verifyToken == 0)
                if (isset($user_data['verifyToken']) && $user_data['verifyToken'] != 0) {
                    // Redirect to see-verification page if not verified
                    header("Location: ../see-verification/");
                    die();
                }

                // Check if the password is correct
                if(password_verify($password, $user_data['password'])) {
                    // Set the userId session
                    $_SESSION['userId'] = $user_data['userId'];
                    // Redirect to home page
                    header("Location: ../home/");
                    die();
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "Invalid email.";
            }
        } else {
            $error = "Please enter valid information.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | PHP Web Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center bg-primary text-white rounded-start p-5">
                    <div>
                        <h2 class="mb-3"><i class="bi bi-shield-lock-fill"></i> Welcome Back!</h2>
                        <p class="lead">Access your dashboard, manage your profile, and explore new features.</p>
                        <ul class="list-unstyled mt-4">
                            <li><i class="bi bi-check-circle"></i> Secure authentication</li>
                            <li><i class="bi bi-check-circle"></i> Email verification</li>
                            <li><i class="bi bi-check-circle"></i> Fast and easy access</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 bg-white rounded-end shadow p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-1 text-primary"><i class="bi bi-box-arrow-in-right"></i> Sign In</h3>
                        <p class="text-muted">Enter your credentials to continue</p>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input class="form-control" type="email" name="email" id="email" required autofocus placeholder="you@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label d-flex justify-content-between">
                                <span>Password</span>
                                <a href="#" class="small text-decoration-none text-primary">Forgot password?</a>
                            </label>
                            <input class="form-control" type="password" name="password" id="password" required placeholder="Your password">
                        </div>
                        <button class="btn btn-primary w-100 mt-2" type="submit">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </button>
                    </form>
                    <div class="text-center mt-4">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="../signup/" class="ms-1 text-primary text-decoration-none">Create one</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>