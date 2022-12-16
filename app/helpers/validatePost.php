<?php

function validatePost($post)
  {
    // global $conn;
    $errors = array();

    if (empty($post['title'])) {
      array_push($errors, 'Title is required');
    }
   
    if (empty($post['body'])) {
      array_push($errors, 'Body is required');
    }
  
    if (empty($post['topic_id'])) {
      array_push($errors, 'please select a topic');
    }

    // $existingPost = isset($_POST['update-post']) ? false: selectOne('posts', ['title' => $post['title']]);
    // if($existingPost){
    //     array_push($errors, 'Post with that title is Already exists');
    // }
  $existingPost = selectOne('posts', ['title' => $post['title']]);
  if($existingPost){
    if(isset($post['update-post']) && $existingPost['id'] != $post['id']){
      array_push($errors, 'Post with that title is already exists');
    }
          if(isset($post['add-post'])){ 
            array_push($errors, 'Post with that title is already exists');
          }
  }

    return $errors;
  }

  