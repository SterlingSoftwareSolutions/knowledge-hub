<?php

include($ROOT_PATH  . "/app/database/db.php");
include($ROOT_PATH  . "/app/helpers/middleware.php");
include($ROOT_PATH  . "/app/helpers/validatePost.php");

$table = 'posts';
$conditions = array();
$uploadsImg = array();
$topics = selectAll('topics');
$posts = selectAll($table);
$errors = array();
$title = "";
$body = "";
$topic_id = "";
$published = "";
$isAdmin = "";
$new_post_id;

if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $isAdmin = $post['isAdmin'];
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

if (isset($_GET['delete_img'])) {
    adminOnly();
    $countImgDelete = delete('uploads', $_GET['delete_img']);
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['published' => $published]);
    $_SESSION['message'] = "Post published state changed!";
    $_SESSION['type'] = "success";
    header("location: "  .  $BASE_URL . "/admin/posts/index.php");
    exit();
}

if (isset($_POST['add-post'])) {
    if (!empty($_FILES['video']['name'])) {
        $video_name = time() . '_' . $_FILES['video']['name'];
        $destination = $ROOT_PATH . "/assets/videos/" . $video_name;
        $result = move_uploaded_file($_FILES['video']['tmp_name'], $destination);
        $allowed_extension = array('mp4');
        $filename = $_FILES['video']['name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($file_extension, $allowed_extension)) {
            $_SESSION['message'] = 'Please Check Video Format';
            $_SESSION['type'] = 'error';
            header('location:  /admin/posts/create.php');
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

    $errors = validatePost($_POST);
    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['isAdmin'] = isset($_POST['isAdmin']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
        $_SESSION['message'] = "Post created Successfully";
        $_SESSION['type'] = "success";
    } else {
        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $title = isset($_POST['body']) ? $_POST['body'] : "";
        $title = isset($_POST['topic_id']) ? $_POST['topic_id'] : "";
        $published = isset($_POST['published']) ? 1 : 0;
    }

    if (!empty(array_filter($_FILES['files']['name']))) {
        $uploadsDir = $ROOT_PATH . "/assets/images/";
        $allowedFileType = array('jpg', 'png', 'jpeg');
        $post_id = create($table, $_POST);

        foreach ($_FILES['files']['name'] as $imgid => $val) {
            $fileName        = $_FILES['files']['name'][$imgid];
            $tempLocation    = $_FILES['files']['tmp_name'][$imgid];
            $targetFilePath  = $uploadsDir . $fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadDate      = date('Y-m-d H:i:s');


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
            $insert = $conn->query("INSERT INTO uploads (images, date_time , postId) VALUES ('$fileName','$uploadDate','$post_id')");
        }
        header('location: ' . $BASE_URL . '/admin/posts/index.php');
        exit();
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "Please select a file to upload."
        );
    }
}

if (isset($_POST['update-post'])) {

    adminOnly();
    $post_images = array();
    $errors = validatePost($_POST);
    $uploaded_images = $_FILES['files']['name'];
    $allowedFileType = array('jpg', 'png', 'jpeg');

    if (!empty(array_filter($_FILES['files']['name']))) {
        if (count($errors) == 0) {
            $id = $_POST['id'];
            unset($_POST['update-post'], $_POST['id']);
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = isset($_POST['published']) ? 1 : 0;
            $_POST['isAdmin'] = isset($_POST['isAdmin']) ? 1 : 0;
            $_POST['body'] = htmlentities($_POST['body']);
            $post_id = update($table, $id, $_POST);

            foreach ($uploaded_images as $imgid => $val) {
                $fileName        = $_FILES['files']['name'][$imgid];
                $tempLocation    = $_FILES['files']['tmp_name'][$imgid];
                $targetFilePath  = $uploadsDir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $uploadDate      = date('Y-m-d H:i:s');

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
                $insert = $conn->query("INSERT INTO uploads (images, date_time , postId) VALUES ('$fileName','$uploadDate','$id')");
            }


            $_SESSION['message'] = "Post Updated Successfully";
            $_SESSION['type'] = "success";
            header('location: ' . $BASE_URL . '/admin/posts/index.php');
        } else {

            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $body = isset($_POST['body']) ? $_POST['body'] : "";
            $video = isset($_POST['video']) ? $_POST['video'] : "";
            $topic_id = isset($_POST['topic_id']) ? $_POST['topic_id'] : "";
            $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;
            $published = isset($_POST['published']) ? 1 : 0;
        }
    } else {
        if (count($errors) == 0) {
            $id = $_POST['id'];
            unset($_POST['update-post'], $_POST['id']);
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = isset($_POST['published']) ? 1 : 0;
            $_POST['isAdmin'] = isset($_POST['isAdmin']) ? 1 : 0;
            $_POST['body'] = htmlentities($_POST['body']);
            $post_id = update($table, $id, $_POST);



            $_SESSION['message'] = "Post Updated Successfully";
            $_SESSION['type'] = "success";
            header('location: ' . $BASE_URL . '/admin/posts/index.php');
        } else {

            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $body = isset($_POST['body']) ? $_POST['body'] : "";
            $video = isset($_POST['video']) ? $_POST['video'] : "";
            $topic_id = isset($_POST['topic_id']) ? $_POST['topic_id'] : "";
            $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;
            $published = isset($_POST['published']) ? 1 : 0;
        }
    }
}
