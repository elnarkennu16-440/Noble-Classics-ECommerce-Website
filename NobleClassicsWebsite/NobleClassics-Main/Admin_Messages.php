<?php
include 'Config.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:Login.php');
}

if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];
  mysqli_query($conn,"DELETE FROM `message` WHERE id='$delete_id'");
  $message[]='1 message has been deleted';
  header("location:Admin_Messages.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages</title>
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

<section class="admin_messages">
  <div class="admin_box_container">
    <?php
      $select_msgs=mysqli_query($conn,"SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_msgs)>0){
        while($fetch_msgs=mysqli_fetch_assoc($select_msgs)){  
    ?>
    <div class="admin_box" style="background:#3f093a; border-radius: 30px; height: 400px; margin-top: 20px;">
      <p style="color:aliceblue; margin-bottom: 20px;">Name : <span style="color:blanchedalmond"><?php echo $fetch_msgs['name']; ?></span></p>
      <p style="color:aliceblue; margin-bottom: 20px;">Number : <span style="color:blanchedalmond"><?php echo $fetch_msgs['number']; ?></span></p>
      <p style="color:aliceblue; margin-bottom: 20px;">Email : <span style="color:blanchedalmond"><?php echo $fetch_msgs['email']; ?></span></p>
      <p style="color:aliceblue; margin-bottom: 20px;">Message : <span style="color:blanchedalmond"><?php echo $fetch_msgs['message']; ?></span></p>
      <a href="Admin_Messages.php?delete=<?php echo $fetch_msgs['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');" class="delete-btn" style="background:#62318d; border-radius: 10px; margin-top: 140px;" onmouseover="this.style.background='#3b1a73';" onmouseout="this.style.background='#62318d';">Delete Message</a>
    </div>
    <?php
      };
    }
    else{
      echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">You Have No Messages Yet</p>';
    }
    ?>
  </div>
</section>

<script src="Admin.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>