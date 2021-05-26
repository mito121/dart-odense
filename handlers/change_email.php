<?php
session_start();
require_once '../includes/dbconnect.php';

if(isset($_POST) && !empty($_POST)){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $current_email = mysqli_real_escape_string($conn, $_POST['current_email']);
    $new_email = mysqli_real_escape_string($conn, $_POST['new_email']);
    $email_repeat = mysqli_real_escape_string($conn, $_POST['email_repeat']);

    /* Check if user put correct current email */
    $sql = "SELECT id FROM `dart_users` WHERE email = '$current_email' LIMIT 1";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($obj = $result->fetch_object()) {
            $db_user_id = $obj->id;
        }
        
        if ($db_user_id == $user_id){
            /* User has submitted the correct current email address */
            if ($new_email == $email_repeat){
                /* New email validation */
                $sql = "UPDATE `dart_users` SET `email`='$new_email' WHERE id = '$user_id'";
                $result = $conn->query($sql);
            
                if($result == true) {
                    /* Success */
                    $response = "Din email adresse er opdateret.";
                } else {
                    /* Email already exists in database */
                    $response = "Den valgte email findes allerede.";
                }
            } else {
                /* Email and email_repeat dont match */
                $response = "Dine nye email adresser er ikke ens.";
            }
        } else {
            /* User has submitted the current email of another user */
            $response = "Incorrect current email.";
        }
    } else {
        /* No users were found with this current email */
        $response = "No users were found with this current email";
    }
    /* Redirect to profile with tab and response as params */
    header("location: ../index.php?page=profile&tab=3&response=" . $response);
}