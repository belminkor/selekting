<?php
session_start();
include "dbkon.php";
include "funkcije.php";

if(!isset($_SESSION['products'])){
  $_SESSION['products'] = array();
  $_SESSION['quantities'] = array();
}

$idklijenta = $conn->real_escape_string($_SESSION['klijent']);

$objekti = Select("klijenti", "WHERE id='$idklijenta'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
    $ime = $objekat['ime'];
    $prezime = $objekat['prezime'];
    $kompanija = $objekat['kompanija'];
    $adresa = $objekat['adresa'];
    $grad = $objekat['grad'];
    $drzava = $objekat['drzava'];
    $postanski = $objekat['postanski'];
    $email = $objekat['email'];
    $telefon = $objekat['telefon'];
}
?>
<!doctype html>
<html class="no-js" lang="bs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Selekting || Korpa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.png">

    <!-- All CSS Files -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Nivo-slider css -->
    <link rel="stylesheet" href="lib/css/nivo-slider.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Template color css -->
    <link href="css/color/color-core.css" data-style="styles" rel="stylesheet">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- START HEADER AREA -->
        <header class="header-area header-wrapper">
            <!-- header-top-bar -->
            <div class="header-top-bar plr-185">
                <div class="container-fluid">
                    <div class="row">
                        <?php include "topbar.php"; ?>
                    </div>
                </div>
            </div>
            <!-- header-middle-area -->
            <div id="sticky-header" class="header-middle-area plr-185">
                <div class="container-fluid">
                    <div class="full-width-mega-dropdown">
                        <div class="row">
                            <!-- logo -->
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="img/logo/logo.png" alt="main logo">
                                    </a>
                                </div>
                            </div>
                            <!-- primary-menu -->
                            <div class="col-md-8 hidden-sm hidden-xs">
                                <nav id="primary-menu">
                                    <ul class="main-menu text-center">
                                        <?php include "navigation.php"; ?>
                                    </ul>
                                </nav>
                            </div>
                            <!-- header-search & total-cart -->
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="search-top-cart  f-right">
                                    <?php include "searchcartbuttons.php"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER AREA -->

        <!-- START MOBILE MENU AREA -->
        <div class="mobile-menu-area hidden-lg hidden-md">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                                <ul>
                                    <?php include "navigation.php"; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MOBILE MENU AREA -->

        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Korpa</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.php">Početna</a></li>
                                    <li>Korpa</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <ul class="cart-tab">
                                <li id="step1">
                                    <a class="active">
                                        <span>01</span>
                                        Korpa
                                    </a>
                                </li>
                                <li id="step2">
                                    <a class="active">
                                        <span>02</span>
                                        Blagajna
                                    </a>
                                </li>
                                <li id="step3">
                                    <a>
                                        <span>03</span>
                                        Završetak
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <!-- Tab panes -->
                            <div class="tab-content">                                
                                <!-- checkout start -->
                                <div class="tab-pane active" id="checkout">
                                    <div class="checkout-content box-shadow p-30">
                                        <form method="POST" id="form" action="order-send.php">
                                            <div class="row">                                                
                                                <!-- billing details -->
                                                <div class="col-md-6">
                                                    <div class="billing-details pr-10">
                                                        <h6 class="widget-title border-left mb-20">vaše informacije</h6>
                                                        <input type="text" value="<?php echo $ime; ?>" placeholder="Ime" name="ime">
                                                        <input type="text" value="<?php echo $prezime; ?>" placeholder="Prezime" name="prezime">
                                                        <input type="text" value="<?php echo $email; ?>" placeholder="Email adresa..." name="email">
                                                        <input type="text" value="<?php echo $telefon; ?>" placeholder="Telefon" name="telefon">
                                                        <input type="text" value="<?php echo $kompanija; ?>" placeholder="Firma" readonly name="kompanija">
                                                        <input type="text" value="<?php echo $drzava; ?>" placeholder="Država" name="drzava">
                                                        <input type="text" value="<?php echo $grad; ?>" placeholder="Grad" name="grad">
                                                        <input type="text" value="<?php echo $postanski; ?>" placeholder="Poštanski broj" name="postanski">
                                                        <textarea class="custom-textarea" placeholder="Adresa" name="adresa"><?php echo $adresa; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    
                                                    <!-- payment-method -->
                                                    <div class="payment-method">
                                                        <h6 class="widget-title border-left mb-20">narudžba</h6>
                                                        <div id="accordion">
                                                            <div class="panel">
                                                                <h4 class="payment-title box-shadow">
                                                                    <a style="text-transform: none;">
                                                                    Cijene na stranici su VPC sa automatski uračunatim popustom
                                                                    </a>
                                                                </h4>
                                                                <div id="bank-transfer" class="panel-collapse collapse in" >
                                                                    <div class="payment-details p-30">
                                                                        <table>
                                                                            <tr>
                                                                                <td class="td-title-1">Total bez PDV-a</td>
                                                                                <td class="td-title-2"><?php echo round($_SESSION['total'], 2); ?> KM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="td-title-1">PDV</td>
                                                                                <td class="td-title-2"><?php echo round(($_SESSION['total'] * 17)/100, 2); ?> KM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="order-total">Total sa PDV-om</td>
                                                                                <td class="order-total-price"><?php echo round(($_SESSION['total'] * 1.17), 2); ?> KM</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- payment-method end -->
                                                    <button class="submit-btn-1 mt-30 btn-hover-1 pull-right" type="submit">naručite</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- checkout end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

        </section>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        <footer id="footer" class="footer-area">
            <?php include "footer.php"; ?>
        </footer>
        <!-- END FOOTER AREA -->  
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jquery.nivo.slider js -->
    <script src="lib/js/jquery.nivo.slider.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>

</body>

</html>