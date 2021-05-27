<?php
session_start();
require_once '../includes/dbconnect.php';

if (isset($_POST)) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = "DELETE FROM `dart_games` WHERE id = '$id'";
  $result = $conn->query($sql);

  if ($result == true){
    /* Get banner image path to remove it from webserver */
    $sql = "SELECT `id`, `path` FROM `dart_images` WHERE game_id = '$id'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
      while ($obj = $result->fetch_object()) {
          $path = "../uploads/" . $obj->path;
          $path_small = "../uploads/small/" . $obj->path;
      }
      /* Remove big and small image from server */
      unlink($path);
      unlink($path_small);

      /* Remove image data from database */
      $sql = "DELETE FROM `dart_images` WHERE post_id = '$id'";
      $result = $conn->query($sql);
    }
    header("location: ../index.php?page=games");
  } else {
      die("UPS! Noget gik galt...");
  }
}