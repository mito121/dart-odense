<?php
require_once 'includes/dbconnect.php';

/* 
*** Get news
 */
$sql = "SELECT `dart_games`.`id` AS id, `dart_games`.`name` AS name, `dart_games`.`rules` AS rules, `dart_images`.`path` AS img
        FROM `dart_games`
        LEFT JOIN `dart_images` ON `dart_games`.`id` = `dart_images`.`game_id`
        ORDER BY `dart_games`.`name` ASC
        ";
$result = $conn->query($sql);

$games = "";

if ($result && mysqli_num_rows($result) > 0) {
    while ($obj = $result->fetch_object()) {
        $game_id = $obj->id;
        $game_name = $obj->name;
        $game_rules = $obj->rules;
        $img_src = "./uploads/small/" . $obj->img;

        /* If rules content is too long, cut it off and strip tags */
        if (strlen($game_rules) > 150) {
            $game_rules = str_replace("&nbsp;", '', $game_rules);
            $game_rules = substr($game_rules, 0, 150) . "... <span class=\"tbc\">[Fortsættes]</span>";
        }

        $games .= "  <div class=\"game\">
                        <div class=\"flex flex-col justify-between\">
                            <div class=\"w-full\">
                                <h1>$game_name</h1>
                                <p>$game_rules</p>
                            </div>

                            <a href=\"index.php?page=game&id=$game_id\" class=\"btn btn-primary w-min\">Se regler og stillinger</a>
                        </div>

                        <div>
                            <img src=\"$img_src\" alt=\"\">
                        </div>
                    </div>";
    }
}
?>
<section class="top-space">
    <div class="wrapper">
        <div class="flex justify-between items-center w-full">
            <h1 class="mb-8">Spil og regler</h1>
            <input type="text" placeholder="Søg">
        </div>


        <div class="games">
            <?php echo $games; ?>
        </div>
    </div>
</section>