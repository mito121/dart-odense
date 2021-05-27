<?php
require_once 'includes/dbconnect.php';

/* 
*** Get news
 */
$sql = "SELECT `dart_posts`.`id` AS id, `dart_posts`.`title` AS title, `dart_posts`.`content` AS content,
        `dart_posts`.`read_time` AS read_time, `dart_posts`.`last_updated` AS last_updated, `dart_images`.`path` AS img,
         dart_users.name AS author_name
        FROM `dart_posts`
        LEFT JOIN `dart_images` ON `dart_images`.`post_id` = `dart_posts`.`id`
        LEFT JOIN `dart_users` ON `dart_users`.`id` = `dart_posts`.`author_id`";
$result = $conn->query($sql);

$news = "";

if ($result && mysqli_num_rows($result) > 0) {
    while ($obj = $result->fetch_object()) {
        $post_id = $obj->id;
        $post_title = $obj->title;
        $post_read_time = $obj->read_time;
        $post_content = $obj->content;
        $post_author = $obj->author_name;
        $post_updated = $obj->last_updated;
        $img_src = "./uploads/small/" . $obj->img;

        /* If post content is too long, cut it off and strip tags */
        if (strlen($post_content) > 100) {
            $post_content = str_replace("&nbsp;", '', $post_content);
            $post_content = substr(strip_tags($post_content), 0, 400) . "... <span class=\"tbc\">[Fortsættes]</span>";
        }



        $year = substr($post_updated, 0, 4);
        $month = substr($post_updated, 5, 2);
        $day = substr($post_updated, 8, 2);

        $news .= "
                <div class=\"slick-slide\">
                    <div class=\"news-container\">
                        <a href=\"index.php?page=post&id=$post_id\">
                            <div class=\"flex flex-col justify-between h-full\">
                                <div>
                                    <div class=\"news-img\">
                                        <img src=\"$img_src\" alt=\"bannerbillede\" />
                                    </div>
                                    <div class=\"slide-header\">
                                        <h1>$post_title</h1>
                                    </div>
                                    <div class=\"read-time\">
                                        Læsetid: $post_read_time min.
                                    </div>
                                    <div class=\"slide-body\">
                                        $post_content
                                    </div>
                                </div>
                                <div class=\"slide-footer\">
                                    <div class=\"flex w-full justify-between\">
                                        <span>$day-$month-$year</span>
                                        <span>$post_author</span>
                                    </div>
                                </div>
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
<section class="hero-fold" id="hero">
    <div class="wrapper">
        <div class="flex justify-end items-center hero-content">
            <div class="w-2/5 text-right">
                <h1 class="stylish">Når dart er en sport</h1>
                <p>I Dart Odense brænder vi for darten.<br />
                    Som medlem af både DDU og Dartfyn er <br /> der masser af muligheder for dig der <br /> gerne vil spille dart.</p>
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
        <h1 class="main-heading">Nyheder</h1>
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
    <div class="wrapper p-15px">
        <h1 class=" mt-6 mb-4">Galleri</h1>

        <div class="magical-gallery" id="magical-data"
            data-dart-magic="<?php echo isset($magicJSON) && !empty($magicJSON) ? htmlspecialchars($magicJSON, ENT_QUOTES, 'UTF-8') : null; ?>">
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

        <div class="w-full flex justify-end">
            <a href="index.php?page=galleries">
                <button class="btn btn-primary mr-4 mt-25px">Se alle</button>
            </a>
        </div>
    </div>
</section>