<section class="top-space">
    <div class="wrapper">

        <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) : ?>
        <div id="adminCalendar" class="w-min">
            <h3 class="my-4">Opret begivenhed</h3>
            <div class="form-row">
                <label for="eventTitle">Navn på begivenhed</label>
                <input type="text" id="eventTitle" />
            </div>

            <div class="form-row">
                <label for="startDate">Startdato</label>
                <input type="text" id="startDate" data-toggle="datepicker" />
            </div>

            <!-- <div class="radio-row">
                <input type="checkbox" class="checkbox" id="all_day" checked>
                <label for="all_day">Heldags engagement</label>
            </div>

            <div class="form-row">
                <label for="endDate">Slutdato</label>
                <input type="text" disabled data-toggle="datepicker" id="endDate" />
            </div> -->

            <div class="form-row">
                <button id="addEvent" class="btn btn-primary">Opret begivenhed</button>
            </div>
        </div>
        <?php endif; ?>

        <h1 class="mb-8">Kalender</h1>
        <div id="calendar"></div>
    </div>
</section>