<?php
require_once '../includes/dbconnect.php';

if (isset($_POST)) {
    $title = mysqli_real_escape_string($conn, $_POST['the_heading']);
    $the_post = mysqli_real_escape_string($conn, $_POST['the_post']);
    $restricted = mysqli_real_escape_string($conn, $_POST['restricted']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);

    $word_count = (int)str_word_count(strip_tags($the_post));
    var_dump($word_count);
    $read_time = 0;
    switch ($word_count) {
        case $word_count < 250:
            $read_time = 1;
            break;
        case $word_count < 500:
            $read_time = 2;
            break;
        case $word_count < 750:
            $read_time = 3;
            break;
        case $word_count < 1000:
            $read_time = 4;
            break;
        default:
            $read_time = 5;
            break;
    }

    $sql = "INSERT INTO `dart_posts`(`title`, `content`, `read_time`, `author_id`, `restricted`) VALUES ('$title', '$the_post', '$read_time', '$author', '$restricted')";
    $result = $conn->query($sql);

    if ($result === true) {
        $server_msg = "jubii dubii dubii dart dart dart";
    } else {
        $server_msg = "fuck fuck fuck fuck dart";
    }
    header("location: ../index.php?page=admin&msg=$server_msg");
}
