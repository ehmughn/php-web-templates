<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function for checking if the user is already logged in
function check_login($con) {
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
        $query = "SELECT * FROM `user-with-validator` WHERE userId = '$id' LIMIT 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }

    header("Location: ../login/");
    die();

}

// Function for checking if the user is logged out
function check_logout($con) {
    if(isset($_SESSION['userId'])) {
        header("Location: ../home/");
        die();
    }
}

function send_email($to, $token) {
    // Load Composer's autoloader
    require_once __DIR__ . '../../vendor/autoload.php'; // Adjust path if needed

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // For Gmail SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'emanhatesschool1234@gmail.com'; // Your Gmail address
        $mail->Password   = 'izgfgxhgfahlzarp';    // Gmail App Password (not your Gmail password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('emanhatesschool1234@gmail.com', 'User Log With Validator');
        $mail->addAddress($to);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body    = "<h1>Verify your email</h1>
            <p>Click the link below to verify your email:</p>
            <a href='http://localhost/user-log-with-validator/verify-email.php?email=$to&token=$token'>Verify Email</a>";

        $mail->send();
        // Optionally return true or log success
    } catch (Exception $e) {
        // Optionally log error: $mail->ErrorInfo
    }
}

// Generates a randon userId
function random_num($con, $length) {

    // Variable declaration
    $text = "";

    while(TRUE) {
        // Empties the text variable
        $text = "";

        // Defaults the length to 5 if it was less than 5
        if($length < 5) {
            $length = 5;
        }

        // Re-randomize the length of the number
        $len = rand(4, $length);

        // Sets the values of the userId
        for ($i = 0; $i < $len; $i++) {
            $text .= rand(0, 9);
        }

        // Check if the id already exist
        $query = "SELECT * FROM `simple-users` WHERE userId = '$text' LIMIT 1";
        $result = mysqli_query($con, $query);

        // If the id don't exist, exits the while loop
        if($result && mysqli_num_rows($result) == 0) {
            break;
        }
    }
    return $text;
}