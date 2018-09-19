<?php
session_start();
include "funkcije.php";

if(!isset($_SESSION['products'])){
  $_SESSION['products'] = array();
  $_SESSION['quantities'] = array();
}
?>
<!doctype html>
<html class="no-js" lang="bs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Selekting</title>
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

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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

        <!-- START SLIDER AREA -->
        <div class="slider-area  plr-185  mb-80">
            <div class="container-fluid">
                <div class="slider-content">
                    <div class="row">
                        <div class="active-slider-1 slick-arrow-1 slick-dots-1">
                            <?php
                                $objekti = Select("novosti", "WHERE istaknuto='on'", "ORDER BY postavljeno DESC");

                                foreach ($objekti as $objekat) {
                                    $slike = glob("Novosti/".$objekat['id']."/*", GLOB_BRACE);
                                    echo '<div class="col-md-12">
                                            <div class="layer-1">
                                                <div class="slider-img">
                                                    <img src="'.$slike[0].'" alt="">
                                                </div>
                                                <div class="slider-info gray-bg">
                                                    <div class="slider-info-inner">
                                                        <h1 class="slider-title-1 text-uppercase text-black-1">'.$objekat['naslov'].'</h1>
                                                        <div class="slider-brief text-black-2">
                                                            <p>'.truncate(strip_tags($objekat['detaljno']), 252).'</p>
                                                        </div>
                                                        <a href="single-news.php?id='.$objekat['id'].'" class="button extra-small button-black">
                                                            <span class="text-uppercase">Detaljno</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SLIDER AREA -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">

            <!-- BY BRAND SECTION START-->
            <div class="by-brand-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-left mb-40">
                                <h2 class="uppercase">Partneri</h2>
                                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h6>
                            </div>
                        </div>
                    </div>
                    <div class="by-brand-product">
                        <div class="row active-by-brand slick-arrow-2">
                            <!-- single-brand-product start -->
                            <div class="col-xs-12">
                                <div class="single-brand-product">
                                    <a href="#"><img src="img/product/5.jpg" alt=""></a>
                                </div>
                            </div>
                            <!-- single-brand-product end -->
                            <!-- single-brand-product start -->
                            <div class="col-xs-12">
                                <div class="single-brand-product">
                                    <a href="#"><img src="img/product/6.jpg" alt=""></a>
                                </div>
                            </div>
                            <!-- single-brand-product end -->
                            <!-- single-brand-product start -->
                            <div class="col-xs-12">
                                <div class="single-brand-product">
                                    <a href="#"><img src="img/product/7.jpg" alt=""></a>
                                </div>
                            </div>
                            <!-- single-brand-product end -->
                            <!-- single-brand-product start -->
                            <div class="col-xs-12">
                                <div class="single-brand-product">
                                    <a href="#"><img src="img/product/8.jpg" alt=""></a>
                                </div>
                            </div>
                            <!-- single-brand-product end -->
                            <!-- single-brand-product start -->
                            <div class="col-xs-12">
                                <div class="single-brand-product">
                                    <a href="#"><img src="img/product/9.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="single-brand-product">
                                    <a href="#"><img src="img/product/10.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="single-brand-product">
                                    <a href="#"><img src="img/product/11.jpg" alt=""></a>
                                </div>
                            </div>
                            <!-- single-brand-product end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- BY BRAND SECTION END -->

            <!-- FEATURED PRODUCT SECTION START -->
            <div class="featured-product-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-left mb-40">
                                <h2 class="uppercase">Najprodavaniji proizvodi</h2>
                                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h6>
                            </div>
                        </div>
                    </div>
                    <div class="featured-product">
                        <div class="row active-featured-product slick-arrow-2">
                            <?php
                                $objekti = Select("proizvodi", "WHERE vidljiv='on' AND najprodavanije='on'", "ORDER BY postavljeno DESC");

                                foreach ($objekti as $objekat) {
                                    $slike = glob("Proizvodi/".$objekat['id']."/*", GLOB_BRACE);

                                    if($objekat['schneiderslika']!=""){
                                        $slika = $objekat['schneiderslika'];
                                    }else{
                                        $slika = $slike[0];
                                    }

                                    $cijena = Cijena($objekat['mcijena'], $objekat['vcijena']);

                                    if($objekat['kolicina']>0){
                                        $stanje = '<a class="jeste-na-stanju">Na stanju: <i class="fa fa-check"></i></a>';
                                    }else{
                                        $stanje = '<a class="nije-na-stanju">Na stanju: <i class="fa fa-close"></i></a>';
                                    }

                                    if($objekat['kolicina']>0 || isset($_SESSION['klijent'])){
                                        $addtocart = '<a onclick="AddToCart('.$objekat['id'].')" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>';
                                    }else{
                                        $addtocart = '<a onclick="alert(\'Proizvod nije na stanju.\');" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>';
                                    }

                                    echo '<div class="col-xs-12">
                                            <div class="product-item">
                                                <div class="product-img">
                                                    <a href="single-product.php?id='.$objekat['id'].'">
                                                        <img src="'.$slika.'" alt=""/>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-title">
                                                        <a href="single-product.php?id='.$objekat['id'].'">'.$objekat['naziv'].'</a>
                                                    </h6>
                                                    <div class="pro-rating">
                                                        <a class="jeste-na-stanju">Brend: '.$objekat['brend'].'</a><br><br>
                                                        '.$stanje.'
                                                    </div>
                                                    <h3 class="pro-price">'.$cijena.' KM</h3>
                                                    <ul class="action-button">
                                                        <li>
                                                            <a href="single-product.php?id='.$objekat['id'].'"><i class="zmdi zmdi-zoom-in"></i></a>
                                                        </li>
                                                        <li>
                                                            '.$addtocart.'
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            ?>
                        </div>
                    </div>          
                </div>            
            </div>
            <!-- FEATURED PRODUCT SECTION END -->


            <!-- PRODUCT TAB SECTION START -->
            <div class="product-tab-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="section-title text-left mb-40">
                                <h2 class="uppercase">proizvodi</h2>
                                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h6>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- popular-product start -->
                            <div class="tab-pane active" id="popular-product">
                                <div class="row">
                                    <?php
                                        $objekti = Select("proizvodi", "WHERE vidljiv='on'", "ORDER BY postavljeno DESC", "LIMIT 16");

                                        foreach ($objekti as $objekat) {
                                            $slike = glob("Proizvodi/".$objekat['id']."/*", GLOB_BRACE);
                                            
                                            if($objekat['schneiderslika']!=""){
                                                $slika = $objekat['schneiderslika'];
                                            }else{
                                                $slika = $slike[0];
                                            }

                                            $cijena = Cijena($objekat['mcijena'], $objekat['vcijena']);

                                            if($objekat['kolicina']>0){
                                                $stanje = '<a class="jeste-na-stanju">Na stanju: <i class="fa fa-check"></i></a>';
                                            }else{
                                                $stanje = '<a class="nije-na-stanju">Na stanju: <i class="fa fa-close"></i></a>';
                                            }

                                            if($objekat['kolicina']>0 || isset($_SESSION['klijent'])){
                                                $addtocart = '<a onclick="AddToCart('.$objekat['id'].')" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>';
                                            }else{
                                                $addtocart = '<a onclick="alert(\'Proizvod nije na stanju.\');" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>';
                                            }

                                            echo '<div class="col-md-3 col-sm-4 col-xs-12">
                                                    <div class="product-item">
                                                        <div class="product-img">
                                                            <a href="single-product.php?id='.$objekat['id'].'">
                                                                <img src="'.$slika.'" alt=""/>
                                                            </a>
                                                        </div>
                                                        <div class="product-info">
                                                            <h6 class="product-title">
                                                                <a href="single-product.php?id='.$objekat['id'].'">'.$objekat['naziv'].'</a>
                                                            </h6>
                                                            <div class="pro-rating">
                                                                <a class="jeste-na-stanju">Brend: '.$objekat['brend'].'</a><br><br>
                                                                '.$stanje.'
                                                            </div>
                                                            <h3 class="pro-price">'.$cijena.' KM</h3>
                                                            <ul class="action-button">
                                                                <li>
                                                                    <a href="single-product.php?id='.$objekat['id'].'" title="Quickview"><i class="zmdi zmdi-zoom-in"></i></a>
                                                                </li>
                                                                <li>
                                                                    '.$addtocart.'
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>';
                                        }
                                    ?>
                                    
                            <!-- popular-product end -->
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRODUCT TAB SECTION END -->

            <!-- BLOG SECTION START -->
            <div class="blog-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-left mb-40">
                                <h2 class="uppercase">Aktuelno</h2>
                                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h6>
                            </div>
                        </div>
                    </div>
                    <div class="blog">
                        <div class="row active-blog">
                            <?php
                            $objekti = Select("novosti", "", "ORDER BY postavljeno DESC", "");

                            foreach ($objekti as $objekat) {
                                echo '<div class="col-xs-12">
                                        <div class="blog-item">
                                            <img src="Novosti/'.$objekat['id'].'/slika.png" alt="">
                                            <div class="blog-desc">
                                                <h5 class="blog-title"><a href="single-news.php?id='.$objekat['id'].'">'.$objekat['naslov'].'</a></h5>
                                                <p>'.truncate(strip_tags($objekat['detaljno'])).'</p>
                                                <div class="read-more">
                                                    <a href="single-news.php?id='.$objekat['id'].'">Pročitajte više</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            function truncate($text, $chars = 178) {
                                $orgtext = $text;
                                $text = $text." ";
                                $text = substr($text,0,$chars);
                                $text = substr($text,0,strrpos($text,' '));
                                if(strlen($orgtext)>$chars){
                                  $text = $text."...";
                                }
                                return $text;
                              }
                            ?>                            
                        </div>
                    </div>
                    <div class="row text-center">
                        <a href="news.php"><button class="submit-btn-1 mt-20 btn-hover-1" type="button">sve aktuelnosti</button></a>
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

        <!-- START QUICKVIEW PRODUCT -->
        <div id="quickview-wrapper">
            <!-- Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-product clearfix">
                                <div class="product-images">
                                    <div class="main-image images">
                                        <img alt="" src="img/proizvodi/1.jpg">
                                    </div>
                                </div><!-- .product-images -->
                                
                                <div class="product-info">
                                    <h1>Ethernet PowerLogic EGX300</h1>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            <span class="new-price">57.00 KM</span>
                                        </div>
                                    </div>
                                    <a href="#" class="see-all">Vidi detaljno</a>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="numbers-row">
                                                <input type="number" id="french-hens" value="1">
                                            </div>
                                            <button class="single_add_to_cart_button" type="submit">Dodaj u korpu</button>
                                        </form>
                                    </div>
                                    <div class="quick-desc">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.
                                    </div>
                                    <div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Podijelite proizvod na</h3>
                                            <ul class="social-icons clearfix">
                                                <li>
                                                    <a class="facebook" href="#" target="_blank" title="Facebook">
                                                        <i class="zmdi zmdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="google-plus" href="#" target="_blank" title="Google +">
                                                        <i class="zmdi zmdi-google-plus"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="twitter" href="#" target="_blank" title="Twitter">
                                                        <i class="zmdi zmdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="pinterest" href="#" target="_blank" title="Pinterest">
                                                        <i class="zmdi zmdi-pinterest"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .product-info -->
                            </div><!-- .modal-product -->
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div>
            <!-- END Modal -->
        </div>
        <!-- END QUICKVIEW PRODUCT -->
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