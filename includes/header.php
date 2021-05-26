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
        <!-- <header style="display:none;"> -->
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
                    <!-- *** Show "Bliv medlem" if user is not a member, else show "Min Profil" -->
                    <?php if(isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])) : ?>
                    <li>
                        <a href="index.php?page=profile" class="<?php echo $pageName == 'profile'? 'active' : null; ?>">
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
                            class="<?php echo $pageName == 'games'? 'active' : null; ?>">Spil</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=games">Regler</a>
                            <a href="index.php?page=leaderboards">Stillinger</a>
                        </div>
                    </li>

                    <li>
                        <a href="index.php?page=galleries"
                            class="<?php echo $pageName == 'galleries'? 'active' : null; ?>">Galleri</a>
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
                            <a href="index.php?page=admin-posts">Ny nyhed</a>
                            <a href="index.php?page=admin-collections">Nyt album</a>
                            <a href="index.php?page=admin-games">Nyt spil</a>
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