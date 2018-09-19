<div class="col-sm-6 hidden-xs">
    <div class="call-us">
        <p class="mb-0 roboto">Kontakt telefon: <a class="kontakt-navbar-href" href="tel:+38736330391">+387 36 330 391</a> | E-mail: <a class="kontakt-navbar-href" href="mailto:selekting@gmail.com">selekting@gmail.com</a></p>
    </div>
</div>
<div class="col-sm-6 col-xs-12">
    <div class="top-link clearfix">
        <ul class="link f-right">
            <?php
                if(isset($_SESSION['klijent'])){
                    echo '<li>
                            <a href="logout.php">
                                <i class="zmdi zmdi-lock"></i>
                                Odjava
                            </a>
                        </li>';
                }else{
                    echo '<li>
                            <a href="login.php">
                                <i class="zmdi zmdi-lock"></i>
                                Prijava
                            </a>
                        </li>';
                }
            ?>            
        </ul>
    </div>
</div>