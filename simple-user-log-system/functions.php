<?php

// Function for checking if the user is already logged in
function check_login($con) {
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
        $query = "SELECT * FROM `simple-users` WHERE userId = '$id' LIMIT 1";
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