<?php

require_once '../includes/dbconnect.php';
require_once 'resize_image.php';

/* 
*** Insert post into db
 */
if (isset($_POST)) {
    $title = mysqli_real_escape_string($conn, $_POST['the_heading']);
    $the_post = mysqli_real_escape_string($conn, $_POST['the_post']);
    $restricted = isset($_POST['restricted']) && !empty($_POST['restricted']) ? mysqli_real_escape_string($conn, $_POST['restricted']) : NULL;
    $author = mysqli_real_escape_string($conn, $_POST['author']);

    /* Calculate read time */
    $word_count = (int)str_word_count(strip_tags($the_post));

    $read_time = 0;
    switch ($word_count) {
        case $word_count < 250:
            $read_time = 1;
            break;
        case $word_count < 500:
            $read_time = 2;
            break;
        case $word_count < 750:
            $read_time = 3;
            break;
        case $word_count < 1000:
            $read_time = 4;
            break;
        case $word_count < 2000:
            $read_time = 5;
            break;
        case $word_count > 2000:
            $read_time = "> 5";
            break;
        default:
            $read_time = " < 1";
            break;
    }

    /* Insert post */
    $sql = "INSERT INTO `dart_posts`(`title`, `content`, `read_time`, `author_id`, `restricted`) VALUES ('$title', '$the_post', '$read_time', '$author', '$restricted')";
    $result = $conn->query($sql);
    $post_id = $conn->insert_id;

    /* 
    *** Insert banner image into db
    */
    if (!empty($_FILES)) {
        $valid_formats = array("jpg", "JPG", "JPEG", "PNG", "png", "gif", "bmp");
        $target_dir = "../uploads/";
        $target_dir_small = "../uploads/small/";
        $filename = uniqid() . "-" . basename($_FILES["image"]["name"]);
        /* Replace spaces in image name with underscores */
        $filename = str_replace(' ', '_', $filename);

        $orginal_target_path = "{$target_dir}$filename";
        $small_target_path = "{$target_dir_small}$filename";

        // Check if image file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($orginal_target_path)) {
            $uploadOk = 0;
        }
        // Check file size
    /*     if ($_FILES["image"]["size"] > 1000000) {
            die("file is too big");
            $uploadOk = 0;
        } */
        // Allow certain file formats
        if (!in_array(pathinfo($filename, PATHINFO_EXTENSION), $valid_formats)) {
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $output = "UPS, noget gik galt!";
            $sql = "DELETE FROM `dart_posts` WHERE id = '$post_id'";
            $result = $conn->query($sql);
        }
        // if everything is ok, try to upload file	
        elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $orginal_target_path)) {
            // RESIZE IMAGE
            $imageResizer = new ImageResizer($orginal_target_path);
            $imageResizer->resizeTo(300, 300);
            $imageResizer->saveImage($small_target_path);

            $sql = "INSERT INTO `dart_images`(`path`, `post_id`) VALUES ('$filename', '$post_id')";
            $result = $conn->query($sql);
            $output = "Nyhed oprettet.";
        } else {
            /* Delete the post */
            $sql = "DELETE FROM `dart_posts` WHERE id = '$post_id'";
            $result = $conn->query($sql);
        }
        header("location: ../index.php?page=admin-posts&msg=$output");
    }
}