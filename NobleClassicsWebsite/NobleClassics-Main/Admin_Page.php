<?php
include 'Config.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:Login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Admin.css">
  <link rel="stylesheet" href="Style.css">
</head>
<body style="background: linear-gradient(to left, #33164c, #3d2606); background-size: 300% 300%; animation: gradientShift 5s ease infinite;">

  <style>
    @keyframes gradientShift {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }
  </style>


<?php
include 'Admin_Header.php';
?>

<section class="admin_dashboard">

  <div class="admin_box_container">

    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $total_pendings = 0;
        $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');

        if(mysqli_num_rows($select_pending) > 0){
          while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
            $total_price=$fetch_pendings['total_price'];
            $total_pendings+=$total_price;
          };
        };
      ?>
      <h3>₱. <?php echo $total_pendings;?></h3>
      <p>PENDING PAYMENT TRANSACTIONS</p>
    </div>

    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $total_completed = 0;
        $selectcompleted = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');

        if(mysqli_num_rows($selectcompleted) > 0){
          while($fetch_completed = mysqli_fetch_assoc($selectcompleted)){
            $total_price=$fetch_completed['total_price'];
            $total_completed+=$total_price;
          };
        };
      ?>
      <h3>₱. <?php echo $total_completed;?></h3>
      <p>COMPLETE PAYMENTS TRANSACTIONS</p>
    </div>
    
    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $select_orders=mysqli_query($conn,"SELECT * FROM `orders`") or die('query failed');
        $number_of_orders=mysqli_num_rows($select_orders);
      ?>
      <h3><?php echo $number_of_orders;?></h3>
      <p>PLACED ORDER RECORDS</p>
    </div>

    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $select_products=mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
        $number_of_products=mysqli_num_rows($select_products);
      ?>
      <h3><?php echo $number_of_products; ?></h3>
      <p>ADDED PRODUCTS RECORDS</p>
    </div>

    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $select_users=mysqli_query($conn,"SELECT * FROM `register` WHERE user_type='user'") or die('query failed');
        $number_of_users=mysqli_num_rows($select_users);
      ?>
      <h3><?php echo $number_of_users; ?></h3>
      <p>CURRENT ONLINE CUSTOMER</p>
    </div>

    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $select_admin=mysqli_query($conn,"SELECT * FROM `register` WHERE user_type='admin'") or die('query failed');
        $number_of_admin=mysqli_num_rows($select_admin);
      ?>
      <h3><?php echo $number_of_admin; ?></h3>
      <p>SYSTEM ADMINISTRATOR</p>
    </div>

    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $select_accounts=mysqli_query($conn,"SELECT * FROM `register`") or die('query failed');
        $number_of_accounts=mysqli_num_rows($select_accounts);
      ?>
      <h3><?php echo $number_of_accounts; ?></h3>
      <p>TOTAL ACCOUNTS REGISTERED</p>
    </div>

    <div class="admin_box" style="background-color: darksalmon; padding: 50px; border-radius: 80px; box-shadow: 2px 2px 10px rgb(219, 176, 254);">
      <?php
        $select_messages=mysqli_query($conn,"SELECT * FROM `message`") or die('query failed');
        $number_of_messages=mysqli_num_rows($select_messages);
      ?>
      <h3><?php echo $number_of_messages; ?></h3>
      <p>INCOMING MESSAGES RECORDS</p>
    </div>

  </div>

</section>


<script src="Admin.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>