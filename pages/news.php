<?php
require_once 'includes/dbconnect.php';

/* 
*** Get news
 */
$yearFilter = !empty($_GET['year']) ? $_GET['year'] : null;
if(isset($yearFilter)){
    $sql = "
    SELECT `id`, `title`, `content`, `read_time`, `author_id`, `last_updated`, YEAR(last_updated) as year 
    FROM `dart_posts`
    WHERE YEAR(last_updated) = '$yearFilter'
    ORDER BY `last_updated` DESC, `id` DESC
    ";
} else {
    $sql = "SELECT `id`, `title`, `content`, `read_time`, `author_id`, `last_updated`, YEAR(last_updated) as year FROM `dart_posts` ORDER BY `last_updated` DESC, `id` DESC";
}

$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    $news = "";
    $yearHeadings = array();
    while ($obj = $result->fetch_object()) {
        $post_id = $obj->id;
        $post_title = $obj->title;
        $post_read_time = $obj->read_time;
        $post_content = $obj->content;
        $post_author = $obj->author_id;
        $post_updated = $obj->last_updated;

        // Check if Year header should be insterted
        $year = substr($post_updated, 0, 4);
        if (false !== $key = array_search($year, $yearHeadings)) { // year is not new - dont add heading
            $thisHeading = "";
        } else { // year is new - add heading
            $yearHeadings[] = $year;
            $thisHeading = "<h2 class=\"news-year-heading\">" . end($yearHeadings) . "</h2>";
        }
        
        /* If post content is too long, cut it off and strip tags */
        if (strlen($post_content) > 100) {
            $post_content = str_replace("&nbsp;", '', $post_content);
            $post_content = substr(strip_tags($post_content), 0, 500) . "... <span class=\"tbc\">[Fortsættes]</span>";
        }

        $news .= "
                $thisHeading
                <div class=\"news-container\">
                    <a href=\"index.php\">
                        <div class=\"slide-header\">
                            <h1>$post_title</h1>
                        </div>
                        <div class=\"read-time\">
                            Læsetid: &#60;$post_read_time min.
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

            <!-- <div class="flex"> -->
                <!-- <select class="mr-3" id="filter-year"> -->
                <select id="filter-year">
                    <?php echo $options; ?>
                </select>

                <!-- <select id="filter-items-per-page">
                    <option selected>20 indlæg pr. side</option>
                    <option>6</option>
                    <option>66</option>
                    <option>666</option>
                    <option>69420</option>
                </select> -->

            <!-- </div> -->
        </div>


        <div class="all-news flex flex-wrap">
            <!-- <h1 class="w-full">2021</h1> -->
            <!--             <div class="news-container">
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
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum... <span class="tbc">[Fortsættes]</span>
                        </p>
                    </div>
                </a>
            </div> -->

            <?php echo $news; ?>

        </div>
    </div>
</section>