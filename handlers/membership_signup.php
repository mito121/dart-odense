<?php
session_start();
require_once '../includes/dbconnect.php';
/* 
*** !!!
*** TODO: Maybe some backend form validation? :-)
*** !!!
*/
if (!empty($_POST)) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $membership_id = mysqli_real_escape_string($conn, $_POST['membership_id']);
    $membership_name = mysqli_real_escape_string($conn, $_POST['membership_name']);
    $interval_id = mysqli_real_escape_string($conn, $_POST['interval_id']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "INSERT INTO `dart_memberships`(`user_id`, `type_id`, `interval_id`, `price`) VALUES ('$user_id', '$membership_id', '$interval_id', '$price')";
    $result = $conn->query($sql);

    if($result) {
        $last_id = $conn->insert_id;
        $_SESSION['membership_id'] = $last_id;
        $_SESSION['membership_name'] = $membership_name;
        echo "Tillykke! Du er nu rødhåret. Dø.";
    } else {
        echo "Noget gik galt. Du er sandsynligvis rødhåret.";
    }
}