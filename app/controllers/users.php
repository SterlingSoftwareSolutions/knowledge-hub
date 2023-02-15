<?php
include($ROOT_PATH  . "/app/database/db.php");
include($ROOT_PATH  . "/app/helpers/middleware.php");
include($ROOT_PATH  . "/app/helpers/validateUser.php");

$table = 'users';
$admin_users = selectAll($table);

$errors = array();
$username = '';
$admin = '';
$id = '';
$email = '';
$password = '';
$passwordConf = '';

function loginUser($user){
    //log user
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';

    if ($_SESSION['admin']){
      header('location: ' . '/admin/dashboard.php');
    }else{
      header('location: ' . $BASE_URL  .  '/index.php');
    }
  
    exit();

}

if (isset($_POST['register-btn']) || isset ($_POST['create-admin']))  {     //in here getting all values to $POST which are username email pw, pw con and  regsiter btn                                    
  $errors = validateUser($_POST); 

  if (count($errors) === 0) {
    unset($_POST['register-btn'], $_POST['passwordConf'],  $_POST['create-admin']); // unset using for remove the columns what we want to delete 
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT); // password encrypting which mean hiding 

    
    if(isset($_POST['admin'])){
      $_POST['admin'] = 1;               
      $user_id = create('users', $_POST);
      $_SESSION['message'] = "admin user created successfully";
      $_SESSION['type'] = "success";
      header('location: ' . $BASE_URL  . '/admin/users/index.php');
      exit();

    } else{
      $_POST['admin'] = 0;
      $user_id = create('users', $_POST);
      $user = selectOne('users', ['id' => $user_id]);
      loginUser($user);
    }

  } else{ 
    $username = $_POST['username'];
    $admin = isset($_POST['admin']) ? 1:0;
    $email = $_POST ['email'];
    $password = $_POST ['password'];
    $passwordConf = $_POST['passwordConf']; 
  }
}

if (isset($_POST['update-user'])){
  adminOnly();
  $errors = validateUser($_POST); 

  if (count($errors) === 0) {
    $id = $_POST['id'];
    unset($_POST['passwordConf'],  $_POST['update-user'], $_POST['id']); // unset using for remove the columns what we want to delete 
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT); // password encrypting which mean hiding 

    
      $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;               
      $user_id = update($table, $id, $_POST);
      $_SESSION['message'] = "admin user created successfully";
      $_SESSION['type'] = "success";
      header('location: ' . $BASE_URL  . '/admin/users/index.php');
      exit();


  } else{ 
    $username = $_POST['username'];
    $admin = isset($_POST['admin']) ? 1:0;
    $email = $_POST ['email'];
    $password = $_POST ['password'];
    $passwordConf = $_POST['passwordConf']; 
  }
}


if (isset($_GET['id'])){
  $user = selectOne($table, ['id' => $_GET['id']]);

  $username = $user['username'];
  $id = $user['id'];
  $admin = $user['admin'];
  $email = $user['email'];
}

if (isset($_POST['login-btn'])) {
  
  $errors = validateLogin($_POST);

  if (count($errors) === 0) {
    $user = selectOne('users', ['username' => $_POST['username']]);

    if ($user && password_verify($_POST['password'], $user['password'])) {
    
      loginUser($user);
    } else {
      array_push($errors, 'Wrong credentials');
    }
  }

  $username = $_POST['username'];
  $password = $_POST['password'];
}

 
if(isset($_GET['delete_id'])){
  adminOnly();
  $count = delete($table, $_GET['delete_id']);
  $_SESSION['message'] = "admin user Deleted successfully";
  $_SESSION['type'] = "success";
  header('location: ' . $BASE_URL  . '/admin/users/index.php');
  exit();
}