<?php include ("../../path.php"); ?>
<?php include($ROOT_PATH . "/app/controllers/users.php");
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

    <title>Admin Section - Add User</title>
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
            <a href="create.php" class="btn btn__big">Add Users</a>
            <a href="index.php" class="btn btn__big">Manage Users</a>
          </div>

          <div class="content">
            <h2 class="page__title">Edit Users</h2>

            <?php include($ROOT_PATH  . "/app/helpers/formErrors.php"); ?> 

            <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="text__input">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="text__input">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" value="<?php echo $password; ?>" class="text__input">
                </div>
                <div>
                    <label>Password Confirmation</label>
                    <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text__input">
                </div>
                <div>

                <?php if (isset($admin)&& $admin == 1):?>
                  <label>
                      <input type="checkbox" name="admin" checked>
                      Admin
                    </label>
                  <?php else :  ?>
                    <label>
                      <input type="checkbox" name="admin">
                      Admin
                    </label>
                    <?php endif;  ?>
                   
                </div>

                <div>
                    <button type="submit" name="update-user" class="btn btn__big">Update User</button>
                </div>
            </form>

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
