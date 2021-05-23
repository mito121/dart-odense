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
    <!-- Slick -->
    <!-- <link rel="stylesheet" href="assets/css/swiper/swiper.css" /> -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" rel="stylesheet" />
    <!-- Custom -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/6tuqmnzsuhl7pk0sio1g4wiw8uuumzsntdwfi22eo6q251qg/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    <header>
        <div class="header-content">
            <!-- Logo -->
            <div class="logo">
                <a href="index.php">
                    <img draggable="false" src="./assets/img/logo.png" alt="logo" />
                </a>
            </div>
            <!-- Navigation -->
            <nav>
                <ul>
                    <!-- *** Show "Bliv medlem" if user is not a member -->
                    <?php echo isset($_SESSION['membership_id']) && 
                    !empty($_SESSION['membership_id']) ? "  <li>
                                                                <a href=\"index.php?page=profile\">
                                                                    Min profil
                                                                </a>
                                                            </li>"
                                                        :
                                                            "<li>
                                                                <a href=\"index.php?page=sign-up\" class=\"btn btn-primary\">
                                                                    Bliv medlem
                                                                </a>
                                                            </li>";
                                                                ?>

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
                        <a href="index.php?page=omos">Om os</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=omos#aboutus">Hvem er vi?</a>
                            <a href="index.php?page=omos#openhrs">Åbningstider</a>
                            <a href="index.php?page=omos#chiefs">Bestyrelsen</a>
                            <a href="index.php?page=omos#sponsors">Sponsorer</a>
                            <a href="index.php?page=rules">Love & vedtægter</a>
                            <a href="index.php?page=privacy">Privatlivspolitik</a>
                        </div>
                    </li>

                    <li>
                        <a href="#">Kontakt</a>
                    </li>

                    <!-- Admin -->
                    <?php echo isset($_SESSION['logged']) === true ? "  <li class=\"dropdown\">
                                                                            <i class=\"fas fa-chevron-down\"></i>
                                                                            <a href=\"index.php?page=admin\"></i>Admin</a>
                                                                            <div class=\"dropdown-content\">
                                                                                <a href=\"index.php?page=admin-images\">Billeder</a>
                                                                                <a href=\"index.php?page=admin-posts\">Nyheder</a>
                                                                            </div>
                                                                        </li>" : null; ?>

                    <!-- Login / logout -->
                    <?php echo isset($_SESSION['logged']) === true ? "<li><a href=\"handlers/logoff.php\"><i class=\"fas fa-sign-out-alt\"></i> Log ud</a></li>" : "<li><a href=\"index.php?page=login\"><i class=\"fas fa-sign-in-alt\"></i> Log ind</a></li>"; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>