<?php
include 'Config.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:Login.php');
}
if(isset($_POST['send'])){

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $number = $_POST['number'];
  $msg = mysqli_real_escape_string($conn, $_POST['message']);
  
  $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');
  
  if(mysqli_num_rows($select_message) > 0){
     $message[] = 'Your Already Sent a Message';
  }else{
     mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
     $message[] = 'Your Message was Successfully Sent';
  }
  
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

</head>
<body>
  
<?php
include 'User_Header.php';
?>

<section class="contact_us">

<form action="" method="post" style="background: linear-gradient(to bottom, #48251c, #724f1b); border-radius: 60px; padding: 2rem; box-shadow: 0px 4px 10px white;">
   <h2 style="color: #ffffff; font-size: 2rem;">Contact Us!</h2>
   <input type="text" name="name" required placeholder="Enter your name" 
          style="border-radius: 25px; padding: 0.8rem;">
   <input type="email" name="email" required placeholder="Enter your email" 
          style="border-radius: 25px; padding: 0.8rem;">
   <input type="phone" name="number" required placeholder="Enter your number" 
          style="border-radius: 25px; padding: 0.8rem;">
   <textarea name="message" placeholder="Enter your message" id="" cols="30" rows="10" 
             style="border-radius: 25px; padding: 0.8rem;"></textarea>
   <input type="submit" value="Send Message" name="send" class="product_btn" 
          style="width: 150px; padding: 0.5rem; margin: 1rem auto; display: block; border-radius: 30px;">
</form>

</section>


<?php
include 'Footer.php';
?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

<script src="Script.js"></script>

</body>
</html>