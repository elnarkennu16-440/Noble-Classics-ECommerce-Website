<?php
include 'Config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:Login.php');
}

if (isset($_POST['add_to_cart'])) {
  $pro_name = $_POST['product_name'];
  $pro_price = $_POST['product_price'];
  $pro_quantity = $_POST['product_quantity'];
  $pro_image = $_POST['product_image'];

  $check = mysqli_query($conn, "SELECT * FROM `cart` where name='$pro_name' and user_id='$user_id'") or die('query failed');

  if (mysqli_num_rows($check) > 0) {
    $message[] = 'Already added to cart!';
  } else {
    mysqli_query($conn, "INSERT INTO `cart`(user_id,name,price,quantity,image) VALUES ('$user_id','$pro_name','$pro_price','$pro_quantity','$pro_image')") or die('query2 failed');
    $message[] = 'Product added to cart!';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

</head>

<body>

  <?php
  include 'User_Header.php';
  ?>

  <section class="home_cont">
    <div class="main_descrip">
      <h1 style="color:antiquewhite;">Noble Classics</h1>
      <p>Best Noble Deals, You're Choice, You're Click</p>
      <button onclick="window.location.href='Shop_System.php';">SHOP NOW!</button>
    
    </div>
  </section>

  <section class="products_cont">
    <div class="pro_box_cont">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');

      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {

      ?>
          <form action="" method="post" class="pro_box">
            <img src="./Book_Images/<?php echo $fetch_products['image']; ?>" alt="">
            <h3><?php echo $fetch_products['name']; ?></h3>
            <p>₱. <?php echo $fetch_products['price']; ?></p>
          
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'] ?>">
            <input type="number" name="product_quantity" min="1" value="1">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

            <input type="submit" value="Add to Cart" name="add_to_cart" class="product_btn">

          </form>

      <?php
        }
      } else {
        echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">No Products are Available Yet..</p>';
      }
      ?>
    </div>
  </section>

  <section class="about_cont">
    <img src="About.png" alt="">
    <div class="about_descript">
      <h2 style="font-family: 'Lato', sans-serif;font-size:32px; font-weight: bold; font-style: italic;">Discover NobleClassics</h2>
      <p>At NobleClassics, we are passionate about connecting readers with captivating stories, inspiring ideas, and a world of knowledge. Our bookstore is more than just a place to buy books; it's a haven for book enthusiasts, where the love for literature thrives.
    </p>
    <button class="product_btn" onclick="window.location.href='About.php';">Read More</button>
    </div>
  </section>


  <section class="careerbox-section" style="display: flex; justify-content: space-between; gap: 20px; margin: 40px 0; flex-wrap: wrap;">
  <!-- Left Box (Popular Classic Books with Single Image) -->
<div style="flex: 1; max-width: 48%; padding: 20px; border: 3.5px solid #8f6414; border-radius: 10px; min-height: 338px; font-size: 16px; line-height: 30px; position: relative; box-sizing: border-box; margin-top: 70px; margin-left: 30px; margin-bottom: 30px; background-color: #2b1b03; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
  <span style="width: 120px; height: 120px; display: inline-block; background: #ba5f27ad; border-radius: 50%; line-height: 120px; margin-top: -89px; position: absolute; left: 50%; transform: translateX(-50%); text-align: center;">
    <img src="" alt="">
  </span>

  <!-- Single Image -->
  <div style="display: flex; justify-content: center; align-items: center; margin-top: 200px; height: 220px; width:fit-content">
    <img src="Book_Images/Book_Features_Img.jpg" alt="" style="width: 90%; max-width: 700px; height: auto; border-radius: 20px; object-fit: cover; margin-top: 550px;">
  </div>
</div>


<!-- Right Box (Coming Soon Books with Carousel) -->
<div style="flex: 1; max-width: 48%; padding: 20px; border: 3.5px solid #8f6414; border-radius: 10px; min-height: 338px; font-size: 16px; line-height: 20px; position: relative; box-sizing: border-box; margin-top: 70px; margin-right: 30px; margin-bottom: 30px; background-color: #2b1b03; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
  <span style="width: 120px; height: 120px; display: inline-block; background: #ba5f27ad; border-radius: 50%; line-height: 120px; margin-top: -89px; position: absolute; left: 50%; transform: translateX(-50%); text-align: center;">
    <img src="" alt="" style="width: 100%; height: 100%; border-radius: 50%;">
  </span>
  <h2 style="font-size: 30px; margin-top: 50px; text-align: center; color: white;"></h2>

  <div id="carouselContainer" style="overflow: hidden; position: relative; width: 100%; display: flex; justify-content: center;">
    <div id="carouselSlider" style="display: flex; transition: transform 0.5s ease;">
      <!-- Slider Images -->
      <div class="slider-img-container">
        <img src="Book_Images/PrideAndPrejudiceBook1.jpg" alt="Pride and Prejudice" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/1984Book2.jpg" alt="1984" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/ToKillAMockingBirdBook3.jpg" alt="To Kill A Mocking Bird" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/MobyDickBook4.jpg" alt="Moby Dick" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/TheGreatGatsbyBook5.jpg" alt="The Great Gatsby" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/JaneEyreBook6.jpg" alt="Jane Eyre" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/CrimeAndPunishmentBook7.jpg" alt="Crime and Punishment" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/TheCatcherInTheRyeBook8.jpg" alt="The Catcher in the Rye" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/ThePictureOfDorianGrayBook9.jpg" alt="The Picture of Dorian Gray" class="slider-img">
      </div>
      <div class="slider-img-container">
        <img src="Book_Images/LesMiserablesBook10.jpg" alt="Les Miserables" class="slider-img">
      </div>
    </div>
  </div>
</div>

<!-- Add the CSS -->
<style>
 #carouselContainer {
  width: 50%;
  overflow: hidden;
  position: relative;
  padding-top: 20px;  /* Adjust space above the carousel */
}

#carouselSlider {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.slider-img-container {
  min-width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.slider-img {
  width: 100%;
  height: auto;
  object-fit: cover;  /* Ensures images maintain their aspect ratio */
}

#carouselPrev,
#carouselNext {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  font-size: 20px;
  z-index: 2;
}

#carouselPrev {
  left: 10px;
}

#carouselNext {
  right: 10px;
}

h2 {
  font-size: 30px;
  margin-top: 50px;
  text-align: center;
  color: white;
}

.slider-container {
  width: 100%;
  height: 100%;
  position: relative;
}

</style>

<!-- Add the JavaScript -->
<script>
 // JavaScript for carousel functionality
let currentIndex = 0;

const images = document.querySelectorAll('.slider-img-container');
const totalImages = images.length;
const carouselSlider = document.getElementById('carouselSlider');

const prevButton = document.createElement('button');
prevButton.id = 'carouselPrev';
prevButton.innerHTML = '‹';
carouselSlider.parentElement.appendChild(prevButton);

const nextButton = document.createElement('button');
nextButton.id = 'carouselNext';
nextButton.innerHTML = '›';
carouselSlider.parentElement.appendChild(nextButton);

function showImage(index) {
  if (index >= totalImages) {
    currentIndex = 0;
  } else if (index < 0) {
    currentIndex = totalImages - 1;
  } else {
    currentIndex = index;
  }
  carouselSlider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

// Button actions
prevButton.addEventListener('click', () => {
  showImage(currentIndex - 1);
});

nextButton.addEventListener('click', () => {
  showImage(currentIndex + 1);
});

// Auto slide functionality
setInterval(() => {
  showImage(currentIndex + 1);
}, 5000); // Change image every 5 seconds

</script>



  <section class="questions_cont">
    <div class="questions">
    <h2 style="font-family: 'Lato', sans-serif;font-size:32px;font-weight: bold;font-style: italic;">Queries?</h2>
    <p>At NobleClassics, we value your satisfaction and strive to provide exceptional customer service. If you have any questions, concerns, or inquiries, our dedicated team is here to assist you every step of the way.</p>
    <button class="product_btn" onclick="window.location.href='Contact.php';">Contact Us</button>
    </div>
    
  </section>


  <?php
  include 'Footer.php';
  ?>
  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

  <script src="Script.js"></script>

</body>

</html>