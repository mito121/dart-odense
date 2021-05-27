<?php
session_start();
require_once '../includes/dbconnect.php';

if (isset($_POST)) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $new_title = mysqli_real_escape_string($conn, $_POST['new_title']);
  $new_content = mysqli_real_escape_string($conn, $_POST['new_content']);

  $sql = "UPDATE `dart_posts` SET title='$new_title', content='$new_content' WHERE id = '$id'";
  $result = $conn->query($sql);

  if ($result == true){
    header("location: ../index.php?page=post&id=" . $id);
  } else {
      die("UPS! Noget gik galt...");
  }
}