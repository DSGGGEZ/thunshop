<?php

// Your database settings
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "thunshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$conn->set_charset("utf8");
