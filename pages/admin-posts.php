<section class="top-space">
    <div class="wrapper">
        <h2>Opret nyhed</h2>

        <form action="./handlers/create_post.php" method="POST" enctype="multipart/form-data">
            <div class="flex w-full justify-between">
                <div class="form-row">
                    <label for="the_heading">Titel</label>
                    <input type="text" name="the_heading" id="the_heading" />
                </div>

                <div class="form-row">
                    <label for="fileToUpload">Bannerbillede</label>
                    <input type="file" name="image" id="fileToUpload">
                </div>
            </div>

            <div class="form-row">
                <label for="the_post">Brødtekst</label>
                <textarea class="tinymce" name="the_post" id="the_post"></textarea>
            </div>

            <div class="form-row">
                <label for="restricted">Kun for medlemmer</label>
                <input type="checkbox" name="restricted" id="restricted" value="1" />
            </div>

            <input type="hidden" name="author" value="<?php echo $_SESSION['user_id']; ?>" />
            <button class="btn btn-primary" type="submit">Opret nyhed</button>
        </form>
    </div>
</section>