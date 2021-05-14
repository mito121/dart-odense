<!DOCTYPE html>
<html lang="en" translate="no">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dart Odense | Når dart går spart i den</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/favicon.png">

  <!-- ** CSS ** -->
  <!-- Tailwind -->
  <link href="assets/css/tailwind/style.css" rel="stylesheet" type="text/css" />
  <!-- Swiper -->
  <link rel="stylesheet" href="assets/css/swiper/swiper.css" />
  <!-- Custom -->
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

  <!-- ** JS ** -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
  <!-- Swiper -->
  <script src="assets/js/swiper/swiper.js"></script>
</head>

<body>
  <header>
    <!-- Logo -->
    <div class="logo">
      <a href="index.php">
        <img draggable="false" src="http://placekitten.com/200/200" alt="logo" />
      </a>
    </div>
    <!-- Navigation -->
    <nav>
      <ul>
        <li>
          <a href="index.php">
            Forside
          </a>
        </li>

        <li class="dropdown">
          <i class="fas fa-chevron-down"></i>
          <a href="#">Spil</a>
          <div class="dropdown-content">
            <a href="#">Events</a>
            <a href="#">Hestemøg</a>
          </div>
        </li>

        <li class="dropdown">
          <i class="fas fa-chevron-down"></i>
          <a href="#">Om os</a>
          <div class="dropdown-content">
            <a href="#">Fersk and</a>
          </div>
        </li>

        <li>
          <a href="#">Kontakt</a>
        </li>

        <!-- Login / logout -->
        <?php echo isset($_SESSION['logged']) === true ?  "<li><a href=\"handlers/logoff.php\"><i class=\"fas fa-sign-out-alt\"></i> Log ud</a></li>" : "<li><a href=\"index.php?page=login\"><i class=\"fas fa-sign-in-alt\"></i> Log ind</a></li>"; ?>
      </ul>
    </nav>
  </header>
  <main>