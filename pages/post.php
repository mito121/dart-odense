<?php
require_once 'includes/dbconnect.php';

/* 
*** Get news
 */
$id = $_GET['id'];
if(isset($id)){
    $sql = "
        SELECT `dart_posts`.`title` AS title, `dart_posts`.`content` AS content, `dart_users`.`name` AS author_name, `dart_posts`.`read_time` AS read_time, `dart_posts`.`author_id` AS author_id, `dart_posts`.`last_updated` AS last_updated, `dart_images`.`path` AS img 
        FROM `dart_posts`
        LEFT JOIN `dart_images` ON `dart_images`.`post_id` = `dart_posts`.`id`
        LEFT JOIN `dart_users` ON `dart_users`.`id` = `dart_posts`.`author_id`
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
        $post_author = $obj->author_name;
        $post_updated = $obj->last_updated;
        $img_src = "./uploads/" . $obj->img;
    }
}

$year = substr($post_updated, 0, 4);
$month = substr($post_updated, 5, 2);
$day = substr($post_updated, 8, 2);

/* 
*** Check if user is admin
 */
if(isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $_SESSION['role_id'] == 3){
    $admin_controls = "<div id=\"admin\">
                            <div class=\"admin-controls my-4\">
                                <form action=\"./handlers/delete_post.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"id\" value=\"$id\">
                                    <button type=\"submit\" class=\"btn btn-secondary mr-2\" onclick=\"return confirm('Er du sikker på at du vil slette denne nyhed?')\">Slet nyhed</button>
                                </form>

                                <form action=\"./handlers/update_post.php\" method=\"POST\">
                                    <button type=\"button\" class=\"btn btn-tertiary ml-2\" id=\"openEditModal\">Redigér nyhed</button>

                                    <div id=\"editModal\" class=\"modal\">
                                        <div class=\"modal-content\">
                                            <h1 class=\"mb-6\">Redigér nyhed</h1>
                                            <span class=\"close\">&times;</span>
                                            <input type=\"text\" name=\"new_title\" class=\"my-4\" value=\"$post_title\" />
                                            <textarea class=\"tinymce\" name=\"new_content\">$post_content</textarea>
                                            <input type=\"hidden\" name=\"id\" value=\"$id\">

                                            <button type=\"submit\" class=\"btn btn-primary my-4\">Gem ændringer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        ";
} else {
    $admin_controls = "";
}
?>

<section class="top-space">
    <div class="wrapper">
        <h1 class="mb-8"><?php echo $post_title; ?></h1>

        <!-- admin controls -->
        <?php echo $admin_controls; ?>

        <div class="parallax" style="background-image: url(<?php echo $img_src; ?>);"></div>

        <div class="post-content">
            <?php echo $post_content; ?>
        </div>

        <div class="post-footer">
            <span><?php echo $day . "-" . $month . "-" . $year; ?></span>
            <span><?php echo $post_author; ?></span>
        </div>
    </div>
</section>

<?php echo isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $_SESSION['role_id'] == 3 ? "
        <script>
        // Get the modal
        var modal = document.getElementById('editModal');

        // Get the button that opens the modal
        var btn = document.getElementById('openEditModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName('close')[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = 'block';
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = 'none';
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
        </script>"
: null; ?>