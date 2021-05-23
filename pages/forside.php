<?php
require_once 'includes/dbconnect.php';

/* 
*** Get news
 */
$sql = "SELECT `id`, `title`, `content`, `read_time`, `author_id`, `last_updated` FROM `dart_posts` ORDER BY `last_updated` DESC, `id` DESC";
$result = $conn->query($sql);

$news = "";

if ($result && mysqli_num_rows($result) > 0) {
    while ($obj = $result->fetch_object()) {
        $post_id = $obj->id;
        $post_title = $obj->title;
        $post_read_time = $obj->read_time;
        $post_content = $obj->content;
        $post_author = $obj->author_id;
        $post_updated = $obj->last_updated;

        /* If post content is too long, cut it off and strip tags */
        if (strlen($post_content) > 100) {
            $post_content = str_replace("&nbsp;", '', $post_content);
            $post_content = substr(strip_tags($post_content), 0, 500) . "... <span class=\"tbc\">[Fortsættes]</span>";
        }

        $news .= "
                <div class=\"slick-slide\">
                    <div class=\"news-container\">
                        <a href=\"index.php\">
                            <div class=\"slide-header\">
                                <h1>$post_title</h1>
                            </div>
                            <div class=\"read-time\">
                                Læsetid: $post_read_time min.
                            </div>
                            <div class=\"slide-body\">
                                $post_content
                            </div>
                        </a>
                    </div>
                </div>";
    }
}


/* 
*** Get images for magic gallery
 */
$sql = "SELECT `id`, `path`, `collection_id` FROM `dart_images`";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    $magic_gallery = array();
    while ($obj = $result->fetch_object()) {
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

            <?php echo $news; ?>

        </div>
        <div class="w-full flex justify-end">
            <a href="index.php?page=news">
                <button class="btn btn-primary mr-4">Se alle</button>
            </a>
        </div>

    </div>

</section>


<!-- *** -->
<!--  GALLERY *** -->
<!-- *** -->
<section>
    <div class="wrapper">
        <h1 class=" mt-6 mb-4">GALLERI</h1>

        <div class="magical-gallery" id="magical-data" data-dart-magic="<?php echo htmlspecialchars($magicJSON, ENT_QUOTES, 'UTF-8'); ?>">
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