<div class="wrapper top-space">
    <section>
        <h1>Administrér nyheder</h1>

        <div>
            <h2>Opret nyhed</h2>

            <form action="./handlers/create_post.php" method="POST">
                <div class="form-row">
                    <label for="the_heading">Titel</label>
                    <input type="text" name="the_heading" id="the_heading" />
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
        <?php echo isset($_GET['msg']) ? $_GET['msg'] : null; ?>
    </section>
</div>



<script>
    tinymce.init({
        selector: '.tinymce'
    });
</script>