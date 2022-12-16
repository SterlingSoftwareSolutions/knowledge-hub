<?php include ("../../path.php"); ?>
<?php include ($ROOT_PATH . "/app/controllers/posts.php"); 
adminOnly();
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
    <link rel="stylesheet" href="../../assets/css/style.css" />

    <!-- Customer Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css" />

    <title>Admin Section - Manage Posts</title>
  </head>
  <body>
      <?php  include($ROOT_PATH . "/app/includes/adminHeader.php"); ?>
    <!-- Admin Page Wrapper -->
    <div class="admin__wrapper">

        <!-- Left Sidebar -->
        <?php  include($ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
        <!-- Left Sidebar End -->

        <!-- Admin Content -->
        <div class="admin__content">
          <div class="button__group">
            <a href="create.php" class="btn btn__big">Add Post</a>
            <a href="index.php" class="btn btn__big">Manage Post</a>
          </div>

          <div class="content">
            <h2 class="page__title">Manage Post</h2>

            <?php include ($ROOT_PATH . "/app/includes/messages.php");?>


            <table>
              <thead>
                <th>SN</th>
                <th>Title</th>
                <th>Author</th>
                <th colspan="3">Action</th>
              </thead>
              <tbody>
                 <?php foreach ($posts as $key => $post): ?>

                  <tr>
                  <td><?php echo $key  ?></td>
                  <td> <?php echo $post['title']?></td>
                  <td>Mhm</td>
                  <td><a href="edit.php?id=<?php echo $post['id'];?>" class="edit">Edit</a></td>
                  <td><a href="edit.php?delete_id=<?php echo $post['id'];?>" class="delete">Delete</a></td>
                    <?php if ($post ['published']): ?>
                  <td><a href="edit.php?published=0&p_id=<?php echo $post['id'] ?>" class="unpublish">Unpublish</a></td>
                  <?php else: ?>  
                  <td><a href="edit.php?published=1&p_id=<?php echo $post['id'] ?>" class="publish">Publish</a></td>
                  <?php endif; ?>
                <tr>
                  <?php endforeach; ?>
               
             
              </tbody>
            </table>

          </div>

        </div>
        <!-- Admin Content End -->

    </div>
    <!-- Admin Page Wrapper End -->

    <!-- JQuery -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.slim.min.js"
      integrity="sha512-yBpuflZmP5lwMzZ03hiCLzA94N0K2vgBtJgqQ2E1meJzmIBfjbb7k4Y23k2i2c/rIeSUGc7jojyIY5waK3ZxCQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <!-- CKeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

    <!-- Custome Script -->
    <script src="../../assets/js/script.js"></script>
  </body>
</html>
