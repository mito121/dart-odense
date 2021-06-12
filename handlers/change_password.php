<?php
session_start();
require_once '../includes/dbconnect.php';

if(isset($_POST) && !empty($_POST)){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $password_repeat = mysqli_real_escape_string($conn, $_POST['password_repeat']);

    /* Check if user put correct current password */
    $sql = "SELECT password FROM `dart_users` WHERE id = '$user_id' LIMIT 1";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($obj = $result->fetch_object()) {
            $db_password = $obj->password;
        }
        
        if (password_verify($current_password, $db_password)){
            /* User has submitted the correct current password */
            if ($new_password == $password_repeat){
                /* New passwords match */

                /* Hash new password */
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                /* Insert new password */
                $sql = "UPDATE `dart_users` SET `password`='$new_password_hash' WHERE id = '$user_id'";
                $result = $conn->query($sql);
            
                if($result == true) {
                    /* Success */
                    $response = "Din adgangskode er opdateret.";
                } else {
                    /* Email already exists in database */
                    $response = "UPS! Noget gik galt!";
                }
            } else {
                /* New passwords dont match */
                $response = "Din nye adgangskoder er ikke ens.";
            }
        } else {
            /* User has submitted the wrong current password */
            $response = "Incorrect current password.";
        }
    }
    /* Redirect to profile with tab and response as params */
    header("location: ../index.php?page=profile&tab=1&response=" . $response);
}