<?php

include($ROOT_PATH  . "/app/database/db.php");
include($ROOT_PATH  . "/app/helpers/middleware.php");
include($ROOT_PATH  . "/app/helpers/validateTopic.php"); 

$table= 'uploads';
$files = array();
$id = '';
$images = '';
$date_time = ''; 





//add post multiple image
$postid = $conn->insert_id;


if (isset($_POST['add-post'])) { 
    //  dd($_FILES['files']); 
    // adminOnly();
    // $errors = validatePost($_POST);

    $uploadsDir = $ROOT_PATH . "/assets/images/";
    $allowedFileType = array('jpg', 'png', 'jpeg');

    // Validate if files exist
    if (!empty(array_filter($_FILES['files']['name']))) {


        // Loop through file items
        foreach ($_FILES['files']['name'] as $id => $val) {
            // Get files upload path
            $fileName        = $_FILES['files']['name'][$id];
            $tempLocation    = $_FILES['files']['tmp_name'][$id];
            $targetFilePath  = $uploadsDir . $fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadDate      = date('Y-m-d H:i:s');
            $uploadOk = 1;
            
            // $result1 = mysqli_query($conn, "SELECT id FROM posts");
            // $postid = array();
            // while ($row = mysqli_fetch_assoc($result1)) {
            //     $postid[] = $row;}

            if (in_array($fileType, $allowedFileType)) {
                if (move_uploaded_file($tempLocation, $targetFilePath)) {
                    $sqlVal = "('" . $fileName . "', '" . $uploadDate . "')";
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
            if (!empty($sqlVal)) {
                $postid = $conn->insert_id;
                $insert = $conn->query("INSERT INTO uploads (images, date_time , postId) VALUES ('$fileName','$uploadDate','$postid')");
                // $insert = $conn->query("INSERT INTO uploads (images, date_time ) VALUES $sqlVal");


          
                if ($insert) {
                    $response = array(
                        "status" => "alert-success",
                        "message" => "Files successfully uploaded."
                    );
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Files could not be uploaded due to database error."
                    );
                }
            }
        }
    } else {
        // Error
        $response = array(
            "status" => "alert-danger",
            "message" => "Please select a file to upload."
        );
    }
 //end image/
}



