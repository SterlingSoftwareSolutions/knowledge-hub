<?php include ("path.php") ?>
<?php include($ROOT_PATH . "/app/controllers/users.php");
guestOnly();
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

    <title>Register</title>
  </head>
  <body>  
  <?php include($ROOT_PATH . "/app/includes/header.php") ?>
    <div class="auth__content">
        <form action="register.php" method="post">
            <h2 class="form__title">Register</h2>

     <?php include($ROOT_PATH . "/app/helpers/formErrors.php"); ?>
 

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
                <input type="password" name="passwordConf" value="<?php echo $passwordConf ?>" class="text__input">
            </div>
            <div>
                <button type="submit" name="register-btn" class="btn btn__big">Register</button>
            </div>
            <p>Or <a href="<?php echo $BASE_URL . '/login.php' ?>">Sign in</a></p>
        </form>
    </div>

    <!-- JQuery -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.slim.min.js"
      integrity="sha512-yBpuflZmP5lwMzZ03hiCLzA94N0K2vgBtJgqQ2E1meJzmIBfjbb7k4Y23k2i2c/rIeSUGc7jojyIY5waK3ZxCQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <!-- Custome Script -->
    <script src="./assets/js/script.js"></script>
  </body>
</html>
