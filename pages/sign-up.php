<?php
$user_id = $_SESSION['user_id'];
$response = isset($_GET['response']) === true ? $_GET['response'] : false;
?>
<section class="top-space">
    <div class="wrapper">
        <h1>Bliv medlem i Dart Odense</h1>

        <p>Går du og drømmer om at gøre karriere inden for dartsporten, eller ønsker du blot at blive en del af et
            socialt fællesskab, så er Dart Odense noget for dig.</p>
        <p>Vi har flere forskellige typer af medlemsskaber, og du kan herunder beregne din pris for et medlemskab i Dart
            Odense.</p>

        <!-- 
            ***
            *** TODO: Require user to login before being able to sign up for a membership!
            *** 
         -->

        <div class="form-row radio">
            <!-- Membership type -->
            <h3>Medlemstype <span class="required">*</span></h3>
            <div class="radio-row">
                <input type="radio" class="membership-radio" name="membership" value="1" data-price="275"
                    data-name="Aktiv" data-discount="200" id="aktiv">
                <label for="aktiv">Aktiv</label>
            </div>

            <div class="radio-row">
                <input type="radio" class="membership-radio" name="membership" value="2" data-price="75"
                    data-discount="60" data-name="Passiv" id="passiv">
                <label for="passiv">Passiv</label>
            </div>

            <div class="radio-row">
                <input type="radio" class="membership-radio" name="membership" value="3" data-price="150"
                    data-discount="150" data-name="Pensionist" id="pensionist">
                <label for="pensionist">Pensionist</label>
            </div>

            <div class="radio-row">
                <input type="radio" class="membership-radio" name="membership" value="4" data-price="100"
                    data-discount="0" data-name="Junior" id="junior">
                <label for="junior">Junior</label>
            </div>
        </div>

        <!-- Membership details -->
        <div class="form-row radio" id="member-details">
            <h3 id="membership-heading"></h3>
            <ol class="pl-8" id="membership-details"></ol>

            <!-- Discount row -->
            <div id="parents-radio">
                <h5>Har du forældre i klubben?</h5>
                <div class="radio-row">
                    <input type="radio" class="parents-radio" name="parents" value="0" data-discount="200"
                        id="parents-nej">
                    <label for="parents-nej">Nej</label>
                </div>
                <div class="radio-row">
                    <input type="radio" class="parents-radio" name="parents" value="1" data-discount="200"
                        id="parents-ja">
                    <label for="parents-ja">Ja</label>
                </div>
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

        <input type="hidden" name="user_id" id="user_id"
            value="<?php echo isset($user_id) && !empty($user_id) ? $user_id : 0; ?>" />

        <button class="btn btn-primary" id="sign-up">Bliv medlem</button>

        <?php echo $response !== false ? "<div id=\"server-msg\">$response</div>" : null; ?>
    </div>
</section>