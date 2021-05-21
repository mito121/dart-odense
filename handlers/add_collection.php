<?php
require_once '../includes/dbconnect.php';
require_once 'resize_image.php';

$collection_name = mysqli_real_escape_string($conn, $_POST['name']);
$collection_desc = mysqli_real_escape_string($conn, $_POST['desc']);
$this_collection_id = 1;

if (!empty($_FILES) && !empty($collection_name)) {
    /* Get ID of this collection */
    $sql = "SELECT `id` FROM `dart_collections` ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($obj = $result->fetch_object()) {
            $this_collection_id = $obj->id;
        }
        $this_collection_id = $this_collection_id + 1;
    }

    /* Upload each file */
    foreach($_FILES['file']['name'] as $key => $val) {
        $valid_formats = array("jpg", "JPG", "JPEG", "PNG", "png", "gif", "bmp");
        $target_dir = "../uploads/";
        $target_dir_small = "../uploads/small/";
        $filename = basename($_FILES["file"]["name"][$key]);

        $original_target_path = "{$target_dir}$filename";
        $small_target_path = "{$target_dir_small}$filename";

        // Check if image file is an actual image
        $check = getimagesize($_FILES["file"]["tmp_name"][$key]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($original_target_path)) {
            $uploadOk = 0;
        }
        // Check file size
        /*if ($_FILES["image"]["size"] > 1000000) {
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
        }
        // if everything is ok, try to upload file	
        elseif (move_uploaded_file($_FILES["file"]["tmp_name"][$key], $original_target_path)) {
            /* Insert images into db */
            $sql = "INSERT INTO `dart_images`(`path`, `collection_id`) VALUES ('$filename', '$this_collection_id')";
            $result = $conn->query($sql);
        
            // RESIZE IMAGE
            $imageResizer = new ImageResizer($original_target_path);
            //$imageResizer->resizeTo(250, 166);
            $imageResizer->resizeTo(300, 200);
            $imageResizer->saveImage($small_target_path);
            $imageResizer->resizeTo(1050, 700);
            $imageResizer->saveImage($original_target_path);
        }
    }
    /* Insert collection into db */
    $sql = "INSERT INTO `dart_collections`(`id`, `name`, `description`) VALUES ('$this_collection_id', '$collection_name', '$collection_desc')";
    $result = $conn->query($sql);
    echo "Album oprettet!";
} else {
    echo "Tilføj nogle billeder, før du opretter et album.";
}