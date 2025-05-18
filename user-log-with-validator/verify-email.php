<?php
    session_start();
    include("connection.php");
    include("functions.php");

    $email = $_GET['email'];
    $token = $_GET['token'];
    $success = false;

    // Fetch the user with the given email
    $query = "SELECT userId, verifyToken FROM `user-with-validator` WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if (!$result) {
        $error = "Database error: " . mysqli_error($con);
    } else {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data && $user_data['verifyToken'] == $token) {
            // Set verifyToken to 0 (verified)
            $update_query = "UPDATE `user-with-validator` SET verifyToken = 0 WHERE email = '$email'";
            mysqli_query($con, $update_query);

            // Set session id to the user's id
            $_SESSION['userId'] = $user_data['userId'];
            $success = true;
        } else {
            $error = "Invalid or expired verification token.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body text-center">
                <?php if (isset($success) && $success): ?>
                    <h3 class="card-title mb-3 text-success">
                        <i class="bi bi-check-circle"></i> Email Verified!
                    </h3>
                    <p class="mb-4">
                        Your email has been successfully verified. You may now log in to your account.
                    </p>
                    <a href="login/" class="btn btn-success w-100">Go to Login</a>
                <?php else: ?>
                    <h3 class="card-title mb-3 text-danger">
                        <i class="bi bi-x-circle"></i> Verification Failed
                    </h3>
                    <div class="alert alert-danger">
                        <?php echo isset($error) ? htmlspecialchars($error) : "An unknown error occurred."; ?>
                    </div>
                    <a href="login/" class="btn btn-secondary w-100">Back to Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>