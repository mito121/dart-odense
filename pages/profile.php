<style>

</style>


<section class="top-space">
    <div class="wrapper">
        <h1 class="mb-8">Min profil</h1>


        <div class="tab">
            <button class="tablinks active" onclick="openTab(event, '1')">Betaling</button>
            <button class="tablinks" onclick="openTab(event, '2')">Cashback</button>
            <button class="tablinks" onclick="openTab(event, '3')">Profiloplysninger</button>
        </div>

        <!-- Tabs content -->
        <div class="tabs-content">
            <!-- Payment (betaling) -->
            <div id="1" class="tabcontent">
                <div class="flex">
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
                        <table>
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
                <div class="flex">
                    <div class="tab-content-inner">
                        <h3 class="missing-payment">Cashback</h3>
                    </div>
                </div>
            </div>

            <!-- Profile data (Profiloplysninger) -->
            <div id="3" class="tabcontent">
                <div class="flex">
                    <div class="w-1/3 tab-content-inner">
                        <h3>Skift medlemskab</h3>

                        <div>
                            <!-- Current membership -->
                            <h4>Nuværende medlemskab:</h4>

                            <table>
                                <tr>
                                    <td>Medlemstype:</td>
                                    <td>Aktiv</td>
                                </tr>
                                <tr>
                                    <td>Betalingsinterval:</td>
                                    <td>Kvartal</td>
                                </tr>
                                <tr>
                                    <td>Pris:</td>
                                    <td>275 DKK</td>
                                </tr>
                            </table>





                            <!-- New membership -->
                            <form action="./handlers/change_membership.php" method="POST">
                                <div class="form-wrapper" id="membership-form">
                                    <!-- Choose membership -->
                                    <div class="form-row radio">
                                        <!-- Membership type -->
                                        <h3>Medlemstype <span class="required">*</span></h3>
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
                                        <h3 id="membership-heading"></h3>
                                        <ol class="pl-8" id="membership-details"></ol>

                                        <!-- Discount row -->
                                        <div id="parents-radio">
                                            <h3>Har du forældre i klubben?</h3>
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
                                        <h3>Betaling hvert <span class="required">*</span></h3>
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
                                        <label for="price">Din pris</label>

                                        <div class="calc-price">
                                            <input type="text" id="calculated-price" disabled value="0">
                                            <span>kr.</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" id="change-membership">Skift medlemskab</button>
                                </div> <!-- </form-wrapper > membership form> -->
                            </form>
                        </div>

                    </div>

                    <div class="w-1/3 payment-history tab-content-inner">

                    </div>

                    <div class="w-1/3 payment-history tab-content-inner">

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