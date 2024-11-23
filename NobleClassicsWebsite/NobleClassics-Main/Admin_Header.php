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

<header class="admin_header">
    <div class="header_navigation">
      <a href="Admin_Page.php" class="header_logo" style="color: #b7a7ff; box-shadow: 2px 2px 11px rgb(165, 165, 165); padding: 5px; border-radius: 10px;">ADMIN <span style="color: #f6bb63;">PANEL</span></a>

      <nav class="header_navbar">
        <a href="Admin_Page.php">REPORTS</a>
        <a href="Admin_Products.php">PRODUCTS</a>
        <a href="Admin_Orders.php">ORDERS</a>
        <a href="Admin_Users.php">USERS</a>
        <a href="Admin_Messages.php">MESSAGES</a>
      </nav>
      <div class="header_icons">
        <div id="menu_btn" class="fas fa-bars"></div>
        <div id="user_btn" class="fas fa-user"></div>
      </div>
      <div class="header_acc_box">
        <p>Username : <span><?php echo $_SESSION['admin_name'];?></span></p>
        <p>Email : <span><?php echo $_SESSION['admin_email'];?></span></p>
        <a href="Logout.php" class="delete-btn">Logout</a>
      </div>
    </div>
  </header>
