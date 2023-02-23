<?php

  function validateUser($user)
  {
    // global $conn;
    $errors = array();
    

    if (empty($user['username'])) {
      array_push($errors, 'Username is required');
    }
   
    if (empty($user['email'])) {
      array_push($errors, 'Email is required');
    }
  
    if (empty($user['password'])) {
      array_push($errors, 'password is required');
    }
  
    if ($user['passwordConf'] !== $user['password']) {
      array_push($errors, 'Password does not Match');
    }

    // $existingUser = selectOne('users', ['email' => $user['email']]);
    // if($existingUser){
    //     array_push($errors, 'Email is Already exists');
    // }
    $existingUser = selectOne('users', ['email' => $user['email']]);
    if($existingUser){
      if(isset($user['update-user']) && $existingUser['id'] != $user['id']){
        array_push($errors, 'Email already exists');
      }
            if(isset($user['create-admin'])){ 
              array_push($errors, 'Email already exists');
            }
    }

    return $errors;
  }

  function validateLogin ($user)
  {
    // global $conn;
    $errors = array();
    if (empty($user['username'])) {
      array_push($errors, 'Username is required');
    }
    if (empty($user['password'])) {
      array_push($errors, 'password is required');
    }
   
    return $errors;
       
  }

