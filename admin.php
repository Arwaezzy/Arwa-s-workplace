<?php

include 'config.php';


$revenue = mysqli_query($conn1, "SELECT SUM(price) FROM `orders`;");
$col1 = mysqli_fetch_array($revenue);
$sum = $col1[0];
$revenueString = strval($sum);
$profit=(floatval($revenueString) * 60) / 100;


$sales=mysqli_query($conn1,"SELECT id FROM `orders` ORDER BY id DESC LIMIT 1;");
$col2 = mysqli_fetch_array($sales);
$sum2 = $col2[0];
$salesString = strval($sum2);

$users=mysqli_query($conn1, "SELECT * FROM `ams_signin` ORDER BY `id` DESC LIMIT 10;");
$all_products=mysqli_query($conn1, "SELECT * FROM `orders` ORDER BY `id` DESC LIMIT 10;");

$totalOrders = mysqli_fetch_assoc(mysqli_query($conn1, "SELECT COUNT(*) AS total_orders FROM `orders`;"))['total_orders'];

$customerscount = mysqli_fetch_assoc(mysqli_query($conn1, "SELECT COUNT(*) AS total_customers FROM `ams_signin`;"))['total_customers'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Images/Logo.png">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation active">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img id="image"src="newlogo1.png" alt="">
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
                    <a href="logout.php">
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

                <div class="user">
                    <img src="Images/customer02.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalOrders?></div>
                        <div class="cardName">Total Sales</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">₹<?php echo $revenueString?></div>
                        <div class="cardName">Total Revenue</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">₹<?php echo $profit; ?></div>
                        <div class="cardName">Earning</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $customerscount; ?></div>
                        <div class="cardName">Customers</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <a href="admin_order.php" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Costumer Id</td>
                                <td>Product Name</td>
                                <td>Price</td>
                                <td>Payment</td>
                                <td>Quantity</td>
                                <td>Date</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($all_products)) {
                            ?>
                            <tr>
                                <td><?php echo$row['id'] ;?></td>
                                <td><?php echo$row['user_id'] ;?></td>
                                <td><?php echo$row['product_name'] ;?></td>
                                <td><?php echo$row['price'] ;?></td>
                                <td><?php echo$row['payment_method'] ;?></td>
                                <td><?php echo$row['quantity'] ;?></td>
                                <td><?php echo$row['date'] ;?></td>
                                <td><?php echo$row['payment_status'] ;?></td>
                                
                            </tr>
                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table>
                    <thead>
                            <tr>
                                <td>id</td>
                                <td>Costumer Name</td>
                            </tr>
                        </thead>
                        <?php
                        while($user = mysqli_fetch_assoc($users))
                        {
                        ?>
                        <tr>
                            <td>
                                <h4><?php echo $user['id'];?></h4>
                            </td>
                            <td>
                                <h4><?php echo $user['username'];?></h4>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="style.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>