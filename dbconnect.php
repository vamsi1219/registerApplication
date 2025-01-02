<?php
$servername = "localhost";  // Server name or IP address
$username = "root";         // Default username for XAMPP
$password = "";             // Default password for XAMPP (empty by default)
$dbname = "registration";   // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to the database!";
?>
