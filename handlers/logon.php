<?php
session_start();
require_once '../includes/dbconnect.php';

if (isset($_POST)) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT id, password FROM dart_users WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) { // If email exists in database
    while ($obj = $result->fetch_object()) { // get password from database
      $db_password = $obj->password;
    }
    
    if (password_verify($password, $db_password)) { // If passwords match
      /* LEFT JOIN, to always get data from entity 'dart_users', even if membership doesn't exist */
      $sql = "
        SELECT dart_users.`id` as id, dart_users.`name` as name, dart_users.`password` as password, dart_users.`role_id` as role_id, dart_memberships.id as membership_id, dart_membertypes.name as membership_name
        FROM `dart_users`
        LEFT JOIN dart_memberships on dart_memberships.user_id = dart_users.id
        LEFT JOIN dart_membertypes on dart_membertypes.id = dart_memberships.type_id
        WHERE dart_users.email = '$email'
      ";
      $result = $conn->query($sql);
      $_SESSION['logged'] = true;
      while ($obj = $result->fetch_object()) {
        $_SESSION['user_id'] = $obj->id;
        $_SESSION['role_id'] = $obj->role_id;
        $_SESSION['name'] = $obj->name;
        $_SESSION['email'] = $email;
        $_SESSION['membership_id'] = $obj->membership_id;
      }
      header("Location: ../index.php");
    } else { // If passwords don't match
      $serverMessage = "Email og password passer ikke sammen. Prøv igen.";
      header("Location: ../index.php?page=login&message=$serverMessage");
    }
  } else { // If e-mail doesn't exist
    $serverMessage = "Email og password passer ikke sammen. Prøv igen.";
    header("Location: ../index.php?page=login&message=$serverMessage");
  }
}