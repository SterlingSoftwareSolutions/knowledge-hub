<header>
      <a href="<?php echo $BASE_URL . '/index.php' ?>" class="logo">
        <h1 class="logo__text"><span>Knowledge </span>Hub</h1>
        </a>
      <i class="fa fa-bars menu__toggle"></i>
      <ul class="nav">
        <li><a href="<?php echo $BASE_URL . '/index.php' ?>">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
 
        <?php if (isset($_SESSION['id'])): ?>

          <li>
          <a href="#">
            <i class="fa fa-user"></i>
            <?php echo $_SESSION['username']; ?>           
            <i class="fa fa-chevron-down" style="font-size: 0.8em"></i>
          </a>
          <ul>
          <?php if($_SESSION['admin']): ?>  <!--if user is an admin display dashborad else only show the log out -->
            <li><a href="<?php echo $BASE_URL . '/admin/dashboard.php' ?>">Dashbord</a></li>
            <?php endif; ?>
            <li><a href="<?php echo $BASE_URL . '/logout.php'   ?>" class="logout">Logout</a></li>
          </ul>  
          
        </li>
        <?php else: ?>
        
        <li><a href="<?php echo $BASE_URL . '/register.php' ?>">Sign Up</a></li>
            <li><a href="<?php echo $BASE_URL . '/login.php' ?>">Login</a></li> 
       
          <?php endif; ?>




      </ul>
    </header>