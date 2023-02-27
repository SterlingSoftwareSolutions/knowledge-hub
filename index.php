<?php
include("path.php");
include($ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$filtered_Posts = array();
$postsTitle = 'Recent Posts';
if (isset($_GET['t_id'])) {
  $posts = getPostsByTopicId($_GET['t_id']);
  $postsTitle = "You searched for posts under'" . $_GET['name']  . "'";
} else if (isset($_POST['search__term'])) {
  $postsTitle = "You searched for '" . $_POST['search__term'] . "'";
  $posts = SearchPosts($_POST['search__term']);
} else {
  $posts = getPublishedPosts();
}

if (isset($_SESSION['admin'])) {
  if ($_SESSION['admin']) {
    foreach ($posts as $key => $post) {
      $filtered_Posts[$key] =  $post;
    }
  }
  else{
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

  <!-- Custom Styling -->
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>Blog</title>
</head>

<body>
  <?php include($ROOT_PATH . "/app/includes/header.php") ?>
  <?php include($ROOT_PATH . "/app/includes/messages.php") ?>
  <!-- Page Wrapper -->
  <div class="page__wrapper">
    <!-- Post Slider -->
    <div class="post__slider">
      <h1 class="slider__title">Latest Articles</h1>
      <div class="post__wrapper">
        <?php
        foreach ($posts as $post) :
       ?>
          <div class="post">
            <div class="post__info" style="height: auto;">
              <h4>
                <a href="single.php?id=<?php echo $post['id']; ?>"><?php echo html_entity_decode(substr($post['title'], 0, 20) . '..'); ?>
              </h4>
              <i class="far fa-user"> &nbsp;<?php echo $post['username'] ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo  date('F j, Y', strtotime(($post['created_at']))) ?></i>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- Post Slider End-->
    </div>
    <!-- Content  -->
    <div class="content clearfix">
      <div class="main__content">
        <h1 class="recent__post__title"><?php echo $postsTitle ?> </h1>
        <?php foreach ($posts as $post) : ?>
          <div class="post clearfix">
            <div class="post__preview">
              <h2>
                <a href="single.php?id=<?php echo $post['id']; ?>"><?php echo html_entity_decode(substr($post['title'], 0, 60) . '...'); ?></a>
              </h2>
              <i class="far fa-user">&nbsp;<?php echo $post['username'] ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo  date('F j, Y', strtotime(($post['created_at']))) ?></i>
              <p class="preview__text">
                <?php echo html_entity_decode(substr($post['body'], 0, 80) . '...'); ?>
              </p>
              <a href="single.php?id=<?php echo $post['id'] ?>" class="btn read__more">Read More</a>
            </div>
          </div>
        <?php endforeach; ?>
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

  <!-- Slick Carosal -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Custom Script -->
  <script src="./assets/js/script.js"></script>

</body>

</html>