<?php

include 'config.php';
$all_products = mysqli_query($conn1, "SELECT * FROM `pro_details`");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Watches</title>
    <link rel="shortcut icon" href="newlogo1.png">
    <link rel="stylesheet" href="admin_pro.css">
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
            </div>

            <div class="cardBox">

                <a href="product_detail.php">
                    <div class="card">
                        <div>
                            <div class="produ">Products </div>
                            <div class="cardName">Details</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>
                </a>
            </div>
            <a href="productform.php">Create Product</a>
            <div class="display_products">
                <div class="allproducts">
                    <table>
                        <thead>
                            <tr>
                                <td>Sr No:</td>
                                <td>Product Image</td>
                                <td>Product Name</td>
                                <td>Category</td>
                                <td>Quantity</td>
                                <td>Price</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($all_products)) {
                                $name=$row['pro_name'];
                                $qty = mysqli_query($conn1, "SELECT COUNT(*) AS name FROM `orders` WHERE `name` = '$name';");
                                if ($qty) {
                                    $data = $qty->fetch_assoc();
                                    $nameCount = $data['pro_name'];
                                }
                            ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><img src="uploads/products/<?php echo $row['pro_image']; ?>" alt=""></td>
                                    <td><?php echo $row['pro_name']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['pro_quantity']; ?></td>
                                    <td>$<?php echo $row['price']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="style.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>