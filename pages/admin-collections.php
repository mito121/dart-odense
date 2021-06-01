<section class="top-space">
    <div class="wrapper">
        <div>
            <h2>Opret album</h2>

            <div class="server-response" id="create-collection"></div>

            <div class="form-row">
                <label for="collection_name">Titel</label>
                <input type="text" name="collection_name" id="collection_name">
            </div>

            <div class="flex">
                <div class="form-row-50">
                    <label for="collection_desc">Beskrivelse</label>
                    <textarea class="tinymce" name="the_post" id="collection_desc"></textarea>
                </div>

                <!-- Drag & drop area -->
                <div class="form-row-50">
                    <label for="collection_images">Billeder</label>
                    <div id="drop_file_zone" ondrop="upload_file(event); this.style.backgroundColor = '#eee';"
                        ondragover="this.style.backgroundColor = '#ccc'; return false;"
                        ondragleave="this.style.backgroundColor = '#eee'">
                        <div id="drag_upload_file">
                            <p>Træk og slip billeder her</p>
                            <p>eller</p>
                            <p><input type="button" class="btn btn-secondary" id="collection_images"
                                    value="Vælg billeder" onclick="file_explorer();">
                            </p>
                            <input type="file" id="selectfile" multiple>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="thumbnail" value />
            </div>
            <!-- List of uploaded files -->

            <div class="mt-6">
                <span id="select-cover-image">Vælg det billede du vil bruge som bannerbillede</span>
                <div id="img-preview"></div>
            </div>


            <button class="btn btn-primary my-5" id="submit-collection" onclick="upload_collection()">Opret
                album</button>
        </div>
    </div>
</section>