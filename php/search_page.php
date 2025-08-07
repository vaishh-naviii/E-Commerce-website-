<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>search page</h3>
   <p> <a href="home.php">home</a> / search </p>
</div>




<form action="" method="post" id="searchForm" style="max-width: 600px; margin: 30px auto; display: flex;">
  <div style="position: relative; flex: 1;">
    <input 
      type="text" 
      name="search" 
      id="searchInput" 
      placeholder="search products..." 
      style="width: 100%; padding: 10px 40px 10px 10px; height: 45px; font-size: 16px; border: 2px solid #ccc; border-radius: 5px;" 
      required
    />
    <!-- Mic icon inside input -->
    <button 
      type="button" 
      onclick="startVoiceSearch()" 
      style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); border: none; background: transparent; cursor: pointer; font-size: 20px; color: #7e57c2;"
      aria-label="Start voice search"
    >
      🎤
    </button>
  </div>

  <!-- Submit button to right of input with gap -->
  <input 
    type="submit" 
    name="submit" 
    value="Search" 
    style="margin-left: 10px; padding: 10px 20px; background-color: #7e57c2; color: white; border: none; font-size: 16px; border-radius: 5px; cursor: pointer;"
  />
</form>




   
<style>
.search-container {
  position: relative;
  width: 400px; /* adjust width as needed */
  margin: auto;
}

#searchInput {
  width: 100%;
  padding: 10px 40px 10px 10px; /* right padding for mic */
  font-size: 16px;
  border: 2px solid #ccc;
  border-radius: 5px;
}
#searchInput:focus {
    outline: none;
    border-color: #7e57c2;
    box-shadow: 0 0 5px #7e57c2;
  }

#micIcon {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 20px;
  color: #7e57c2;
}

#searchBtn {
  margin-left: 10px;
  height: 40px;
  background: #7e57c2;
  color: white;
  border: none;
  padding: 0 20px;
  border-radius: 5px;
  cursor: pointer;
}
</style>



 

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>
   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_product['name']; ?></div>
      <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }else{
         echo '<p class="empty">search something!</p>';
      }
   ?>
   </div>
  

 


<script>
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if (!SpeechRecognition) {
   alert("Sorry, your browser doesn't support voice recognition. Use Chrome.");
} else {
   const recognition = new SpeechRecognition();
   recognition.lang = "en-US";
   recognition.interimResults = false;
   recognition.maxAlternatives = 1;

   const commands = {
      shop: "shop.php",
      orders: "orders.php",
      home: "home.php",
      contact: "contact.php",
      footer: "footer.php",
      header: "header.php",
      about: "about.php",
      cart: "cart.php"
   };
   recognition.onstart = () => {
      const searchInput = document.getElementById("searchInput");
      searchInput.placeholder = "Listening...";
      searchInput.value = "";
   };

   recognition.onresult = (event) => {
      const transcript = event.results[0][0].transcript.toLowerCase().trim();
      const searchInput = document.getElementById("searchInput");
      searchInput.value = transcript;
      searchInput.placeholder = "search products...";


      let matched = false;

      for (const cmd in commands) {
         if (transcript.includes(cmd)) {
            window.location.href = commands[cmd];
            matched = true;
            break;
         }
      }

      if (!matched) {
         // Submit the search form if no command matched
         document.getElementById("searchForm").submit();
      }
   };

  
   recognition.onerror = () => {
      const searchInput = document.getElementById("searchInput");
      searchInput.placeholder = "search products...";
   };

   recognition.onend = () => {
      const searchInput = document.getElementById("searchInput");
      searchInput.placeholder = "search products...";
   };

   window.startVoiceSearch = () => {
      recognition.start();
   };
}
</script>




</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>