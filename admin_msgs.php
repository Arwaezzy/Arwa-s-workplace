<?php

include 'config.php';
$watch_repair=mysqli_query($conn1, "SELECT * FROM `watch_repair` ORDER BY `id` DESC;");
$custom_design=mysqli_query($conn1, "SELECT * FROM `custom_design` ORDER BY `id` DESC;");
$maintenance_plan=mysqli_query($conn1, "SELECT * FROM `maintenance_plans` ORDER BY `id` DESC;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="newlogo1.png">
    <link rel="stylesheet" href="admin_msgs.css">
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
                    <a href="#">
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
        <div class="main active">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="user">
                    <img src="Images/customer02.jpg" alt="">
                </div>
            </div>
            

        <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Watch Repair</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Watch Name</td>
                                <td>Brand</td>
                                <td>Issue</td>
                                <td>Contact</td>
                                <td>Username</td>
                                <td>Date</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($watch_repair)) {
                            ?>
                            <tr>
                                <td><?php echo$row['id'] ;?></td>
                                <td><?php echo$row['watch_name'] ;?></td>
                                <td><?php echo$row['brand'] ;?></td>
                                <td><?php echo$row['issue'] ;?></td>
                                <td><?php echo$row['contact'] ;?></td>
                                <td><?php echo$row['username'] ;?></td>
                                <td><?php echo$row['submitted_at'] ;?></td>
                                
                                
                            </tr>
                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Customization</h2>
                        
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Watch Name</td>
                                <td>Watch Brand</td>
                                <td>Customization</td>
                                <td>Contact</td>
                                <td>Username</td>
                                <td>Date</td>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($custom_design)) {
                            ?>
                            <tr>
                                <td><?php echo$row['id'] ;?></td>
                                <td><?php echo$row['watch_name'] ;?></td>
                                <td><?php echo$row['watch_brand'] ;?></td>
                                <td><?php echo$row['customization'] ;?></td>
                                <td><?php echo$row['contact'] ;?></td>
                                <td><?php echo$row['cus_username'] ;?></td>
                                <td><?php echo$row['submitted_at'] ;?></td>
                               
                                
                            </tr>
                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
                </div>

                <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Maintenance plan</h2>
                        
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Watch Brand</td>
                                <td>Maintenance Plans</td>
                                <td>Contact</td>
                                <td>Username</td>
                                
                                <td>Date</td>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($maintenance_plan)) {
                            ?>
                            <tr>
                                <td><?php echo$row['id'] ;?></td>
                                <td><?php echo$row['watch_brand'] ;?></td>
                                <td><?php echo$row['maintenance_plan'] ;?></td>
                                <td><?php echo$row['contact'] ;?></td>
                                <td><?php echo$row['username'] ;?></td>
                               
                                <td><?php echo$row['submitted_at'] ;?></td>
                                
                            </tr>
                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
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
