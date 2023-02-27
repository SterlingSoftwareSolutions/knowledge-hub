<?php include("path.php") ?>
<?php include($ROOT_PATH . '/app/controllers/posts.php');
$newpost;
if (isset($_GET['id'])) {
  $post = selectOne('posts', ['id' =>  $_GET['id']]);
  $newpost = $post;
  $images_for_the_post = selectAll('uploads', ['postId' => $_GET['id']]);
}
$filtered_Posts = array();
$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);

if (isset($_SESSION['admin'])) {

  if ($_SESSION['admin']) {

    foreach ($posts as $key => $post) {
      $filtered_Posts[$key] =  $post;
    }
  } else {

    foreach ($posts as $key => $post) {
      if ($post['isAdmin'] == 0) {
        $filtered_Posts[$key] = $post;
      }
    }
  }
} else {
  foreach ($posts as $key => $post) {
    if ($post['isAdmin'] == 0) {
      $filtered_Posts[$key] = $post;
    }
  }
}
$posts = array();

$posts =  $filtered_Posts;
// dd($post);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora:wght@600&display=swap" rel="stylesheet" />

  <!-- Customer Styling -->
  <link rel="stylesheet" href="./assets/css/style.css" />

  <title><?php echo $newpost['title']; ?>| KnowledgeHub </title>
</head>

<body>
  <?php include($ROOT_PATH . "/app/includes/header.php")  ?>

  <!-- Page Wrapper -->
  <div class="page__wrapper">
    <!-- Main Content -->
    <div class="content clearfix">
      <!-- Main Content Wrapper -->
      <div class="main__content__wrapper">
        <div class="main__content single">
          <!-- Title  -->
          <h1 class="post__title"><?php echo $newpost['title']; ?></h1>
          <div class="post__content">
            <!-- Body  -->
            <?php echo html_entity_decode($newpost['body']);  ?>
            <!-- image  -->
            <?php
            foreach ($images_for_the_post as $key => $image) {
              $imageURL = $BASE_URL . '/assets/images/' . $image["images"]; ?>
              <img src="<?php echo  $imageURL; ?>" alt="" style="max-width:100%; height:auto" />
            <?php } ?>
            <br>
            <!-- Video -->
            <?php
            if (!empty($newpost['video'])) {
              echo '<video controls autoplay loop style="border-radius: 15px; max-width:100%; height:auto;"><source src="' . $BASE_URL . '/assets/videos/' . $newpost['video'] . '"></video>';
            } else {
              echo '';
            }
            ?>
          </div>
        </div>
      </div>


      <!-- Sidebar -->
      <div class="sidebar single">
        <div class="section popular">
          <h2 class="section__title">Popular</h2>
          <?php foreach ($posts as $p) : ?>
            <div class="post clearfix">
              <a href="single.php?id=<?php echo $p['id']; ?>" class="title">
                <h4><?php echo html_entity_decode(substr($p['title'], 0, 60) . '..'); ?></h4>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="section topics">
          <h2 class="section__title">Topics</h2>
          <ul>
            <?php foreach ($topics as $topic) : ?>
              <li><a href="<?php echo $BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.slim.min.js" integrity="sha512-yBpuflZmP5lwMzZ03hiCLzA94N0K2vgBtJgqQ2E1meJzmIBfjbb7k4Y23k2i2c/rIeSUGc7jojyIY5waK3ZxCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Slick Carousal -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Custom Script -->
  <script src="./assets/js/script.js"></script>
</body>

</html>