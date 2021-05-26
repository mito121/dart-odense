<?php
session_start();
require_once '../includes/dbconnect.php';

if(isset($_POST) && !empty($_POST)){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $new_type_id = mysqli_real_escape_string($conn, $_POST['membership']);
    $new_interval_id = mysqli_real_escape_string($conn, $_POST['interval']);
    $new_price = mysqli_real_escape_string($conn, $_POST['new_price']);

    $sql = "UPDATE `dart_memberships` SET `type_id`='$new_type_id', `interval_id`='$new_interval_id', `price`='$new_price' WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if($result == true) {
        $response = "Dit medlemskab er opdateret.";
    } else {
        $response = "UPS! Noget gik galt.";
    }

    header("location: ../index.php?page=profile&tab=3&response=" . $response);
}