<?php
    require_once 'includes/dbconnect.php';
    
    /* Get image paths for magic gallery */
    $sql = "SELECT `id`, `path`, `collection_id` FROM `dart_images`";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) > 0){
        $magic_gallery = array();
        while ($obj = $result -> fetch_object()) {
            /* Create new object */
            $imageObj = new stdClass();
            /* Set object values */
            $imageObj->id = $obj->id;
            $imageObj->path = $obj->path;
            $imageObj->collection_id = $obj->collection_id;
            /* Push object to array */
            $magic_gallery[] = $imageObj;
          }
          $magicJSON = json_encode($magic_gallery);
    }
?>
<!-- *** -->
<!--  FOLD *** -->
<!-- *** -->
<section class="hero-fold">
    <div class="wrapper">
        <div class="flex justify-end items-center hero-content">
            <div class="w-2/5">
                <h1>Når dart går spart i den</h1>
                <p>Helligånden er blå.</p>
                <button class="btn btn-primary">Bliv medlem</button>
            </div>
        </div>
    </div>
</section>

<!-- *** -->
<!--  NEWS *** -->
<!-- *** -->
<section>
    <div class="wrapper">
        <h1 class=" mt-6 mb-4">NYHEDER</h1>

        <div class="slick-slider">

            <div class="slick-slide">
                <div class="news-slide">
                    <a href="index.php">
                        <div class="slide-header">
                            <h1>Skudsår double i Mickey</h1>
                        </div>
                        <div class="read-time">
                            Læsetid: &#60;6 min.
                        </div>
                        <div class="slide-body">
                            <p>
                                Skudsåret er ferskt og det strammer. Her kommer pipilangstrømp' lorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span
                                    class="tbc">[Fortsættes]</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="slick-slide">
                <div class="news-slide">
                    <a href="index.php">
                        <div class="slide-header">
                            <h1>Skudsår double i Mickey</h1>
                        </div>
                        <div class="read-time">
                            Læsetid: &#60;6 min.
                        </div>
                        <div class="slide-body">
                            <p>
                                Skudsåret er ferskt og det strammer. Her kommer pipilangstrømp' lorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span
                                    class="tbc">[Fortsættes]</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="slick-slide">
                <div class="news-slide">
                    <a href="index.php">
                        <div class="slide-header">
                            <h1>Skudsår double i Mickey</h1>
                        </div>
                        <div class="read-time">
                            Læsetid: &#60;6 min.
                        </div>
                        <div class="slide-body">
                            <p>
                                Skudsåret er ferskt og det strammer. Her kommer pipilangstrømp' lorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span
                                    class="tbc">[Fortsættes]</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="slick-slide">
                <div class="news-slide">
                    <a href="index.php">
                        <div class="slide-header">
                            <h1>Skudsår double i Mickey</h1>
                        </div>
                        <div class="read-time">
                            Læsetid: &#60;6 min.
                        </div>
                        <div class="slide-body">
                            <p>
                                Skudsåret er ferskt og det strammer. Her kommer pipilangstrømp' lorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span
                                    class="tbc">[Fortsættes]</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="slick-slide">
                <div class="news-slide">
                    <a href="index.php">
                        <div class="slide-header">
                            <h1>Skudsår double i Mickey</h1>
                        </div>
                        <div class="read-time">
                            Læsetid: &#60;6 min.
                        </div>
                        <div class="slide-body">
                            <p>
                                Skudsåret er ferskt og det strammer. Her kommer pipilangstrømp' lorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span
                                    class="tbc">[Fortsættes]</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="slick-slide">
                <div class="news-slide">
                    <a href="index.php">
                        <div class="slide-header">
                            <h1>Skudsår double i Mickey</h1>
                        </div>
                        <div class="read-time">
                            Læsetid: &#60;6 min.
                        </div>
                        <div class="slide-body">
                            <p>
                                Skudsåret er ferskt og det strammer. Her kommer pipilangstrømp' lorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span
                                    class="tbc">[Fortsættes]</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="slick-slide">
                <div class="news-slide">
                    <a href="index.php">
                        <div class="slide-header">
                            <h1>Skudsår double i Mickey</h1>
                        </div>
                        <div class="read-time">
                            Læsetid: &#60;6 min.
                        </div>
                        <div class="slide-body">
                            <p>
                                Skudsåret er ferskt og det strammer. Her kommer pipilangstrømp' lorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span
                                    class="tbc">[Fortsættes]</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <div class="w-full flex justify-end">
            <button class="btn btn-primary mr-4">Se alle</button>
        </div>

    </div>

</section>


<!-- *** -->
<!--  GALLERY *** -->
<!-- *** -->
<section>
    <div class="wrapper">
        <h1 class=" mt-6 mb-4">GALLERI</h1>
<button id="happer">hap</button>
        <div class="magical-gallery" id="magical-data"
            data-dart-magic="<?php echo htmlspecialchars($magicJSON, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="magical-gallery-item" onmouseover=""></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
            <div class="magical-gallery-item"></div>
        </div>



    </div>
</section>