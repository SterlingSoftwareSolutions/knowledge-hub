<?php
include("path.php");
include($ROOT_PATH . "/app/controllers/topics.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- FontAwsome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora:wght@600&display=swap" rel="stylesheet" />

  <!-- Customer Styling -->
  <link rel="stylesheet" href="./assets/css/style.css" />

  <title>Blog</title>
</head>
<body>
  <?php include($ROOT_PATH . "/app/includes/header.php") ?>
  <?php include($ROOT_PATH . "/app/includes/messages.php") ?>
  <!-- Page Wrapper -->
<style>
  .main__content {
  font-family: 'Poppins', sans-serif;
  font-size: 1.1rem;
  line-height: 1.5;
  text-align: justify;
  color: #333;
  margin: 2rem auto;
  max-width: 800px;
  padding: 2rem;
  background-color: #f8f8f8;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
</style>
  <!-- Content  -->
  <div class="content clearfix">
    <div class="main__content">
      <h3 style="text-align:center">About Us</h3>
      Welcome to Knowledge Hub, a platform designed to empower individuals with knowledge and insights that can help them in their personal and professional lives. Our mission is to provide a space for people to learn, grow, and connect with others who share similar interests and passions.
<br><br>
      At Knowledge Hub, we understand that the world is constantly evolving and changing, and the best way to keep up is by staying informed and educated. That's why we offer a diverse range of content on topics that matter to you, from business and technology to health and wellness, and everything in between.
<br><br>
      Our website was built by Sterling Bpo Developers, a team of experienced web developers who are committed to creating websites that are both visually appealing and highly functional. 
<br><br>
      At Knowledge Hub, we are committed to provide our users with the highest quality content that is both engaging and informative. Whether you're looking to learn a new skill, stay up-to-date on industry news, or simply connect with others who share your interests, we're here to help.
<br><br>      
      We look forward to helping you grow and learn!
    </div>
    <div class="sidebar">
      <div class="section search">
        <h2 class="section__title">Search</h2>
        <form action="index.php" method="post">
          <input type="text" name="search__term" class="text__input" placeholder="Search..." />
        </form>
      </div>

      <div class="section topics">
        <h2 class="section__title">Categories</h2>
        <ul>
          <?php foreach ($topics as $key => $topic) :   ?>
            <li><a href="<?php echo $BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <!-- Content End-->
  </div>

  </div>

  <!-- Page Wrapper End -->
  <?php include($ROOT_PATH . "/app/includes/footer.php") ?>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.slim.min.js" integrity="sha512-yBpuflZmP5lwMzZ03hiCLzA94N0K2vgBtJgqQ2E1meJzmIBfjbb7k4Y23k2i2c/rIeSUGc7jojyIY5waK3ZxCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Slick Carousal -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Customer Script -->
  <script src="./assets/js/script.js"></script>

</body>

</html>