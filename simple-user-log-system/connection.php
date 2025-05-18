<?php

// Variables for connecting to the database
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db-php-web-templates"; // Name of the database

// Connects to the database
if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("Failed to connect to the database.");
}