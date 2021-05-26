<?php
require_once 'includes/dbconnect.php';

/* 
*** Get game
 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "
            SELECT dart_games.`name` AS name, dart_games.`rules` AS rules, dart_images.path AS path
            FROM `dart_games` 
            LEFT JOIN dart_images ON dart_games.id = dart_images.game_id 
            WHERE dart_games.id = '$id'";

    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($obj = $result->fetch_object()) {
            $name = $obj->name;
            $rules = $obj->rules;
            $img = "uploads/" . $obj->path;
        }
    }
} else {
    die("Hovsa... Dette spil findes ikke!");
}
?>

<section class="top-space">
    <div class="wrapper">
        <h1 class="mb-8"><?php echo $name; ?></h1>

        <div class="flex">
            <div class="w-3/6 pr-6">
                <?php echo $rules; ?>
            </div>

            <div class="w-3/6">
                <img src="<?php echo $img; ?>" alt="<?php echo $name; ?>">
            </div>
        </div> <!-- /flex -->

        <div class="leaderboard-small">
            <h2><?php echo $name; ?></h2>

            <table class="leaderboard">
                <thead>
                    <tr>
                        <th></th>
                        <th>Navn</th>
                        <th>Point</th>
                        <th>Sejret</th>
                        <th>Deltaget</th>
                        <th>180</th>
                        <th>180R</th>
                        <th>HL</th>
                        <th>100L</th>
                        <th>HS</th>
                        <th>20S</th>
                        <th>HSS</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dartdreas Petterdart</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Skephan</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Claus Toft</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>