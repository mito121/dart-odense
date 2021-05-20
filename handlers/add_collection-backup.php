<?php
require_once '../includes/dbconnect.php';
require_once 'resize_image.php';

if (!empty($_FILES)) {
    $collection_name = mysqli_real_escape_string($conn, $_POST['name']);

    foreach($_FILES['file']['name'] as $key=>$val){
        $file_name = $_FILES['file']['name'][$key];

        // get file extension
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // get filename without extension
        $filenamewithoutextension = pathinfo($file_name, PATHINFO_FILENAME);

        $filename_to_store = $filenamewithoutextension. '_' .uniqid(). '.' .$ext;
        move_uploaded_file($_FILES['file']['tmp_name'][$key], '../uploads/'.$filename_to_store);
    }

    echo "Album oprettet!";
}else{
    echo "Tilføj nogle billeder, før du opretter et album.";
}
die;