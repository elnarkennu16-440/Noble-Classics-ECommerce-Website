<?php
include 'Config.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:Login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

</head>
<body>
  
<?php
include 'User_Header.php';
?>

<section class="orders">
  <h2 style="padding: 1.5rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; border-radius: 20px; box-shadow: 0px 4px 10px white;">Transaction Records</h2>
  <div class="orders_cont">
    <?php
    $order_query=mysqli_query($conn,"SELECT * FROM `orders` WHERE user_id='$user_id'") or die('query failed');

    if(mysqli_num_rows($order_query)>0){
      while($fetch_orders=mysqli_fetch_assoc($order_query)){

      
    ?>
    <div class="orders_box" style="box-shadow: 0px 4px 10px white; background-color: #805e49; padding: 10px; border: 1px solid #ccc; border-radius: 25px;">
      <p> Purchase Date : <span style="color: #fdc5a1;"><?php echo $fetch_orders['placed_on']; ?></span> </p>
      <p> Name : <span style="color: #fdc5a1;"><?php echo $fetch_orders['name']; ?></span> </p>
      <p> Number : <span style="color: #fdc5a1;"><?php echo $fetch_orders['number']; ?></span> </p>
      <p> Email : <span style="color: #fdc5a1;"><?php echo $fetch_orders['email']; ?></span> </p>
      <p> Address : <span style="color: #fdc5a1;"><?php echo $fetch_orders['address']; ?></span> </p>
      <p> Payment Method : <span style="color: #fdc5a1;"><?php echo $fetch_orders['method']; ?></span> </p>
      <p> Order Details : <span style="color: #fdc5a1;"><?php echo $fetch_orders['total_products']; ?></span> </p>
      <p> Total Amount : <span style="color: #fdc5a1;">₱<?php echo $fetch_orders['total_price']; ?></span> </p>
      <p> Payment Confirmation : <span style="color: #c68aff;<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
    </div>
    <?php
    }
  }else{
    echo '<p class="empty" style="padding: 1.5rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; border-radius: 20px; box-shadow: 0px 4px 10px white;">No Current Orders Yet.</p>';

  }
    ?>
  </div>
</section>

<?php
include 'Footer.php';
?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

<script src="Script.js"></script>

</body>
</html>