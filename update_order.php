<?php
$id = $_GET['edit'];

include 'config.php';
$all_products = mysqli_query($conn1, "SELECT * FROM `orders` WHERE `id`='$id';");
$row = mysqli_fetch_assoc($all_products);
$user_id = $row['user_name'];
$status=$row['status'];
$userdata = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$user_id';");
$row2 = mysqli_fetch_assoc($userdata);
if (isset($_POST['Submit'])) {

  $username = $_POST["username"];
  $price = $_POST["price"];
  $quantity = $_POST["quantity"];
  $email = $_POST["email"];
  $number = $_POST["number"];
  $proname = $_POST["proname"];
  $address = $_POST["address"];
  $state = $_POST["state"];
  $city = $_POST["city"];
  $zipcode = $_POST["zipcode"];
  $date = $_POST["date"];
  $selectedOption = $_POST["progress"];

  if (empty($username) || empty($price) || empty($quantity) || empty($email) || empty($number) || empty($proname) || empty($address) || empty($state) || empty($city) || empty($zipcode) || empty($selectedOption)) {
    $message[] = 'Please fill out all fields.'; 
  } else {

    $update_data = "UPDATE `orders` SET `user_name`='$username',`name`='$proname',`price`='$price',`payment`='paid',`quantity`='$quantity',`date`='$date',`status`='$selectedOption',`address`='$address',`city`='$city',`state`='$sate',`zipcode`='$zipcode' WHERE `id`='$id';";
    $upload = mysqli_query($conn1, $update_data);
    if ($upload) {
      header('location:admin_order.php');
    } else {
      $$message[] = 'please fill out all!';
    }
  }
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slider</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="update_order.css">

</head>

<body>
  <header>
    <div class="text-box">
      <h1 id="title">Admin Panel : Order Update</h1>
      <hr>
      <p id="description">Tell us about your experience with South Park</p>
    </div>
  </header>
  <div class="container">
    <form id="survey-form" method="post">

      <div class="labels">
        <label id="id-label" for="id">* Order Id</label>
      </div>
      <div class="input-tab">
        <p>Order Id : "<?php echo $row['id'] ?>"</p>
      </div>
      <div class="labels">
        <label id="name-label" for="name">* Full Name</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="text" id="username" name="username" value="<?php echo $row['user_name'] ?>" placeholder="Enter your name" required autofocus>
      </div>

      <div class="labels">
        <label id="email-label" for="email">* Email</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="email" id="email" name="email" value="<?php echo $row2['email'] ?>" placeholder="email@email.com" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* Mobile Number</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="number" id="number" name="number" value="<?php echo $row2['mobno'] ?>" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* Order Date</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="text" id="date" name="date" value="<?php echo $row['date'] ?>" required>
      </div>


      <div class="labels">
        <label for="dropdown">Order Status</label>
      </div>
      <div class="input-tab">
        <select id="dropdown" name="progress">
          <option value="Packed" <?php if ($status === "Packed") echo "selected"; ?>>Packed</option>
          <option value="Delivered" <?php if ($status === "Delivered") echo "selected"; ?>>Delivered</option>
          <option value="Shipped" <?php if ($status === "Shipped") echo "selected"; ?>>Shipped</option>
          <option value="In Progress" <?php if ($status === "In Progress") echo "selected"; ?>>In Progress</option>
          <option value="return" <?php if ($status === "return") echo "selected"; ?>>Return In Progress</option>
        </select>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* Product</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="text" id="proname" name="proname" value="<?php echo $row['name'] ?>" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* Price</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="number" id="price" name="price" value="<?php echo $row['price'] ?>" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* Quantity</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="number" id="quantity" name="quantity" value="<?php echo $row['quantity'] ?>" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* Address</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="text" id="address" name="address" value="<?php echo $row['address'] ?>" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* State</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="text" id="state" name="state" value="<?php echo $row['state'] ?>" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* City</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="text" id="city" name="city" value="<?php echo $row['city'] ?>" required>
      </div>

      <div class="labels">
        <label id="number-label" for="number">* Zipcode</label>
      </div>
      <div class="input-tab">
        <input class="input-field" type="number" id="zipcode" name="zipcode" value="<?php echo $row['zipcode'] ?>" required>
      </div>

      <div class="btn">
        <button id="submit" name="Submit" type="submit">Submit</button>
      </div>

    </form>
  </div>
</body>

</html>