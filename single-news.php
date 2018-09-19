<?php
session_start();
include "dbkon.php";
include "funkcije.php";

if(!isset($_SESSION['products'])){
  $_SESSION['products'] = array();
  $_SESSION['quantities'] = array();
}

$id = $conn->real_escape_string($_REQUEST['id']);

$objekti = Select("novosti", "WHERE id='$id'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
    $naslov = $objekat['naslov'];    
    $detaljno = $objekat['detaljno'];
    $metaopis = strip_tags($detaljno);
    $datum = date('d.m.Y', strtotime($objekat['postavljeno']));
}
?>
<!doctype html>
<html class="no-js" lang="bs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Selekting || <?php echo $naslov; ?></title>
    <meta name="description" content="<?php echo $metaopis; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?php echo $metaopis; ?>">
    <meta name="keywords" content="">
    <meta name="author" content="ID Solutions">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="http://selekting.com">
    <meta property="og:locale" content="bs_BA">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $naslov; ?> - Selekting">
    <meta property="og:description" content="<?php echo $metaopis; ?>">
    <meta property="og:url" content="http://selekting.com/single-news.php?id=<?php echo $id; ?>">
    <meta property="og:site_name" content="<?php echo $naslov; ?> - Selekting">
    <meta property="article:publisher" content="https://www.facebook.com/IDSBiH/">
    <meta property="og:image" content="http://selekting.com/Novosti/<?php echo $id; ?>/slika.png">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="http://selekting.com">
    <meta name="twitter:url" content="http://selekting.com/single-news.php?id=<?php echo $id; ?>">
    <meta name="twitter:title" content="<?php echo $naslov; ?> - Selekting">
    <meta name="twitter:description" content="<?php echo $metaopis; ?>">
    <meta name="twitter:image" content="http://selekting.com/Novosti/<?php echo $id; ?>/slika.png">

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

    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a859e80ba136200132f4b4f&product=inline-share-buttons"></script>
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
                                <h1 class="breadcrumbs-title"><?php echo $naslov; ?></h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.php">Početna</a></li>
                                    <li><?php echo $naslov; ?></li>
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

            <!-- BLOG SECTION START -->
            <div class="blog-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="blog-details-area">
                                <!-- blog-details-photo -->
                                <div class="blog-details-photo bg-img-1 p-20 mb-30">
                                    <img src="Novosti/<?php echo $id; ?>/slika.png" alt="">
                                    <div class="today-date bg-img-1" style="width: 30%;">                                        
                                        <span class="meta-date"><?php echo $datum; ?></span>
                                        <span class="meta-month">Aktuelno</span>
                                    </div>
                                </div>
                                <!-- blog-details-title -->
                                <h3 class="blog-details-title mb-30"><?php echo $naslov; ?></h3>
                                <!-- blog-description -->
                                <div class="blog-description mb-60">
                                    <?php echo $detaljno; ?> 
                                </div>
                                <!-- blog-share-tags -->
                                <div class="blog-share-tags box-shadow clearfix mb-60">
                                    <div class="blog-share f-left">
                                        <p class="share-tags-title f-left">podijeli</p>
                                        <div class="sharethis-inline-share-buttons"></div>
                                        <!-- <ul class="footer-social f-left">
                                            <li>
                                                <a class="facebook" href="" title="Facebook"><i class="zmdi zmdi-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a class="google-plus" href="" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a>
                                            </li>
                                            <li>
                                                <a class="twitter" href="" title="Twitter"><i class="zmdi zmdi-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a class="rss" href="" title="RSS"><i class="zmdi zmdi-rss"></i></a>
                                            </li>
                                        </ul> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BLOG SECTION END -->             

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

</body>

</html>