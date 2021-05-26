<section class="top-space">
    <div class="wrapper">
        <h1>Kontakt os</h1>

        <div class="flex">
            <div class="pt-10 pr-8">
                <p>
                    Vi bor i Odense, kun 20 minutters gang fra banegården, på adressen:
                </p>

                <ul>
                    <li>Dart Odense</li>
                    <li>Grønløkkevej 16, kld.</li>
                    <li>5000 Odense C</li>
                </ul>

                <p>
                    Har du spørgsmål eller lignende, kan vi kontaktes på telefon på:
                </p>

                <p>Tlf. 42 50 11 80</p>

                <p>Eller du kan skrive os en besked i formularen nedenunder, så venner vi tilbage snarest muligt.</p>
            </div>

            <div class="contact-form">
                <form action="./handlers/contact.php" method="POST">
                    <div class="form-row">
                        <label for="name">Navn <span class="required">*</span></label>
                        <input type="text" id="name" name="name">
                    </div>

                    <div class="form-row">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="form-row">
                        <label for="phone">Telefonnummer </label>
                        <input type="email" id="phone" name="phone">
                    </div>

                    <div class="form-row">
                        <label for="message">Besked <span class="required">*</span></label>
                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-row">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>




    </div>
</section>