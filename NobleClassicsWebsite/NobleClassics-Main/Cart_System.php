<?php
include 'Config.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:Login.php');
}

if(isset($_POST['update_cart'])){
  $cart_id=$_POST['cart_id'];
  $cart_quantity=$_POST['cart_quantity'];
  mysqli_query($conn,"UPDATE `cart` SET quantity='$cart_quantity' WHERE id='$cart_id'") or die('query failed');
  $message[]='Cart Quantity Updated';
}

if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];
  mysqli_query($conn,"DELETE FROM `cart` WHERE id='$delete_id'") or die('query failed');
  header('location:Cart_System.php');
}

if(isset($_GET['delete_all'])){
  mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
  header('location:Cart_System.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">


</head>
<body>
  
<?php
include 'User_Header.php';
?>

<section class="shopping_cart">
  <h1 style="padding: 1.5rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; border-radius: 20px; box-shadow: 0px 4px 10px white;">Your Selected Items in Cart</h1>

  <div class="cart_box_cont">
    <?php
    $grand_total=0;
    $select_cart=mysqli_query($conn, "SELECT * FROM `cart` where user_id='$user_id'") or die('query failed');

    if(mysqli_num_rows($select_cart)>0){
      while($fetch_cart=mysqli_fetch_assoc(($select_cart))){


    ?>
    <div class="cart_box" style="background: linear-gradient(to bottom, #f0ce84, #886135); border-radius: 15px;">
      <a href="Cart_System.php?delete=<?php echo $fetch_cart['id'];?>" class="fas fa-times" onclick="return confirm('Are you sure you want to delete this product from cart');"></a>
      <img src="./Book_Images/<?php echo $fetch_cart['image'];?>" alt="">
      <h3><?php echo $fetch_cart['name']; ?></h3>
      <p>₱. <?php echo $fetch_cart['price']; ?></p>

      <form action="" method="post">
        <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id'];?>">
        <input type="number" name="cart_quantity" min="1" value="<?php echo $fetch_cart['quantity'];?>">
        <input type="submit" value="Update" name="update_cart" class="product_btn">
      </form>
      <p>Total : <span>₱<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?></span></p>
    </div>
    <?php
    $grand_total+=$sub_total;
      }
    }else{
      echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">Your Cart Contains No Item..</p>';
    }
    ?>
  </div>

  <div class="cart_total">
    <h2 style="color: #4E342E; font-size: 45px; font-family: monospace;">Your Total Order Amount: <span>₱. <?php echo $grand_total;?></span></h2>
    <div class="btns_cart">
    <a href="Cart_System.php?delete_all" class="product_btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Are you sure you want to delete all Cart Items from Cart?');">Delete all the Items</a>
    <a href="Shop_System.php" class="product_btn" style="background-color: #514702; border-radius: 15px; box-shadow: 0px 4px 10px rgb(193, 234, 255); font-weight: 900; padding: 15px; padding-left: 15px;">Continue Shopping?</a>
      <a href="Checkout_System.php" class="product_btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed to Checkout</a>
    </div>
  </div>
    
</section>

<?php
include 'Footer.php';
?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

<script src="Script.js"></script>

</body>
</html>