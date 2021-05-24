<section class="top-space">
    <div class="wrapper">
        <h2>Opret spil</h2>

        <form action="./handlers/create_game.php" method="POST" enctype="multipart/form-data">
            <div class="flex w-full justify-between">
                <div class="form-row">
                    <label for="name">Spilnavn</label>
                    <input type="text" name="name" id="name" />
                </div>

                <div class="form-row">
                    <label for="fileToUpload">Bannerbillede</label>
                    <input type="file" name="image" id="fileToUpload">
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