<?php

  function validateTopic($topic)
  {
    // global $conn;
    $errors = array();
    

    if (empty($topic['name'])) {
      array_push($errors, 'Name is required');
    }
  
    // $existingTopic = selectOne('topics', ['name' => $topic['name']]);
    // if ($existingTopic){
    //     array_push($errors, 'Email is Already exists');
    // }
    $existingTopic = selectOne('topics', ['name' => $post['name']]);
    if($existingTopic){
      if(isset($post['update-topic']) && $existingTopic['id'] != $post['id']){
        array_push($errors, 'Name is already exists');
      }
            if(isset($post['add-post'])){ 
              array_push($errors, 'Name is already exists');
            }
    }
    

    return $errors;
  }