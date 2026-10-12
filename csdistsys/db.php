<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "csdistsys_db"; // Replace with your target database name if different

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Optional: echo "Connected successfully";
?>