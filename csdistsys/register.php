<?php
// Include the database connection
require_once 'db.php';

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve and sanitize form data to prevent basic issues
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        die("Please fill in all required fields.");
    }

    // Hash the password for security before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use a prepared statement to securely insert data into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<h2>Registration successful!</h2>";
        echo "<p>Welcome, " . htmlspecialchars($username) . "! Your account has been created.</p>";
        echo "<a href='signup.html'>Go back to Signup</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If someone tries to access register.php directly via URL, redirect them back to the form
    header("Location: signup.html");
    exit();
}
?>