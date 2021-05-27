<?php
session_start();
require_once '../includes/dbconnect.php';

if (isset($_POST)) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $new_name = mysqli_real_escape_string($conn, $_POST['new_name']);
  $new_rules = mysqli_real_escape_string($conn, $_POST['new_rules']);

  $sql = "UPDATE `dart_games` SET name='$new_name', rules='$new_rules' WHERE id = '$id'";
  $result = $conn->query($sql);

  if ($result == true){
    header("location: ../index.php?page=game&id=" . $id);
  } else {
      die("UPS! Noget gik galt...");
  }
}