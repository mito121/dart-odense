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

    /* If anonymous user is signing up */
    if ($user_id == 0) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $passwordRepeat = mysqli_real_escape_string($conn, $_POST['password_repeat']);

        /* Check if email is valid */
        $sql = "SELECT `id` FROM `dart_users` WHERE email = '$email'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            /* Email is already in use */
            die("0");
        } else {
            
            if($password === $passwordRepeat) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
            } else {
                /* Password validation failed */
                die("0");
            }
            
            /* Insert new user into database */
            $sql = "INSERT INTO `dart_users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password_hash')";
            $result = $conn->query($sql);
    
            /* Get ID of this user */
            if($result) {
                $user_id = $conn->insert_id;
            }
        }
    }

    $sql = "INSERT INTO `dart_memberships`(`user_id`, `type_id`, `interval_id`, `price`) VALUES ('$user_id', '$membership_id', '$interval_id', '$price')";
    $result = $conn->query($sql);

    if($result && $user_id > 0) {
        /* Log the new user in */
        $_SESSION['logged'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role_id'] = 1;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['membership_id'] = $conn->insert_id;
        $_SESSION['membership_name'] = $membership_name;
        echo "1";
    } else {
        echo "0";
    }
}