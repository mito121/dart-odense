<?php
require_once 'includes/login_protect.php';
require_once 'includes/dbconnect.php';

$user_id = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;


/* 
*** Get galleries
 */
$sql = "
        SELECT dart_memberships.id AS membership_id, dart_memberships.type_id AS membership_type_id, dart_memberships.interval_id AS payment_interval_id, dart_memberships.price AS membership_price, dart_memberships.start_date AS date, dart_membertypes.name AS membership_type_name, dart_payment_intervals.name AS payment_name
        FROM `dart_memberships`
        LEFT JOIN dart_membertypes ON dart_membertypes.id = dart_memberships.type_id
        LEFT JOIN dart_payment_intervals ON dart_payment_intervals.id = dart_memberships.interval_id
        WHERE user_id = '$user_id'";

$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    while ($obj = $result->fetch_object()) {
        $membership_id = $obj->membership_id;
        $membership_type_id = $obj->membership_type_id;
        $membership_price = $obj->membership_price;
        $membership_type_name = $obj->membership_type_name;
        $payment_name = $obj->payment_name;
        $payment_interval_id = $obj->payment_interval_id;
        $date = $obj->date;
    }
}

/* Get tab to pre-open */
if(isset($_GET['tab']) && !empty($_GET['tab'])){
    $tab = $_GET['tab'];
    $openTab = "
        .tabcontent:nth-of-type($tab) {
            display: block;
        }
    ";
} else {
    $tab = 0;
    $openTab = "
    .tabcontent:nth-of-type(1) {
        display: block;
    }
";
}

/* Get server response */
if(isset($_GET['response']) && !empty($_GET['response'])){
    $response = $_GET['response'];
    $display = "block";
} else {
    $response = "";
    $display = "none";
}
?>
<style>
<?php echo $openTab;
?>
</style>
<section class="top-space">
    <div class="wrapper">
        <h1 class="mb-8">Min profil</h1>


        <div class="tab">
            <!-- Tabs -->
            <div>
                <button class="tablinks <?php echo $tab == 1 || $tab == 0 ? 'active' : null; ?>"
                    onclick="openTab(event, '1')">Betaling</button>
                <button class="tablinks <?php echo $tab == 2 ? 'active' : null; ?>"" onclick=" openTab(event, '2'
                    )">Cashback</button>
                <button class="tablinks <?php echo $tab == 3 ? 'active' : null; ?>"" onclick=" openTab(event, '3'
                    )">Profiloplysninger</button>
            </div>


            <!-- Server response -->
            <div>
                <p class="server_msg" style="display: <?php echo $display; ?>"><?php echo $response; ?></p>
            </div>
        </div>

        <!-- Tabs content -->
        <div class="tabs-content">
            <!-- Payment (betaling) -->
            <div id="1" class="tabcontent">
                <div class="flex flex-wrap">
                    <div class="w-4/6 tab-content-inner">
                        <h3 class="missing-payment">Betaling mangler!</h3>

                        <form id="payment-form">
                            <div class="form-row">
                                <label for="cardnumber">Kortnummer</label>
                                <input type="text" id="cardnumber" name="cardnumber">
                            </div>

                            <div class="flex">
                                <div class="form-row-50">
                                    <label for="expiration">Udløbsdato</label>
                                    <input type="text" id="expiration" name="expiration">
                                </div>

                                <div class="form-row-50">
                                    <label for="cdigits">Kontrolcifre</label>
                                    <input type="text" id="cdigits" name="cdigits">
                                </div>
                            </div>

                            <div class="form-row">
                                <button class="btn btn-primary">Betal 275.00 DKK</button>
                            </div>
                        </form>

                    </div>

                    <div class="w-1/3 payment-history tab-content-inner">
                        <h3>Historik</h3>
                        <table class="payment-history">
                            <tr>
                                <td>1. Augst 2020</td>
                                <td>275 DKK</td>
                            </tr>
                            <tr>
                                <td>1. Juli 2020</td>
                                <td>275 DKK</td>
                            </tr>
                            <tr>
                                <td>1. Juni 2020</td>
                                <td>275 DKK</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> <!-- /payment (betaling) -->

            <!-- Cashback -->
            <div id="2" class="tabcontent">
                <div class="flex flex-wrap">
                    <div class="tab-content-inner">
                        <h3>Cashback</h3>
                        <div class="tab-content-inner">
                            <p>Som medlem i Dart Odense kan du drage fordel af personlige rabatter ved udvalgte partnere
                                i form a cashback.</p>
                            <p><a href="#">Klik her</a> for at se alle vores cashback samarbejdspartnere, og hvor store
                                rabatter de hver især tilbyder.</p>

                            <table class="cashback-table">
                                <tr>
                                    <th>Optjent i alt</th>
                                    <th>Udbetalt</th>
                                    <th>Nuværende balance</th>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                            </table>

                            <br />
                            <p>Alt hvad der optjenes i cashback bliver tilføjet til din konto som partnerpoint. Der skal
                                100 partnerpoint til 1 kr. <br />
                                Så hvis der optjenes 24 kr. i cashback fra <a href="#"
                                    target="_blank">DanskOutlet.dk</a>, vil du få tilskrevet 2400 partnerpoint til din
                                konto.
                            </p>

                            <p>Cashback kan udbetales i klubbben, ved at lave en <a href="#">anmodning om
                                    udbetaling</a>, det kræver blot at du har 10.000 partnerpoint.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile data (Profiloplysninger) -->
            <div id="3" class="tabcontent">
                <div class="flex flex-wrap">
                    <div class="w-1/3 tab-content-inner">
                        <h3>Skift medlemskab</h3>
                        <div class="profile-content">
                            <div class="profile-content">
                                <!-- Current membership -->
                                <h4>Nuværende medlemskab:</h4>

                                <table class="current-membership">
                                    <tr>
                                        <td>Medlemstype:</td>
                                        <td><?php echo $membership_type_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Betalingsinterval:</td>
                                        <td><?php echo $payment_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pris:</td>
                                        <td><?php echo $membership_price; ?> DKK</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- New membership -->
                            <form action="./handlers/change_membership.php" method="POST">
                                <div class="form-wrapper" id="membership-form">
                                    <!-- Choose membership -->
                                    <div class="form-row radio">
                                        <!-- Membership type -->
                                        <h4>Medlemstype <span class="required">*</span></h4>
                                        <div class="radio-row">
                                            <input type="radio" class="membership-radio" name="membership" value="1"
                                                data-price="275" data-name="Aktiv" data-discount="200" id="aktiv">
                                            <label for="aktiv">Aktiv</label>
                                        </div>

                                        <div class="radio-row">
                                            <input type="radio" class="membership-radio" name="membership" value="2"
                                                data-price="75" data-discount="60" data-name="Passiv" id="passiv">
                                            <label for="passiv">Passiv</label>
                                        </div>

                                        <div class="radio-row">
                                            <input type="radio" class="membership-radio" name="membership" value="3"
                                                data-price="150" data-discount="150" data-name="Pensionist"
                                                id="pensionist">
                                            <label for="pensionist">Pensionist</label>
                                        </div>

                                        <div class="radio-row">
                                            <input type="radio" class="membership-radio" name="membership" value="4"
                                                data-price="100" data-discount="0" data-name="Junior" id="junior">
                                            <label for="junior">Junior</label>
                                        </div>
                                    </div>

                                    <!-- Membership details -->
                                    <div class="form-row radio" id="member-details">
                                        <h4 id="membership-heading"></h4>
                                        <ol class="pl-8" id="membership-details"></ol>

                                        <!-- Discount row -->
                                        <div id="parents-radio">
                                            <h4>Har du forældre i klubben?</h4>
                                            <div class="radio-row">
                                                <input type="radio" class="parents-radio" name="parents" value="1"
                                                    data-discount="200" id="parents-ja">
                                                <label for="parents-ja">Ja</label>
                                            </div>
                                            <div class="radio-row">
                                                <input type="radio" class="parents-radio" name="parents" value="0"
                                                    data-discount="200" id="parents-nej">
                                                <label for="parents-nej">Nej</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment interval -->
                                    <div class="form-row radio">
                                        <h4>Betaling hvert <span class="required">*</span></h4>
                                        <div class="radio-row">
                                            <div class="flex items-center mr-3">
                                                <input type="radio" class="interval-radio" name="interval" value="2"
                                                    data-unit="4" id="year">
                                                <label for="year">År</label>
                                            </div>

                                            <div class="flex items-center">
                                                <input type="radio" class="interval-radio" name="interval" value="1"
                                                    data-unit="1" id="quarter">
                                                <label for="quarter">Kvartal</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <label for="new_price">Ny pris</label>

                                        <div class="calc-price">
                                            <input type="text" id="calculated-price" disabled value="0"
                                                name="new_price">
                                            <span>kr.</span>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" id="change-membership">Skift medlemskab</button>
                                </div> <!-- </form-wrapper > membership form> -->
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="new_price" id="post_price" value />
                            </form>
                        </div>

                    </div>

                    <div class="w-1/3 payment-history tab-content-inner">
                        <h3>Skift email</h3>
                        <!-- Change email -->
                        <form action="./handlers/change_email.php" method="POST">
                            <div class="mb-12">
                                <div class="form-row">
                                    <label for="current_email">Nuværende email</label>
                                    <input type="text" id="current_email" name="current_email">
                                </div>
                            </div>


                            <div class="form-row">
                                <label for="new_mail">Ny email</label>
                                <input type="text" id="new_mail" name="new_email">
                            </div>

                            <div class="form-row">
                                <label for="email_repeat">Gentag email</label>
                                <input type="text" id="email_repeat" name="email_repeat">
                            </div>

                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                            <button type="submit" class="btn btn-primary">Skift email</button>
                        </form>
                    </div>

                    <div class="w-1/3 payment-history tab-content-inner">
                        <h3>Skift adgangskode</h3>
                        <!-- Change password -->
                        <form action="./handlers/change_password.php" method="POST">
                            <div class="mb-12">
                                <div class="form-row">
                                    <label for="current_password">Nuværende adganskode</label>
                                    <input type="password" id="current_password" name="current_password">
                                </div>
                            </div>

                            <div class="form-row">
                                <label for="new_password">Ny adganskode</label>
                                <input type="password" id="new_password" name="new_password">
                            </div>

                            <div class="form-row">
                                <label for="password_repeat">Gentag adganskode</label>
                                <input type="password" id="password_repeat" name="password_repeat">
                            </div>

                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                            <button type="submit" class="btn btn-primary">Skift adgangskode</button>
                        </form>
                    </div>
                </div>
            </div> <!-- /profile data (profiloplysninger) -->
        </div> <!-- /tabs content -->
    </div>
</section>

<script>
function openTab(evt, tab) {
    let i;
    const tabcontent = document.getElementsByClassName("tabcontent");
    const tablinks = document.getElementsByClassName("tablinks");

    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tab).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>