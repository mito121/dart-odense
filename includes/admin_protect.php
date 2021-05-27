<?php
    if($_SESSION['role_id'] != 3) {
        header('Location: index.php?page=home');
    }