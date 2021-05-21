<section class="top-space">
    <div class="wrapper">
        <form action="./handlers/logon.php" method="post">
            <div class="form-row">
                <label for="email">Email</label>
                <!-- <input type="email" id="email" name="email" placeholder="Indtast din email" /> -->
                <input type="text" id="email" name="email" placeholder="Indtast din email" />
            </div>
            <div class="form-row">
                <label for="password">Adgangskode</label>
                <input type="password" id="password" name="password" placeholder="Indtast din adgangskode" />
            </div>
            <button type="submit">Log ind</button>
            <br />
            <?php echo isset($_GET['message']) ? $_GET['message'] : null; ?>
        </form>
    </div>
</section>