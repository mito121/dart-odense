<?php
require_once 'includes/dbconnect.php';

/* 
*** Get news
 */
$yearFilter = !empty($_GET['year']) ? $_GET['year'] : null;
if(isset($yearFilter)){
    $sql = "SELECT  `dart_posts`.`id` AS id, `dart_posts`.`title` AS title, `dart_posts`.`content` AS content, `dart_posts`.`read_time` AS read_time,
                    `dart_posts`.`author_id` AS author_id, YEAR(`dart_posts`.`last_updated`) AS year, `dart_posts`.`last_updated` AS last_updated ,
                    `dart_images`.`path` AS img
            FROM `dart_posts`
            LEFT JOIN `dart_images` ON `dart_images`.`post_id` = `dart_posts`.`id`
            WHERE YEAR(last_updated) = '$yearFilter'
            ORDER BY `last_updated` DESC, `id` DESC";
} else {
    $sql = "SELECT  `dart_posts`.`id` AS id, `dart_posts`.`title` AS title, `dart_posts`.`content` AS content, `dart_posts`.`read_time` AS read_time,
                    `dart_posts`.`author_id` AS author_id, YEAR(`dart_posts`.`last_updated`) AS year, `dart_posts`.`last_updated` AS last_updated ,
                    `dart_images`.`path` AS img
            FROM `dart_posts`
            LEFT JOIN `dart_images` ON `dart_images`.`post_id` = `dart_posts`.`id`
            ORDER BY `last_updated` DESC, `id` DESC";
}



$result = $conn->query($sql);
$news = "";
if (mysqli_num_rows($result) > 0) {
    $yearHeadings = array();
    while ($obj = $result->fetch_object()) {
        $post_id = $obj->id;
        $post_title = $obj->title;
        $post_read_time = $obj->read_time;
        $post_content = $obj->content;
        $post_author = $obj->author_id;
        $post_updated = $obj->last_updated;
        $img_src = "./uploads/small/" . $obj->img;

        // Check if Year header should be insterted
        $year = substr($post_updated, 0, 4);
        if (false !== $key = array_search($year, $yearHeadings)) { // year is not new - dont add heading
            $thisHeading = "";
        } else { // year is new - add heading
            $yearHeadings[] = $year;
            $thisHeading = "<h2 class=\"year-heading\">" . end($yearHeadings) . "</h2>";
        }
        
        /* If post content is too long, cut it off and strip tags */
        if (strlen($post_content) > 100) {
            $post_content = str_replace("&nbsp;", '', $post_content);
            $post_content = substr(strip_tags($post_content), 0, 500) . "... <span class=\"tbc\">[Fortsættes]</span>";
        }

        $news .= "
                $thisHeading
                <div class=\"news-container\">
                    <a href=\"index.php?page=news-single&id=$post_id\">
                        <div class=\"news-img\">
                            <img src=\"$img_src\" alt=\"bannerbillede\" />
                        </div>
                        <div class=\"slide-header\">
                            <h3>$post_title</h3>
                        </div>
                        <div class=\"read-time\">
                            Læsetid: $post_read_time min.
                        </div>
                        <div class=\"slide-body\">
                            $post_content
                        </div>
                    </a>
                </div>";
    }
}

/* 
*** Get year filter select options
 */
$sql = "SELECT YEAR(`last_updated`) as year FROM `dart_posts` GROUP BY YEAR(`last_updated`) DESC";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    $options = "<option>Vælg år</option>";
    while ($obj = $result->fetch_object()) {
        $year = $obj->year;

        if(isset($yearFilter) && $yearFilter == $year){
            $options .= "<option value='$year' selected>$year</option>";
        }else{
            $options .= "<option value='$year'>$year</option>";
        }
    }
}
?>

<section class="top-space">
    <div class="wrapper">
        <div class="flex justify-between items-center">
            <h1 class="mb-8">Nyheder</h1>
            <!-- Filter year -->
            <select id="filter-year">
                <?php echo $options; ?>
            </select>
        </div>

        <div class="all-news flex flex-wrap">
            <?php echo $news; ?>
        </div>
    </div>
</section>