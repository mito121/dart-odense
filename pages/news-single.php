<?php
require_once 'includes/dbconnect.php';

/* 
*** Get news
 */
$id = $_GET['id'];
if(isset($id)){
    $sql = "
        SELECT `dart_posts`.`title` AS title, `dart_posts`.`content` AS content, `dart_posts`.`read_time` AS read_time, `dart_posts`.`author_id` AS author_id, `dart_posts`.`last_updated` AS last_updated, `dart_images`.`path` AS img 
        FROM `dart_posts`
        LEFT JOIN `dart_images` ON `dart_images`.`post_id` = `dart_posts`.`id`
        WHERE `dart_posts`.`id` = '$id'
    ";
} else {
    die("Hovsa... Denne her nyhed findes ikke!");
}
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    while ($obj = $result->fetch_object()) {
        $post_title = $obj->title;
        $post_read_time = $obj->read_time;
        $post_content = $obj->content;
        $post_author = $obj->author_id;
        $post_updated = $obj->last_updated;
        $img_src = "./uploads/" . $obj->img;
    }
}
?>

<section class="top-space">
    <div class="wrapper">
        <h1 class="mb-8"><?php echo $post_title; ?></h1>

        <div class="parallax" style="background-image: url(<?php echo $img_src; ?>);"></div>
        <!-- <img src="<?php /* echo $img_src; */ ?>" alt="bannerbillede"> -->

        <div class="post-content">
            <?php echo $post_content; ?>
        </div>
    </div>
</section>