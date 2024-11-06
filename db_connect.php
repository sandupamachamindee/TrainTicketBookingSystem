<?php
// Database connection details
$host = "localhost:3307"  // Change if your host is different
$username = "root";   // Your MySQL username
$password = "";       // Your MySQL password
$database = "booking system";  // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}
?>
