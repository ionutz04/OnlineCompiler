<?php
session_start();

$host = "192.168.0.116:3307"; // Your database host
$db = "proiectosa"; // Your database name
$user = "root"; // Your database user
$pass = "proiectqwerty"; // Your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>