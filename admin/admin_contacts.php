<?php

include '../config.php'; // Correct path to config.php
session_start();

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])){
   header('location:../login.php'); // Redirect to login outside the admin folder
   exit();
}

$admin_id = $_SESSION['admin_id'];

// Delete message functionality
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];

   // Secure query using prepared statements
   $stmt = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $stmt->bind_param("i", $delete_id);
   $stmt->execute();
   $stmt->close();

   header('location:admin_contacts.php'); // Redirect to the same page after deletion
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Messages</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Custom Admin CSS -->
   <link rel="stylesheet" href="../css/admin_style.css"> <!-- Updated path -->
</head>
<body>

<?php include 'admin_header.php'; ?> <!-- Corrected path for inclusion -->

<section class="messages">
   <h1 class="title">Messages</h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die(mysqli_error($conn));

      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
   ?>
   <div class="box">
      <p> <strong>User ID:</strong> <span><?php echo htmlspecialchars($fetch_message['user_id']); ?></span> </p>
      <p> <strong>Name:</strong> <span><?php echo htmlspecialchars($fetch_message['name']); ?></span> </p>
      <p> <strong>Number:</strong> <span><?php echo htmlspecialchars($fetch_message['number']); ?></span> </p>
      <p> <strong>Email:</strong> <span><?php echo htmlspecialchars($fetch_message['email']); ?></span> </p>
      <p> <strong>Message:</strong> <span><?php echo htmlspecialchars($fetch_message['message']); ?></span> </p>
      <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" 
         onclick="return confirm('Are you sure you want to delete this message?');" class="delete-btn">Delete Message</a>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No messages found.</p>';
      }
   ?>
   </div>
</section>

<!-- Custom Admin JS -->
<script src="../js/admin_script.js"></script> <!-- Updated path -->

</body>
</html>
