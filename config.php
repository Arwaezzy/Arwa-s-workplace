<?php

// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Get the logged-in user ID from the session
$user_id = $_SESSION['user_id'];


// Step 1: Database Connection
$host = 'localhost'; // Your database host
$dbname = 'ams watches'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Create connection
$conn1 = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}

// Query to check if the user is an admin
$sql = "SELECT admin FROM ams_signin WHERE id = ?";
$stmt = $conn1->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Check if the user has admin privileges
    if ($row['admin'] !== 1) { 
        // The user is not an admin, redirect or deny access
        header("Location: /");
        exit();
    }
} else {
    // No user found, handle the error (e.g., redirect to login)
    header("Location: login.html");
    exit();
}
