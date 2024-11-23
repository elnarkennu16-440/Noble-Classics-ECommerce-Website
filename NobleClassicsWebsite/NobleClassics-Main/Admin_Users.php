<?php
include 'Config.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:Login.php');
}

if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];
  mysqli_query($conn,"DELETE FROM `register` WHERE id='$delete_id'");
  $message[]='1 user has been deleted';
  header("location:Admin_Users.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users</title>
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

<section class="admin_users">
  <div class="admin_box_container">
    <?php
      $select_users=mysqli_query($conn,"SELECT * FROM `register`");

      while($fetch_users=mysqli_fetch_assoc($select_users)){

    ?>
    <div class="admin_box" style="background:#3f093a; border-radius: 30px; width: fit-content; height: 400px; margin-top: 20px;">
      <p style="color:aliceblue; margin-bottom: 20px;">Username : <span style="color:blanchedalmond"><?php echo $fetch_users['name']?></span></p>
      <p style="color:aliceblue; margin-bottom: 20px;">Email : <span style="color:blanchedalmond"><?php echo $fetch_users['email']?></span></p>
      <p style="color:aliceblue;">Account Type : <span style="color:<?php if($fetch_users['user_type']=='admin'){echo '#ba6aff';}else{echo '#dca864';}?>"><?php echo $fetch_users['user_type']?></span></p>
      <a href="Admin_Users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="delete-btn" style="background:#62318d; border-radius: 10px; margin-top: 200px;" onmouseover="this.style.background='#3b1a73';" onmouseout="this.style.background='#62318d';">Delete Account</a>

    </div>
      <?php
        };
      ?>
    
  </div>
</section>



<script src="Admin.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>