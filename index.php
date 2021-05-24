<?php
session_start();
/* var_dump($_SESSION); */
// get header
require_once "includes/header.php";

$page = '';

// get full page path
$page = (isset($_GET['page'])) ? "pages/" . $_GET['page'] . '.php' : 'pages/forside.php';
// get page name
$pageName = (isset($_GET['page'])) ? $_GET['page'] : 'forside';

// if page doesnt exist, redirect to 404
if (file_exists($page)) {
    include_once($page);
} else {
    include_once 'pages/404.php';
}

// get footer
require_once 'includes/footer.php';
