<?php
    if(!isset($_SESSION['logged']) or empty($_SESSION['logged'])) {
        $_SESSION = [];
        header('Location: index.php?page=login');
    }