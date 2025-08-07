<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="shop.php">shop</a>
         <a href="contact.php">contact</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="login.php">login</a>
         <a href="register.php">register</a>
         <a href="cart.php">cart</a>
         <a href="orders.php">orders</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
         <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
         <p> <i class="fas fa-envelope"></i> Littlenest01@gmail.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> Mumbai, india - 400104 </p>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>


   

   
<!-- Dialogflow Chatbot -->
<div id="chat-frame-container" style="position: fixed; bottom: 90px; right: 20px; width: 350px; height: 430px; display: none; z-index: 9999; box-shadow: 0px 0px 10px rgba(0,0,0,0.3); border-radius: 10px; overflow: hidden;">
    <df-messenger
        chat-icon="https://media.istockphoto.com/vectors/robot-icon-chat-bot-sign-for-support-service-concept-chatbot-flat-vector-id1060696342?k=6&m=1060696342&s=612x612&w=0&h=WyTzrw3UErF6Qw9jbTrqQoQw3P_xHGmkb3UsQLV2Kp4="
        intent="WELCOME"
        chat-title="Bubu"
        agent-id="70767152-9013-4a97-acf1-bedae0c07a00"
        language-code="en">
    </df-messenger>
</div>

<!-- Chat Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatButton = document.getElementById('chat-button');
    const chatFrameContainer = document.getElementById('chat-frame-container');

    chatButton.addEventListener('click', function() {
        chatFrameContainer.style.display = 
            chatFrameContainer.style.display === 'block' ? 'none' : 'block';
    });
});
</script>

<!-- OPTIONAL: Kommunicate Script -->
<!-- Uncomment if you want Kommunicate chatbot as well -->

<script type="text/javascript">
  (function(d, m){
    var kommunicateSettings = {
      "appId": "22bfbe46b969800ec6bbeeb625deae9b9",
      "popupWidget": true,
      "automaticChatOpenOnNavigation": true
    };
    var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
    s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
    var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
    window.kommunicate = m; m._globals = kommunicateSettings;
  })(document, window.kommunicate || {});
</script>


   


   
   
      
   <p class="credit"> &copy; copyright  @ <?php echo date('Y'); ?> by <span>Little_Nest</span> </p>

</section>