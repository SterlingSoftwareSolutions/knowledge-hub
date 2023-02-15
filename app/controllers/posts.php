<?php

include($ROOT_PATH  . "/app/database/db.php");
include($ROOT_PATH  . "/app/helpers/middleware.php");
include($ROOT_PATH  . "/app/helpers/validatePost.php");

$table = 'posts';
$imgTable = 'uploads';
$conditions = array();
$uploadsImg = array();

$topics = selectAll('topics');
$posts = selectAll($table);
// $images = selectAll('uploads');



$errors = array();
$title = "";
$body = "";
$topic_id = "";
$published = "";
$new_post_id;


if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);

    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $published = $post['published'];
}


if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = "Post Deleted Successfully";
    $_SESSION['type'] = "success";
    header('location: ' . $BASE_URL . "/admin/posts/index.php");
    exit();
}





if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    // update published
    $count = update($table, $p_id, ['published' => $published]);
    $_SESSION['message'] = "Post published state changed!";
    $_SESSION['type'] = "success";
    header("location: "  .  $BASE_URL . "/admin/posts/index.php");
    exit();
}

//add post multiple image


if (isset($_POST['add-post'])) {

    // dd($_POST);


    // adminOnly();


    //video start//

    if (!empty($_FILES['video']['name'])) {
        $video_name = time() . '_' . $_FILES['video']['name'];
        $destination = $ROOT_PATH . "/assets/videos/" . $video_name;
        $result = move_uploaded_file($_FILES['video']['tmp_name'], $destination);
        // dd($_POST);

        $allowed_extension = array('mp4');
        $filename = $_FILES['video']['name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($file_extension, $allowed_extension)) {
            $_SESSION['message'] = 'Please Check Video Format';
            $_SESSION['type'] = 'error';
            header('location: /admin/posts/create.php');
            exit(0);
        }

        if ($result) {
            $_POST['video'] = $video_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } else {
        array_push($errors, "video is required");
    }


    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        // dd($_POST);

        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
        // dd($_POST);

        // $new_post_id = $post_id;

        $_SESSION['message'] = "Post created Successfully";
        $_SESSION['type'] = "success";
    } else {

        $title = isset($_POST['title']) ? $_POST['title'] : "";  //got the idea of code is done
        $title = isset($_POST['body']) ? $_POST['body'] : "";
        $title = isset($_POST['topic_id']) ? $_POST['topic_id'] : "";
        $published = isset($_POST['published']) ? 1 : 0;
    }

    //image start

    $errors = validatePost($_POST);
    $uploadsDir = $ROOT_PATH . "/assets/images/";
    $allowedFileType = array('jpg', 'png', 'jpeg');

    // Validate if files exist
    if (!empty(array_filter($_FILES['files']['name']))) {

        // image created by id
        $post_id = create($table, $_POST);
        // Loop through file items
        foreach ($_FILES['files']['name'] as $imgid => $val) {
            // Get files upload path
            $fileName        = $_FILES['files']['name'][$imgid];
            $tempLocation    = $_FILES['files']['tmp_name'][$imgid];
            $targetFilePath  = $uploadsDir . $fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadDate      = date('Y-m-d H:i:s');
            $uploadOk = 2;



            if (in_array($fileType, $allowedFileType)) {
                if (move_uploaded_file($tempLocation, $targetFilePath)) {
                    $response = array(
                        "status" => "alert-success",
                        "message" => "File uploaded."
                    );
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "File could not be uploaded."
                    );
                }
            } else {
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Only .jpg, .jpeg and .png file formats allowed."
                );
            }

            // Add into MySQL database
            // $postid = create('posts', $data);


            // dd($post_id);
            $insert = $conn->query("INSERT INTO uploads (images, date_time , postId) VALUES ('$fileName','$uploadDate','$post_id')");



        }
        header('location: ' . $BASE_URL . '/admin/posts/index.php');
        exit();
    } else {
        // Error
        $response = array(
            "status" => "alert-danger",
            "message" => "Please select a file to upload."
        );
    }
}





if (isset($_POST['update-post'])) {
    adminOnly();
    $errors = validatePost($_POST);

    if (!empty(array_filter($_FILES['files']['name']))) {

        // $image_name = time() . '_' . $_FILES['image']['name'];
        // $destination = $ROOT_PATH . "/assets/images/" . $image_name;


        // $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        // if ($result) {
        //     $_POST['image'] = $image_name;
        // } else {
        //     array_push($errors, "Failed to upload image");
        // }



        // if (isset($_POST['update-post']));
        // adminOnly();
        // $errors = validatePost($_POST);

        // if (!empty($_FILES['video']['name'])) {
        //     $video_name = time() . '_' . $_FILES['video']['name'];
        //     $destination = $ROOT_PATH . "/assets/videos/" . $video_name;
        //     $result = move_uploaded_file($_FILES['video']['tmp_name'], $destination);


        //     if ($result) {
        //         $_POST['video'] = $video_name;
        //     } else {
        //         array_push($errors, "Failed to upload image");
        //     }
        // } else {
        //     array_push($errors, "video is required");
        // }


        if (count($errors) == 0) {
            $id = $_POST['id'];
            unset($_POST['update-post'], $_POST['id']);
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = isset($_POST['published']) ? 1 : 0;
            $_POST['body'] = htmlentities($_POST['body']);


            $post_id = update($table, $id, $_POST);
            $_SESSION['message'] = "Post Updated Successfully";
            $_SESSION['type'] = "success";
            header('location: ' . $BASE_URL . '/admin/posts/index.php');
        } else {

            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $title = isset($_POST['body']) ? $_POST['body'] : "";
            $title = isset($_POST['topic_id']) ? $_POST['topic_id'] : "";
            // $body = $_POST['body'];                                            //getting the idea of code is done
            // $topic_id = $_POST['topic_id'];
            $published = isset($_POST['published']) ? 1 : 0;
        }
    }
}
