<?php

session_start();
include '../config.php'; // Correct path for config file

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
   header('location: ../login.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom Admin CSS File Link -->
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- Admin Dashboard Section Starts -->

<section class="dashboard">
   <h1 class="title">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('Query failed');
            while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
               $total_pendings += $fetch_pendings['total_price'];
            }
         ?>
         <h3>$<?php echo htmlspecialchars($total_pendings); ?>/-</h3>
         <p>Total Pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('Query failed');
            while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
               $total_completed += $fetch_completed['total_price'];
            }
         ?>
         <h3>$<?php echo htmlspecialchars($total_completed); ?>/-</h3>
         <p>Completed Payments</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT id FROM `orders`") or die('Query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo htmlspecialchars($number_of_orders); ?></h3>
         <p>Orders Placed</p>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT id FROM `products`") or die('Query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo htmlspecialchars($number_of_products); ?></h3>
         <p>Products Added</p>
      </div>

      <div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT id FROM `users` WHERE user_type = 'user'") or die('Query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo htmlspecialchars($number_of_users); ?></h3>
         <p>Normal Users</p>
      </div>

      <div class="box">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT id FROM `users` WHERE user_type = 'admin'") or die('Query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo htmlspecialchars($number_of_admins); ?></h3>
         <p>Admin Users</p>
      </div>

      <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT id FROM `users`") or die('Query failed');
            $number_of_accounts = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo htmlspecialchars($number_of_accounts); ?></h3>
         <p>Total Accounts</p>
      </div>

      <div class="box">
         <?php 
            $select_messages = mysqli_query($conn, "SELECT id FROM `message`") or die('Query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo htmlspecialchars($number_of_messages); ?></h3>
         <p>New Messages</p>
      </div>

   </div>
</section>

<!-- Admin Dashboard Section Ends -->

<!-- Custom Admin JS File Link -->
<script src="../js/admin_script.js"></script>

</body>
</html>
