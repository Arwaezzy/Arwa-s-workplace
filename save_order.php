<?php
// Start the session
session_start();
// Check if data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    


    // Read the raw POST data
    $json = file_get_contents('php://input');
    
    // Decode the JSON data into an associative array
    $data = json_decode($json, true);
    
    // Ensure the JSON was decoded properly
    if ($data === null) {
        die('Invalid JSON data');
    }

    // Extract the data from the decoded array
    $product_name = $data['product_name'] ?? null;
    $description = $data['description'] ?? null;
    $price = $data['price'] ?? null;
    $quantity = $data['quantity'] ?? null;
    $address = $data['address'] ?? null;
    $payment_method = $data['payment_method'] ?? null;
    $payment_status = $data['payment_status'] ?? null;
    $userId = $_SESSION['user_id'] ?? null;

    // Check for null or missing values to avoid inserting invalid data
    if ($product_name === null || $price === null || $quantity === null || $address === null) {
        die('Required fields are missing.');
    }

    // Database connection details

    $servername = "localhost";
    $db_username = "root";
    $db_password = ""; 
    $dbname = "ams watches"; // Replace with your database name

    // Create a connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to insert the data into the orders table
    $sql = "INSERT INTO orders (product_name, description, price, quantity, address, payment_method, payment_status, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisssi", $product_name, $description, $price, $quantity, $address, $payment_method, $payment_status, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Order saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}