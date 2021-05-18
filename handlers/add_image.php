<?php
/* ***
*** MULTI FILE UPLOAD:
    https://stackoverflow.com/questions/9046657/upload-multiple-files-in-php
    https://stackoverflow.com/questions/40129388/multiple-file-upload-with-php
*/

require_once '../includes/dbconnect.php';
require_once 'resize_image.php';

if (!empty($_FILES)) {
    // IMAGE UPLOAD  
    $valid_formats = array("jpg", "JPG", "JPEG", "PNG", "png", "gif", "bmp");
    $target_dir = "../uploads/";
    $target_dir_small = "../uploads/small/";
    $filename = basename($_FILES["image"]["name"]);

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
        die("file alrdy exists");
        $uploadOk = 0;
    }
    // Check file size
/*     if ($_FILES["image"]["size"] > 1000000) {
        die("file is too big");
        $uploadOk = 0;
    } */
    // Allow certain file formats
    if (!in_array(pathinfo($filename, PATHINFO_EXTENSION), $valid_formats)) {
        die("file format is shitty");
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $output = "UPS, noget gik galt!";
    }
    // if everything is ok, try to upload file	
    elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $orginal_target_path)) {
        /* Replace image, if it already exists */
        /* unlink($target_dir, $filename); */
        // RESIZE IMAGE
        $imageResizer = new ImageResizer($orginal_target_path);
        //$imageResizer->resizeTo(250, 166);
        $imageResizer->resizeTo(300, 200);
        $imageResizer->saveImage($small_target_path);
        $imageResizer->resizeTo(1050, 700);
        $imageResizer->saveImage($orginal_target_path);

        $sql = "INSERT INTO `dart_images`(`path`) VALUES ('$filename')";

        $result = $conn->query($sql);
        $output = "Billede uploadet.";
    } else {
        $output = "Noget gik galt.";
    }
}
echo $output;