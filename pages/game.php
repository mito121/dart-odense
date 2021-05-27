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


/* 
*** Check if user is admin
 */
if(isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $_SESSION['role_id'] == 3){
    $admin_controls = " <div id=\"admin\">
                            <div class=\"admin-controls my-4\">
                                <form action=\"./handlers/delete_game.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"id\" value=\"$id\">
                                    <button type=\"submit\" class=\"btn btn-secondary mr-2\" onclick=\"return confirm('Er du sikker på at du vil slette dette spil?')\">Slet spil</button>
                                </form>

                                <form action=\"./handlers/update_game.php\" method=\"POST\">
                                    <button type=\"button\" class=\"btn btn-tertiary ml-2\" id=\"openEditModal\">Redigér spil</button>

                                    <div id=\"editModal\" class=\"modal\">
                                        <div class=\"modal-content\">
                                            <h1 class=\"mb-6\">Redigér spil</h1>
                                            <span class=\"close\">&times;</span>
                                            <input type=\"text\" name=\"new_name\" class=\"my-4\" value=\"$name\" />
                                            <textarea class=\"tinymce\" name=\"new_rules\">$rules</textarea>
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
        <h1 class="mb-8"><?php echo $name; ?></h1>

        <!-- admin controls -->
        <?php echo $admin_controls; ?>

        <div class="flex">
            <div class="w-3/6 pr-6">
                <?php echo $rules; ?>
            </div>

            <div class="w-3/6">
                <img class="mx-auto" src="<?php echo $img; ?>" alt="<?php echo $name; ?>">
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

<script>
// Get the modal
var modal = document.getElementById("editModal");

// Get the button that opens the modal
var btn = document.getElementById("openEditModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>