<?php

require_once '../includes/dbconnect.php';
require_once 'resize_image.php';

/* 
*** Insert post into db
 */
if (isset($_POST)) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rules = mysqli_real_escape_string($conn, $_POST['rules']);

    /* Insert game */
    $sql = "INSERT INTO `dart_games`(`name`, `rules`) VALUES ('$name', '$rules')";
    $result = $conn->query($sql);
    $game_id = $conn->insert_id;

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
            /* Delete the game */
            $sql = "DELETE FROM `dart_games` WHERE id = '$game_id'";
            $result = $conn->query($sql);
        }
        // if everything is ok, try to upload file	
        elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $orginal_target_path)) {
            /* Replace image, if it already exists */
            /* unlink($target_dir, $filename); */
            // RESIZE IMAGE
            $imageResizer = new ImageResizer($orginal_target_path);
            $imageResizer->resizeTo(300, 300);
            $imageResizer->saveImage($small_target_path);
            /* $imageResizer->resizeTo(1050, 700);
            $imageResizer->saveImage($orginal_target_path); */

            $sql = "INSERT INTO `dart_images`(`path`, `game_id`) VALUES ('$filename', '$game_id')";

            $result = $conn->query($sql);
            $output = "Spil oprettet.";
        } else {
            /* Delete the game */
            $sql = "DELETE FROM `dart_games` WHERE id = '$game_id'";
            $result = $conn->query($sql);
        }
        header("location: ../index.php?page=admin-games&msg=$output");
    }
}