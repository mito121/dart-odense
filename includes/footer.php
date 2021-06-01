        </main>
        <footer>
            <div class="wrapper <?php echo $pageName === 'home' ? 'p-15px' : null; ?>">
                <div class="flex justify-between w-full footer-flex">
                    <p class="flex items-center"> <span>&copy;</span> <span id="current-year"></span> Dart Odense -
                        All
                        rights reserved.</p>

                    <div
                        class="flex flex-col text-right <?php echo $pageName === 'news' || $pageName === 'galleries' ? 'pr-30px' : null; ?>">
                        <p class="follow-us my-3">Følg os!</p>
                        <div class="flex">
                            <a href=" #" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" target="_blank">
                                <i class="fab fa-snapchat"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ** JS ** -->
        <!-- fontawesome -->
        <script src="assets/js/fontawesome/fontawesome.js"></script>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        /* Fix unsupported passive listeners */
        jQuery.event.special.touchstart = {
            setup: function(_, ns, handle) {
                this.addEventListener("touchstart", handle, {
                    passive: true
                });
            }
        };
        </script>
        <!-- slick -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="assets/js/backstrech/backstrech.js"></script>
        <script src="assets/js/pagination/pagination.js"></script>

        <!-- Include calendar JS if page is calendar -->
        <?php if($pageName == 'calendar') : ?>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/locales-all.js"></script>
        <script src="assets/js/datepicker/datepicker.js"></script>
        <script src="assets/js/calendar/calendar.js"></script>
        <?php endif; ?>

        <script src="assets/js/script.js"></script>
        </body>

        </html>