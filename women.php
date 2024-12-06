<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Watches - Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #D3D9D4;
            color: #124E66;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-left {
            text-align: left;
            display: flex;
        }
        .header-right {
            display: flex;
            text-align: right;
        }

        .logo {

            width: 6rem; /* Adjust the size as needed */
            height: 6rem;
            margin-right: 20px; /* Space between the logo and title */
        }

        .header-left h1 {
            margin: 0;
            font-family: 'Lucida Handwriting', cursive;
        }

        .slogan {
            font-family: 'Lucida handwriting', cursive;
            font-size: 18px;
            color: #124E66;
            margin-top: 30px;
	    }

        .header-right ul {
            list-style: none;
            display: flex;
            font-family: 'Lucida Handwriting', cursive;
        }
        .header-right ul li {
            margin-left: 20px;
        }
        .header-right ul li a {
            color: #124E66;
            text-decoration: none;
            font-size: 16px;
        }
        .header-right ul li a.cart-icon {
            position: relative;
            display: inline-block;
            color: #124E66;
            font-size: 14px;
            text-decoration: none;
        }
        .header-right ul li a.cart-icon::after {
            content: "";
            background-image: url('cart-icon.png');
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            width: 24px;
            height: 24px;
            position: absolute;
            top: -8px;
            right: -8px;
        }
        .header-right ul li a.cart-icon:hover::after {
            transform: scale(1.1);
        }
        .header-right ul li:last-child {
            margin-left: auto;
        }
        .header-right ul li:last-child a {
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        
        main {
            padding: 20px;
        }
        .product-grid {
            background-color: #D3D9D4;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .product-card {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: left;
            position: relative;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-card h3 {
            font-size: 20px;
            margin: 10px 0 5px 0;
        }
        .product-card p {
            font-size: 16px;
            color: #333;
            margin: 5px 0;
        }
        .product-card .star-rating {
            color: #ffa500;
            margin: 5px 0;
        }
        .product-card .price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
        .product-card .cart-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
        .product-card .buy-now {
            display: inline-block;
            padding: 10px 15px;
            background-color: #ff4500;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
        }
        .product-card .buy-now:hover {
            background-color: #ff6347;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <img src="newlogo1.png" alt="Logo" class="logo">
            <div class="header-title">
                <div class="slogan">#Her Edition</div>
            </div>
        </div>
        <div class="header-right">
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="signin.html">Sign In</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
    <section class="product-grid">
        <?php
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

        // Query to fetch products in the 'kids' category
        $all_products = mysqli_query($conn, "SELECT * FROM `pro_details` WHERE category='women' ORDER BY `id` DESC");

        // Check if any products were returned
        if (mysqli_num_rows($all_products) > 0) {
            // Fetch and display each product
            while ($row = mysqli_fetch_assoc($all_products)) {
        ?>
        <!-- Product Cards -->
        <div class="product-card" data-id="<?php echo $row['id'] ;?>">
            <img src="<?php echo $row['pro_image'] ;?>" alt="Watch 1">
            <h3><?php echo $row['pro_name'] ;?></h3>
            <p><?php echo $row['description'] ;?></p>
            <div class="star-rating">★★★★★</div>
            <div class="price">$<?php echo $row['price'] ;?></div>
            <div class="quantity-container">
                <span class="quantity-label">Select Quantity:</span>
                <select class="quantity-select1">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <a onclick="location.href='cart.html?image=uploads/products/<?php echo $row['pro_image'] ;?>&name=<?php echo $row['pro_name'] ;?>&description=<?php echo $row['description'] ;?>&price=<?php echo $row['price'] ;?>&quantity=' + document.querySelector('.quantity-select1').value" class="cart-icon">
                <img src="cart-icon.png" alt="Add to Cart" class="cart-icon">
            </a>
            <button onclick="location.href='buynow.html?image=uploads/products/<?php echo $row['pro_image'] ;?>&name=<?php echo $row['pro_name'] ;?>&description=<?php echo $row['description'] ;?>&price=<?php echo $row['price'] ;?>&quantity=' + document.querySelector('.quantity-select1').value" class="buy-now">Buy Now</button>
        </div>
        <?php 
            } // End of while loop
        } else {
            // No products found in the 'kids' category
            echo "<p>No products found in the selected category.</p>";
        }

        // Close the connection
        $conn->close();
        ?>
    </section>
</main>
   <script>
        document.querySelectorAll('.product-card').forEach((productCard) => {
            const cartIcon = productCard.querySelector('.cart-icon');
            const buyNowButton = productCard.querySelector('.buy-now');
            
            const productId = productCard.getAttribute('data-id');
            const productImage = productCard.querySelector('img').src;
            const productName = productCard.querySelector('h3').textContent;
            const productPrice = productCard.querySelector('.price').textContent;
            const quantitySelect = productCard.querySelector('.quantity-select1');
            
            cartIcon.addEventListener('click', () => {
                const quantity = quantitySelect.value;
                const productDetails = {
                    id: productId,
                    image: productImage,
                    name: productName,
                    price: productPrice,
                    quantity: quantity
                };
                
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart.push(productDetails);
                localStorage.setItem('cart', JSON.stringify(cart));
                alert('Item added to cart!');
            });

            buyNowButton.addEventListener('click', () => {
                const quantity = quantitySelect.value;
                location.href = `buynow.html?image=${encodeURIComponent(productImage)}&name=${encodeURIComponent(productName)}&price=${encodeURIComponent(productPrice)}&quantity=${encodeURIComponent(quantity)}`;
            });
        });
    </script>
</body>
</html>