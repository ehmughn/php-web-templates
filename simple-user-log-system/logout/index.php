<!--

This is the logout page / function
You will be redirected to the login page immeditely after being redirected here
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

// Removes the userId from the session
if(isset($_SESSION['userId'])) {
    unset($_SESSION['userId']);
}

// Redirects the user to the login page
header("Location: ../login/");
die();