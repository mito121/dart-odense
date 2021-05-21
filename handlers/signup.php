<?php
require_once '../includes/dbconnect.php';

if (!empty($_POST)) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $type_id = mysqli_real_escape_string($conn, $_POST['membership_id']);
    $interval_id = mysqli_real_escape_string($conn, $_POST['interval_id']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "INSERT INTO `dart_memberships`(`user_id`, `type_id`, `interval_id`, `price`) VALUES ('$user_id', '$type_id', '$interval_id', '$price')";
    $result = $conn->query($sql);

    if($result) {
        echo "Tillykke! Du er nu rødhåret. Dø.";
    } else {
        echo "Noget gik galt. Du er sandsynligvis rødhåret.";
    }
}