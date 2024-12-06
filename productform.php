<?php

include 'config.php';
if (isset($_POST['add_product'])) { 
    // Collect form data
    $product_name = $conn1->real_escape_string($_POST['product_name']);
    $category = $conn1->real_escape_string($_POST['category']);
    $description = $conn1->real_escape_string($_POST['description']);
    $quantity = (int)$_POST['quantity'];
    $price = $conn1->real_escape_string($_POST['price']);
    
    // Handle the file upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['product_image']['tmp_name'];
        $image_name = basename($_FILES['product_image']['name']);
        $upload_dir = 'uploads/products/';
        
        // Create the uploads/products directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the target directory
        $image_path = $upload_dir . $image_name;
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // Save the product information into the database
            $stmt = $conn1->prepare("INSERT INTO pro_details (pro_name, category, description, pro_quantity, price, pro_image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiss", $product_name, $category, $description, $quantity, $price, $image_name);

            if ($stmt->execute()) {
                echo "Product added successfully.";
                header("Location: admin_pro.php");
                exit;

            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }

    $conn1->close();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Watches</title>
    <link rel="shortcut icon" href="newlogo1.png">
    <link rel="stylesheet" href="productform.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="container">
        <div class="navigation active">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img id="image" src="newlogo1.png" alt="">
                        </span>
                        <span class="title">Admin Panel</span>
                    </a>
                </li>

                <li>
                    <a href="admin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="admin_order.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="admin_pro.php">
                        <span class="icon">
                            <ion-icon name="cube-outline"></ion-icon>
                        </span>
                        <span class="title">Products</span>
                    </a>
                </li>

                <li>
                    <a href="admin_msgs.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main active">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
            
            <!-- Form to Add New Product -->
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="product_name" placeholder="Product Name" required>
                <input type="file" name="product_image" placeholder="Image URL" required>
                <input type="text" name="category" placeholder="Category" required>
                <input type="text" name="description" placeholder="Description" required>
                <input type="number" name="quantity" placeholder="Quantity" required>
                <input type="text" name="price" placeholder="Price" required>
                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>
    </div>


    <script src="style.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>