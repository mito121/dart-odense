<?php
$dbServer = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'test';

$conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
        if ($conn->connect_error){
            die('Database connection failed: ' . $conn->connect_error);
        }
$conn->set_charset('UTF8');