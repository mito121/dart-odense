<?php
/* Protect login pages */
if($pageName == 'profile'){
    require_once 'includes/login_protect.php';
}
if(strpos($pageName, "admin") !== false) {
    require_once 'includes/admin_protect.php';
}
?>
<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dart Odense | Når dart er en sport</title>
    <meta name="description" content="Dartklub i hjertet af Odense C">
    <!-- Favicon -->
    <link rel="icon" href="assets/img/logo.png">

    <!-- ** CSS ** -->
    <!-- Tailwind -->
    <link href="assets/css/tailwind/style.css" rel="stylesheet" type="text/css" />
    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" rel="stylesheet" />
    <!-- calendar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.min.css" />
    <!-- datepicker -->
    <link href="assets/js/datepicker/datepicker.css" rel="stylesheet" type="text/css" />
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
            <!-- Mobile navigation -->
            <nav id="mobile">

                <!-- The burger -->
                <button class="menu" id="burger"
                    onclick="this.classList.toggle('opened'); this.setAttribute('aria-expanded', this.classList.contains('opened'));"
                    aria-label="Main Menu">
                    <svg width="50" height="50" viewBox="0 0 100 100">
                        <path class="line line1"
                            d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                        <path class="line line2" d="M 20,50 H 80" />
                        <path class="line line3"
                            d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                    </svg>
                </button>

            </nav>
            <!-- Desktop navigation -->
            <nav id="desktop">
                <ul>
                    <!-- *** Show "Bliv medlem" if user is not a member, else show "Min Profil" -->
                    <?php if(isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])) : ?>
                    <li>
                        <a href="index.php?page=profile"
                            class="<?php echo $pageName == 'profile' ? 'active' : null; ?>">
                            Min profil
                        </a>
                    </li>
                    <?php else : ?>
                    <li>
                        <a href="index.php?page=sign-up" class="btn btn-primary" id="get-membership">
                            Bliv medlem
                        </a>
                    </li>
                    <?php endif; ?>

                    <li>
                        <a href="index.php"
                            class="<?php echo $pageName == 'home' || $pageName == '' ? 'active' : null; ?>">
                            Forside
                        </a>
                    </li>

                    <li>
                        <a href="index.php?page=news"
                            class="<?php echo $pageName == 'news'? 'active' : null; ?>">Nyheder</a>
                    </li>

                    <li class="dropdown">
                        <i class="fas fa-chevron-down"></i>
                        <a href="index.php?page=games"
                            class="<?php echo $pageName == 'games' || $pageName == 'leaderboards' || $pageName == 'game' ? 'active' : null; ?>">Spil</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=games">Regler</a>
                            <a href="index.php?page=leaderboards">Ranglister</a>
                        </div>
                    </li>

                    <li>
                        <a href="index.php?page=galleries"
                            class="<?php echo $pageName == 'galleries' || $pageName == 'gallery' ? 'active' : null; ?>">Galleri</a>
                    </li>

                    <li class="dropdown">
                        <i class="fas fa-chevron-down"></i>
                        <a href="index.php?page=omos"
                            class="<?php echo $pageName == 'omos' || $pageName == 'laws' || $pageName == 'privacy' ? 'active' : null; ?>">Om
                            os</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=omos">Hvem er vi?</a>
                            <a href="index.php?page=omos#openhrs">Åbningstider</a>
                            <a href="index.php?page=omos#chiefs">Bestyrelsen</a>
                            <a href="index.php?page=omos#sponsors">Sponsorer</a>
                            <a href="index.php?page=laws">Love & vedtægter</a>
                            <a href="index.php?page=privacy">Privatlivspolitik</a>
                        </div>
                    </li>

                    <li>
                        <a href="index.php?page=calendar"
                            class="<?php echo $pageName == 'calendar'? 'active' : null; ?>">Kalender</a>
                    </li>

                    <li>
                        <a href="index.php?page=contact"
                            class="<?php echo $pageName == 'contact'? 'active' : null; ?>">Kontakt</a>
                    </li>

                    <!-- Admin -->
                    <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) : ?>
                    <li class="dropdown">
                        <i class="fas fa-chevron-down"></i>
                        <a href="index.php?page=admin"
                            class="<?php echo $pageName == 'admin' || $pageName == 'admin-collections' || $pageName == 'admin-posts' || $pageName == 'admin-games' ? 'active' : null; ?>">Admin</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=admin-posts">Opret nyhed</a>
                            <a href="index.php?page=admin-collections">Opret album</a>
                            <a href="index.php?page=admin-games">Opret spil</a>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- Login / logout -->
                    <?php echo isset($_SESSION['logged']) === true ? "<li><a href=\"handlers/logoff.php\"><i class=\"fas fa-sign-out-alt\"></i> Log ud</a></li>" : "<li><a href=\"index.php?page=login\"><i class=\"fas fa-sign-in-alt\"></i> Log ind</a></li>"; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <!-- Mobile nav -->
        <ul id="mobile-nav">
            <!-- *** Show "Bliv medlem" if user is not a member, else show "Min Profil" -->
            <?php if(isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])) : ?>
            <li>
                <a href="index.php?page=profile" class="<?php echo $pageName == 'profile' ? 'active' : null; ?>">
                    Min profil
                </a>
            </li>
            <?php else : ?>
            <li>
                <a href="index.php?page=sign-up" class="btn btn-primary" id="get-membership-mobile">
                    Bliv medlem
                </a>
            </li>
            <?php endif; ?>

            <li>
                <a href="index.php" class="<?php echo $pageName == 'home' || $pageName == '' ? 'active' : null; ?>">
                    Forside
                </a>
            </li>

            <li>
                <a href="index.php?page=news" class="<?php echo $pageName == 'news' ? 'active' : null; ?>">Nyheder</a>
            </li>

            <li class="dropdown"
                onclick="this.classList.toggle('open'); this.setAttribute('aria-expanded', this.classList.contains('open'));">
                <i class="fas fa-chevron-down"></i>
                <a
                    class="<?php echo $pageName == 'games' || $pageName == 'leaderboards' || $pageName == 'game' ? 'active' : null; ?>">Spil</a>
                <div class="dropdown-content">
                    <a href="index.php?page=games">Regler</a>
                    <a href="index.php?page=leaderboards">Ranglister</a>
                </div>
            </li>

            <li>
                <a href="index.php?page=galleries"
                    class="<?php echo $pageName == 'galleries' || $pageName == 'gallery' ? 'active' : null; ?>">Galleri</a>
            </li>

            <li class="dropdown"
                onclick="this.classList.toggle('open'); this.setAttribute('aria-expanded', this.classList.contains('open'));">
                <i class="fas fa-chevron-down"></i>
                <a
                    class="<?php echo $pageName == 'omos' || $pageName == 'laws' || $pageName == 'privacy' ? 'active' : null; ?>">Om
                    os</a>
                <div class="dropdown-content">
                    <a href="index.php?page=omos">Hvem er vi?</a>
                    <a href="index.php?page=omos#openhrs">Åbningstider</a>
                    <a href="index.php?page=omos#chiefs">Bestyrelsen</a>
                    <a href="index.php?page=omos#sponsors">Sponsorer</a>
                    <a href="index.php?page=laws">Love & vedtægter</a>
                    <a href="index.php?page=privacy">Privatlivspolitik</a>
                </div>
            </li>

            <li>
                <a href="index.php?page=calendar"
                    class="<?php echo $pageName == 'calendar' ? 'active' : null; ?>">Kalender</a>
            </li>

            <li>
                <a href="index.php?page=contact"
                    class="<?php echo $pageName == 'contact'? 'active' : null; ?>">Kontakt</a>
            </li>

            <!-- Admin -->
            <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) : ?>
            <li class="dropdown"
                onclick="this.classList.toggle('open'); this.setAttribute('aria-expanded', this.classList.contains('open'));">
                <i class="fas fa-chevron-down"></i>
                <a
                    class="<?php echo $pageName == 'admin' || $pageName == 'admin-collections' || $pageName == 'admin-posts' || $pageName == 'admin-games' ? 'active' : null; ?>">Admin</a>
                <div class="dropdown-content">
                    <a href="index.php?page=admin">Dashboard</a>
                    <a href="index.php?page=admin-posts">Opret nyhed</a>
                    <a href="index.php?page=admin-collections">Opret album</a>
                    <a href="index.php?page=admin-games">Opret spil</a>
                </div>
            </li>
            <?php endif; ?>

            <!-- Login / logout -->
            <?php echo isset($_SESSION['logged']) === true ? "<li><a href=\"handlers/logoff.php\"><i class=\"fas fa-sign-out-alt\"></i> Log ud</a></li>" : "<li><a href=\"index.php?page=login\"><i class=\"fas fa-sign-in-alt\"></i> Log ind</a></li>"; ?>
        </ul>