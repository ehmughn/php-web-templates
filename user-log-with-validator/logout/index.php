<?php

session_start();

// Removes the userId from the session
if(isset($_SESSION['userId'])) {
    unset($_SESSION['userId']);
}

// Redirects the user to the login page
header("Location: ../login/");
die();