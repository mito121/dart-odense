<?php
require_once '../includes/dbconnect.php';

/* 
*** Insert message into db
 */
if (isset($_POST)) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    /* Insert post */
    $sql = "INSERT INTO `dart_messages`(`name`, `email`, `phone`, `message`) VALUES ('$name', '$email', '$phone', '$message')";
    $result = $conn->query($sql);

    if ($result == true) {
        $response = "Tak for din besked. Vi vender tilbage snarest muligt!";
    } else {
        $response = "UPS! Noget gik galt.";
    }
    header("location: ../index.php?page=contact&response=" . $response);
}