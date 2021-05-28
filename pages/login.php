<section class="top-space">
    <div class="wrapper">
        <h1>Log ind</h1>
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
            <button type="submit" class="btn btn-primary">Log ind</button>
            <br />
            <p>
                <?php echo isset($_GET['message']) ? $_GET['message'] : null; ?>
            </p>
        </form>
    </div>
</section>