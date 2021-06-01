<section class="top-space">
    <div class="wrapper">
        <div class="login-wrapper">
            <h1>Log ind</h1>
            <form action="./handlers/logon.php" method="post">
                <div class="form-row text-left">
                    <label for="email">Email</label>
                    <!-- <input type="email" id="email" name="email" placeholder="Indtast din email" /> -->
                    <input type="text" id="email" name="email" placeholder="Indtast din email" />
                </div>
                <div class="form-row text-left">
                    <label for="password">Adgangskode</label>
                    <input type="password" id="password" name="password" placeholder="Indtast din adgangskode" />
                </div>

                <div class="flex w-full justify-between items-center">
                    <div class="radio-row">
                        <input type="checkbox" class="checkbox" id="remember_me">
                        <label for="remember_me">Husk mig</label>
                    </div>

                    <div class="form-row">
                        <a class="link" href="#">Glemt adgangskode?</a>
                    </div>
                </div>


                <div class="w-full text-right">
                    <button type="submit" class="btn btn-primary">Log ind</button>
                </div>
                <br />
                <p>
                    <?php echo isset($_GET['message']) ? $_GET['message'] : null; ?>
                </p>
            </form>
        </div>
    </div>
</section>