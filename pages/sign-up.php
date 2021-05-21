<?php
$user_id = $_SESSION['user_id'];
?>
<section class="top-space">
    <div class="wrapper">
        <h1>Bliv medlem i Dart Odense</h1>

        <p>Går du og drømmer om at gøre karriere inden for dartsporten, eller ønsker du blot at blive en del af et
            socialt fællesskab, så er Dart Odense noget for dig.</p>
        <p>Vi har flere forskellige typer af medlemsskaber, og du kan herunder beregne din pris for et medlemskab i Dart
            Odense.</p>



            <div class="form-row radio">
                <!-- Membership type -->
                <h3>Medlemstype <span class="required">*</span></h3>
                <div class="radio-row">
                    <input type="radio" class="membership-radio" name="membership" value="1" data-price="275"
                        data-discount="200" id="aktiv">
                    <label for="aktiv">Aktiv</label>
                </div>

                <div class="radio-row">
                    <input type="radio" class="membership-radio" name="membership" value="2" data-price="75" data-discount="60"
                        id="passiv">
                    <label for="passiv">Passiv</label>
                </div>

                <div class="radio-row">
                    <input type="radio" class="membership-radio" name="membership" value="3" data-price="150" data-discount="150"
                        id="pensionist">
                    <label for="pensionist">Pensionist</label>
                </div>

                <div class="radio-row">
                    <input type="radio" class="membership-radio" name="membership" value="4" data-price="100" data-discount="0"
                        id="junior">
                    <label for="junior">Junior</label>
                </div>
            </div>

            <!-- Payment interval -->
            <div class="form-row radio">
                <h3>Betaling hvert <span class="required">*</span></h3>
                <div class="radio-row">
                    <div class="flex items-center mr-3">
                        <input type="radio" class="interval-radio" name="interval" value="2" data-unit="4" id="year">
                        <label for="year">År</label>
                    </div>

                    <div class="flex items-center">
                        <input type="radio" class="interval-radio" name="interval" value="1" data-unit="1" id="quarter">
                        <label for="quarter">Kvartal</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <label for="price">Din pris</label>

                <div class="calc-price">
                    <input type="text" id="calculated-price" disabled value="0">
                    <span>kr.</span>
                </div>
            </div>

            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />

            <button class="btn btn-primary" id="sign-up">Bliv medlem</button>

        <div id="server-msg"></div>
    </div>
</section>