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
  <title>About Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

</head>
<body>
  
<?php
include 'User_Header.php';
?>
<section class="about_cont">
    <img src="About1.jpg" alt="">
    <div class="about_descript">
      <h2>About Us?</h2>
      <p>At Noble Classics, we specialize in bringing timeless literary works to readers who appreciate the beauty of classic literature. Our carefully curated collection includes a wide range of classic novels, plays, and poetry, offering something for every reader's taste. Whether you're a long-time fan or new to classic books, we have the perfect read for you.

Our team consists of passionate book lovers who are always happy to recommend titles or guide you to hidden gems in our collection. We believe in the power of books to bring people together, which is why we host regular events like book clubs and author meet-ups to create a sense of community.

Shopping with us is easy and convenient. Our online store allows you to browse, explore, and order books from the comfort of your home. We ensure a smooth shopping experience with secure transactions and fast deliveries.
    </p>
    </div>
  </section>

  <section class="questions_cont">
    <div class="questions">
    <h2>Have Any Questions?</h2>
    <p>At NobleClassics, we value your satisfaction and strive to provide exceptional customer service. If you have any questions, concerns, or inquiries, our dedicated team is here to assist you every step of the way.</p>
    <button class="product_btn" onclick="window.location.href='Contact.php'">Contact Us</button>
    </div>
    
  </section>

<?php
include 'Footer.php';
?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

<script src="Script.js"></script>

</body>
</html>