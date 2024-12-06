<?php

// Check if data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data from the POST request
    $customername = $_POST['customer-name'];
    $watchbrand = $_POST['watch-brand'];
    $customizations = $_POST['customizations'];
    $contactnumber = $_POST['contact-number'];
    $username = $_POST['username'];

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

    // Prepare the SQL statement to insert the data into the watch_repair table
    $sql = "INSERT INTO custom_design (watch_name, watch_brand, customization, contact, cus_username) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $customername, $watchbrand, $customizations, $contactnumber, $username);

    // Execute the statement
    if ($stmt->execute()) {
        echo "We will get back to you soon and solve your query!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}