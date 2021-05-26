<?php
/* Get server response */
if(isset($_GET['msg']) && !empty($_GET['msg'])){
    $response = $_GET['msg'];
    $display = "block";
} else {
    $response = "";
    $display = "none";
}
?>
<section class="top-space">
    <div class="wrapper">
        <h2>Opret spil</h2>

        <!-- Server msg -->
        <p class="server_msg" style="display: <?php echo $display; ?>"><?php echo $response; ?></p>

        <form action="./handlers/create_game.php" method="POST" enctype="multipart/form-data">
            <div class="flex w-full justify-between">
                <div class="form-row">
                    <label for="name">Spilnavn</label>
                    <input type="text" name="name" id="name" required />
                </div>

                <div class="form-row">
                    <label for="fileToUpload">Bannerbillede</label>
                    <input type="file" name="image" id="fileToUpload" required>
                </div>
            </div>

            <div class="form-row">
                <label for="rules">Regler</label>
                <textarea class="tinymce" name="rules" id="rules"></textarea>
            </div>

            <button class="btn btn-primary" type="submit">Opret spil</button>
        </form>
    </div>
</section>