<footer class="footer_area pt-5">
    <div class="container">
        <div class="lgn1">
            <div class="row pb-5">
                <div class="col-md-3 col-sm-6">
                    <div class="single_ftr">
                        <h4 class="sf_title">Contacts</h4>
                        <ul>
                            <li>**Rue** de Mulhouse 36, 4020 Liège, <br> Belgium
                            </li>
                            <li>Contactus@fistos.com</li>
                        </ul>
                    </div>
                </div> <!-- End Col -->

                <div class="col-md-3 col-sm-6">
                    <div class="single_ftr">
                        <h4 class="sf_title">Boards</h4>
                        <ul>
                            <li><a href="board_general.php">GENERAL</a></li>
                            <li><a href="board_development.php">DEVELOPMENT</a></li>
                            <li><a href="board_talks.php">SMALL TALKS</a></li>
                            <li><a href="board_events.php">EVENTS</a></li>
                        </ul>
                    </div>
                </div> <!--  End Col -->
                <div class="col-md-4 col-sm-6">
                    <div class="single_ftr">
                        <h4 class="sf_title">About the forum</h4>
                        <ul>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam blandit arcu a rhoncus tempus. Suspendisse a neque elit. Nulla facilisi. Nulla facilisi. Aenean vehicula in lorem blandit maximus. Morbi commodoravida lacus at molestie.</li>
                        </ul>
                    </div>
                </div> <!--  End Col -->

                <div class="col-md-2 col-sm-6 pl-5">
                    <img src="https://i.pinimg.com/originals/7f/d6/91/7fd691d130581dc0c10e7f79dbeb9106.png">
                </div>
            </div>
            <div class="border-top border-white">
                <div class="col-md-12 col-sm-7 pb-5 d-flex justify-content-center">
                    <p class="copyright_text text-center">© 2020 All Rights Reserved TeamFistos ® </p>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once 'Parsedown.php';
    $parsedown = new Parsedown();
    echo $parsedown->text(
        '#Faut lier la BDD ici'
    );
    ?>
</footer>