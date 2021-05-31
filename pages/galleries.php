<?php
require_once 'includes/dbconnect.php';

/* 
*** Get galleries
 */
$yearFilter = !empty($_GET['year']) ? $_GET['year'] : null;
if(isset($yearFilter)){
    $sql = "SELECT `dart_collections`.`id` AS id, `dart_collections`.`name` AS name, `dart_collections`.`description` AS description, 
                    `dart_collections`.`thumbnail` AS img, YEAR(`dart_collections`.`last_updated`) AS year, `dart_collections`.`last_updated` AS last_updated,
                    COUNT(`dart_images`.id) AS count
            FROM `dart_collections` 
            LEFT JOIN `dart_images` ON `dart_images`.`collection_id` = `dart_collections`.`id`
            WHERE YEAR(last_updated) = '$yearFilter'
            GROUP BY `dart_collections`.`id`
            ORDER BY `last_updated` DESC, `id` DESC";
} else {
    $sql = "SELECT `dart_collections`.`id` AS id, `dart_collections`.`name` AS name, `dart_collections`.`description` AS description, 
                    `dart_collections`.`thumbnail` AS img, YEAR(`dart_collections`.`last_updated`) AS year, `dart_collections`.`last_updated` AS last_updated,
                    COUNT(`dart_images`.id) AS count
            FROM `dart_collections` 
            LEFT JOIN `dart_images` ON `dart_images`.`collection_id` = `dart_collections`.`id`
            GROUP BY `dart_collections`.`id`
            ORDER BY `last_updated` DESC, `id` DESC";
}

$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    $galleries = "";
    $yearHeadings = array();
    while ($obj = $result->fetch_object()) {
        $gallery_id = $obj->id;
        $gallery_name = $obj->name;
        $gallery_desc = $obj->description;
        $gallery_updated = $obj->last_updated;
        $img_src = "./uploads/small/" . $obj->img;
        $img_count = $obj->count;

        $year = substr($gallery_updated, 0, 4);
        $month = substr($gallery_updated, 5, 2);
        $day = substr($gallery_updated, 8, 2);

        // Check if Year header should be insterted
        if (false !== $key = array_search($year, $yearHeadings)) { // year is not new - dont add heading
            $thisHeading = "";
        } else { // year is new - add heading
            $yearHeadings[] = $year;
            $thisHeading = "<h2 class=\"year-heading\">" . end($yearHeadings) . "</h2>";
        }

        $galleries .= "
                $thisHeading
                <div class=\"gallery-container\">
                    <a href=\"index.php?page=gallery&id=$gallery_id\">
                        <div class=\"gallery-header\">
                            <h3>$gallery_name</h3>
                        </div>
                        <div class=\"num-of-images\">
                            $img_count billeder
                        </div>
                        <div class=\"gallery-thumbnail\">
                            <img src=\"$img_src\" alt=\"bannerbillede\" />
                        </div>
                        <div class=\"gallery-footer\">
                        <div class=\"flex w-full justify-between\">
                            <span>$day-$month-$year</span>
                        </div>
                    </div>
                    </a>
                </div>";
    }
} else {
    $galleries = "Der er endnu ikke oprettet nogle albummer.";
}

/* 
*** Get year filter select options
 */
$sql = "SELECT YEAR(`last_updated`) as year FROM `dart_collections` GROUP BY YEAR(`last_updated`) DESC";
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
        <div class="flex justify-between flex-wrap items-center pr-30px">
            <h1 class="mb-8">Albummer</h1>
            <!-- Filter year -->
            <select id="gallery-filter-year">
                <?php echo $options; ?>
            </select>
        </div>

        <div class="all-news flex flex-wrap">
            <?php echo $galleries; ?>
        </div>
    </div>
</section>