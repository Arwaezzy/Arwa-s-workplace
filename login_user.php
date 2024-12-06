<?php

session_start();

// Check if data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
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

    // Prepare the SQL statement to select the user
    $sql = "SELECT id,password,admin FROM ams_signin WHERE username = ?";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id,$stored_password, $isadmin);
        $stmt->fetch();

        // Verify the password
        if ($password === $stored_password) {

            $_SESSION['user_id'] = $id;
            // echo "Login successful!";
            $response = array(
                "status" => "success",
                "message" => "Login successful!",
                "userid" => $id,
                "admin" => $isadmin
            );

            echo json_encode($response);
        } else {
            // echo "Invalid password!";
            $response = array(
                "status" => "error",
                "message" => "Invalid password!"
            );
            echo json_encode($response);
        }
    } else {
        // echo "Username not found!";

        $response = array(
            "status" => "error",
            "message" => "Username not found!"
        );
        echo json_encode($response);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>