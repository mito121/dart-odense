<?php
require_once '../includes/dbconnect.php';

if (isset($_POST)) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "UPDATE `dart_messages` SET unread=0 WHERE id = '$id'";
  $result = $conn->query($sql);

  echo $id;
}