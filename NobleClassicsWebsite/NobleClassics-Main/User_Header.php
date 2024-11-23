<?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
            <span>'.$message.'</span>
            <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
        </div>
    ';    
    } 
}
?>

<header class="user_header">
  <div class="header_1">
    <div class="user_flex">
      <div class="logo_cont">
        <img src="book_logo.png" alt="">
        <a href="Home.php" class="book_logo">NobleClassics</a>
      </div>

      <nav class="navbar">
        <a href="Home.php">HOME</a>
        <a href="About.php">ABOUT</a>
        <a href="Shop_System.php">BOOKS</a>
        <a href="Contact.php">CONTACT</a>
        <a href="Order_System.php">ORDERS</a>
      </nav>

      <div class="last_part">
        <div class="loginorreg">
          <p>
            <a href="Login.php" 
               style="color: #af6949; text-decoration: none; letter-spacing: 1px;" 
               onmouseover="this.style.color='#d2a679'; this.style.textDecoration='underline';" 
               onmouseout="this.style.color='#af6949'; this.style.textDecoration='none';">Login</a>
            ◢◤ 
            <a href="Register.php" 
               style="color: #af6949; text-decoration: none; letter-spacing: 1px;" 
               onmouseover="this.style.color='#d2a679'; this.style.textDecoration='underline';" 
               onmouseout="this.style.color='#af6949'; this.style.textDecoration='none';">Register</a>
          </p>
        </div>
      </div>
  
      <div class="icons">
    <!-- Search Icon -->
    <a href="Search_Bar.php" style="text-decoration: none;">
        <img src="search_bar_icon.png" alt="Search" style="width: 24px; height: 24px;" 
             onmouseover="this.style.filter='brightness(0.8)';" 
             onmouseout="this.style.filter='brightness(1)';">
    </a>

    <!-- User Icon -->
    <div id="user_btn">
        <img src="user_icon.png" alt="User" style="width: 24px; height: 24px;" 
             onmouseover="this.style.filter='brightness(0.8)';" 
             onmouseout="this.style.filter='brightness(1)';">
    </div>

    <?php
    $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
    $cart_row_number = mysqli_num_rows($select_cart_number);
    ?>

    <!-- Shopping Cart Icon -->
    <a href="Cart_System.php" style="text-decoration: none;">
        <img src="shopping_cart_icon.png" alt="Cart" style="width: 24px; height: 24px;" 
             onmouseover="this.style.filter='brightness(0.8)';" 
             onmouseout="this.style.filter='brightness(1)';">
             <span class="quantity" onmouseover="this.style.color='#4E342E'" onmouseout="this.style.color='#fff'"><?php echo $cart_row_number ?></span>

    </a>

    <!-- Menu Icon -->
    <div id="user_menu_btn">
        <img src="menu-icon.png" alt="Menu" style="width: 24px; height: 24px;" 
             onmouseover="this.style.filter='brightness(0.8)';" 
             onmouseout="this.style.filter='brightness(1)';">
    </div>
</div>


    <div class="header_acc_box">
      <p>Username : <span><?php echo $_SESSION['user_name'];?></span></p>
      <p>Email : <span><?php echo $_SESSION['user_email'];?></span></p>
      <a href="Logout.php" class="delete-btn">Logout</a>
    </div>

  </div>
</header>
