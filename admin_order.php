<?php

include 'config.php';
$all_products = mysqli_query($conn1, "SELECT * FROM `orders` ORDER BY `id` DESC ;");

if (isset($_GET['delete'])) {
    $name = $_GET['delete'];
    mysqli_query($conn1, "DELETE FROM `orders` WHERE `name` = '$name'");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ams Watches</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="newlogo1.png">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="admin_order.css">
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
            </div>
            <div class="details">
                <div class="recentOrders">
                    <div class="search">
                        <label>
                            <input type="text" id="searchinput" onkeyup="search()" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>
                    
                    <div class="cardHeader">
                        <h2>All Orders</h2>
                    </div>

                    <table id="table">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Product Name</td>
                                <td>Description</td>
                                <td>price</td>
                                <td>Quantity</td>
                                <td>Address</td>
                                <td>Payment Method</td>
                                <td>Payment Status</td>
                                <td>Date</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($all_products)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['payment_method']; ?></td>
                                    <td><?php echo $row['payment_status']; ?></td>

                                    <td><?php echo $row['date']; ?></td>
                                    
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="style.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <script>
            const search = () => {
                let filter = document.getElementById("searchinput").value.toUpperCase();
                let table = document.getElementById("table");
                let tr = table.getElementsByTagName("tr");

                for (var i = 0; i < tr.length; i++) {
                    let td = tr[i].getElementsByTagName("td")[0];

                    if (td) {
                        let value = td.textContent || td.innerHTML;

                        if (value.toUpperCase().indexOf(filter) > -1) {
                            tr[0].style.display = "";
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

           

            const currentDate = new Date();
            const tenDaysAgo = new Date();
            tenDaysAgo.setDate(currentDate.getDate() - 10);
            const lastMonth = new Date();
            lastMonth.setMonth(currentDate.getMonth() - 1);
            const sixMonthsAgo = new Date();
            sixMonthsAgo.setMonth(currentDate.getMonth() - 6);


            const filterByDate = () => {
                let filter = document.getElementById("dateFilter").value;
                let table = document.getElementById("table");
                let tr = table.getElementsByTagName("tr");

                for (var i = 0; i < tr.length; i++) {
                    let td = tr[i].getElementsByTagName("td")[5]; // Date column

                    if (filter === "all" || (td && checkDate(td.textContent, filter))) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

            const checkDate = (dateString, filter) => {
                const selectedDate = new Date(dateString);
                const currentDate = new Date();

                if (filter === "today") {
                    return compareDates(selectedDate, currentDate);
                } else if (filter === "last10days") {
                    return compareDates(selectedDate, tenDaysAgo);
                } else if (filter === "lastmonth") {
                    return compareDates(selectedDate, lastMonth);
                } else if (filter === "last6months") {
                    return selectedDate >= sixMonthsAgo;
                }

                return false;
            }

            const compareDates = (date1, date2) => {
                return date1.getFullYear() === date2.getFullYear() &&
                    date1.getMonth() === date2.getMonth() &&
                    date1.getDate() === date2.getDate();
            }

            const filterByPrice = () => {
                let filter = document.getElementById("priceFilter").value;
                let table = document.getElementById("table");
                let tr = table.getElementsByTagName("tr");

                for (var i = 0; i < tr.length; i++) {
                    let td = tr[i].getElementsByTagName("td")[2]; // Price column

                    if (filter === "all" || (td && parseFloat(td.textContent) >= parseFloat(filter))) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        </script>

</body>

</html>