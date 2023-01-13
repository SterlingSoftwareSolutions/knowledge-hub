<?php include ("path.php") ?>
<?php include($ROOT_PATH . '/app/controllers/posts.php');
 if (isset($_GET['id'])){
  $post = selectOne('posts', ['id' =>  $_GET['id']]);
  // dd($post);
 }
$topics = selectAll('topics'); 
$posts = selectAll('posts', ['published' => 1]);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- FontAwsome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Candal&family=Lora:wght@600&display=swap"
      rel="stylesheet"
    />

    <!-- Customer Styling -->
    <link rel="stylesheet" href="./assets/css/style.css" />

    <title><?php echo $post['title'];?>| Deenspires</title>
  </head> 
  <body>
  <?php include($ROOT_PATH . "/app/includes/header.php") ?>

    <!-- Page Wrapper -->
    <div class="page__wrapper">
      <!-- Main Content -->
      <div class="content clearfix">
        <!-- Main Content Wrapper -->
        <div class="main__content__wrapper">
        <div class="main__content single">
          <!-- <h1 class="post__title"><?php echo $post['title'];?></h1> -->
         
          <div class="post__content">
            
          <!-- <?php echo html_entity_decode($post['body']);  ?> -->
        
          <video src="./assets/videos/1673501103_Beautiful sea beach 🌊🌊😍 _Nature whatsapp status _sad song whatsapp status.mp4" style="margin-left: 280px ; border-radius: 20px;" width="240px" height="170px"  controls>   </video>
          <!-- <video src="<?php echo $BASE_URL . '/assets/videos/'. $post['video'];?>" style="margin-left: 280px ; border-radius: 20px;" width="240px" height="170px"  controls>   </video> -->
          </div>
        </div>
      </div>
        <!-- Sidebar -->
        <div class="sidebar single">
          <div class="section popular">
            <h2 class="section__title">Popular</h2>

            <?php foreach ($posts as $p): ?>

              <div class="post clearfix">
            <img src="<?php echo $BASE_URL . 'assets/images/' . $p['image']; ?>" alt="" />
              <a href="#" class="title">
                <h4><?php echo $p['title'] ?></h4>  
              </a>
            </div> 
            
              <?php endforeach; ?>  

           
          </div>
          <div class="section topics">
            <h2 class="section__title">Topics</h2>
            <ul>
              <?php foreach($topics as $topic): ?>
              <li><a href="<?php echo $BASE_URL . '/index.php?t_id=' .$topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <!-- Sidebar End -->
      </div>
      <!-- Content End-->
    </div>
    <!-- Page Wrapper End -->
    <?php include($ROOT_PATH . "/app/includes/footer.php") ?>

    <!-- JQuery -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.slim.min.js"
      integrity="sha512-yBpuflZmP5lwMzZ03hiCLzA94N0K2vgBtJgqQ2E1meJzmIBfjbb7k4Y23k2i2c/rIeSUGc7jojyIY5waK3ZxCQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <!-- Slick Carosal -->
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>

    <!-- Custome Script -->
    <script src="./assets/js/script.js"></script>
  </body>
</html>
