<?php
session_start(); // Start session at the very top
include_once '../config.php'; // Ensure config file is included only once

// Display messages if set
if (!empty($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . htmlspecialchars($msg) . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
   }
}
?>

<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username: <span><?php echo isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Guest'; ?></span></p>
         <p>Email: <span><?php echo isset($_SESSION['admin_email']) ? htmlspecialchars($_SESSION['admin_email']) : 'Not Available'; ?></span></p>

         <?php if (isset($_SESSION['admin_id'])) { ?>
            <a href="logout.php" class="delete-btn">Logout</a>
         <?php } else { ?>
            <div>New <a href="login.php">Login</a> | <a href="register.php">Register</a></div>
         <?php } ?>
      </div>
   </div>
</header>
