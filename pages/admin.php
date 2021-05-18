<section>
    <h1>Admin panel</h1>

    <form action="./handlers/add_image.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <label for="fileToUpload">Select image to upload:</label>
            <input type="file" name="image" id="fileToUpload">
        </div>

        <button type="submit">Upload</button>
        <br />
        <?php echo isset($_GET['message']) ? $_GET['message'] : null; ?>
    </form>
</section>