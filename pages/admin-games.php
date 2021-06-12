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
                    <label for="name">Navn</label>
                    <input type="text" name="name" id="name" required />
                </div>

                <div class="form-row">
                    <label for="fileToUpload">Billede</label>
                    <input type="file" name="image" id="fileToUpload" required>
                </div>
            </div>

            <div class="form-row">
                <label for="rules">Regler & beskrivelse</label>
                <textarea class="tinymce" name="rules" id="rules"></textarea>
            </div>

            <button class="btn btn-primary" type="submit">Opret spil</button>
        </form>
    </div>
</section>

<script>
/*
 *** FORBEDRINGER
 */

/* Preview single banner image */
const bannerImg = document.getElementById("fileToUpload");
const bannerPreview = document.getElementById("bannerimg-preview");
const bannerPreviewText = document.getElementById("select-cover-image");
bannerImg.onchange = (evt) => {
    const [file] = bannerImg.files;
    if (file) {
        bannerPreviewText.style.display = "block";
        bannerPreview.style.height = "350px";
        bannerPreview.style.backgroundImage = "url(" + URL.createObjectURL(file) + ")";
    } else {
        bannerPreviewText.style.display = "none";
        bannerPreview.style.height = 0;
    }
};
</script>