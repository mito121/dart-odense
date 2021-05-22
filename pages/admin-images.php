<div class="wrapper top-space">
    <section>
        <h1>Administrér billeder</h1>
        <?php echo isset($_GET['msg']) ? $_GET['msg'] : null; ?>
        <div>
            <h2>Upload enkelt billede</h2>
            <form action="./handlers/add_image.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <label for="fileToUpload">Select image to upload:</label>
                    <input type="file" name="image" id="fileToUpload">
                </div>

                <button class="btn btn-primary" type="submit">Upload</button>
                <br />
                <?php echo isset($_GET['message']) ? $_GET['message'] : null; ?>
            </form>
        </div>

    </section>

    <section>
        <div>
            <h2>Opret album</h2>


            <div class="server-response" id="create-collection"></div>

            <div class="form-row">
                <label for="collection_name">Navn på album</label>
                <input type="text" name="collection_name" id="collection_name">
            </div>

            <div class="flex">
                <div class="form-row-50">
                    <label for="collection_desc">Album beskrivelse</label>
                    <textarea class="tinymce" name="the_post" id="collection_desc"></textarea>
                </div>

                <!-- Drag & drop area -->
                <div class="form-row-50">
                    <label for="collection_images">Album billeder</label>
                    <div id="drop_file_zone" ondrop="upload_file(event); this.style.backgroundColor = '#eee';"
                        ondragover="this.style.backgroundColor = '#ccc'; return false;"
                        ondragleave="this.style.backgroundColor = '#eee'">
                        <div id="drag_upload_file">
                            <p>Drop files here</p>
                            <p>or</p>
                            <p><input type="button" class="btn btn-secondary" id="collection_images" value="Select Files"
                                    onclick="file_explorer();">
                            </p>
                            <input type="file" id="selectfile" multiple>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="thumbnail" value />
            </div>
            <!-- List of uploaded files -->
            <!-- <ol id="uploaded-files"></ol> -->
            <div id="img-preview"></div>



            <button class="btn btn-primary" id="submit-collection" onclick="upload_collection()">Opret album</button>
        </div>
    </section>
</div>