<?php
session_start();
include "dbkon.php";
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
                                    <a>
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
                                <!-- shopping-cart start -->
                                <div class="tab-pane active" id="shopping-cart">
                                    <div class="shopping-cart-content">
                                        <form action="#">
                                            <div class="table-content table-responsive mb-50">
                                                <table class="text-center">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">proizvod</th>
                                                            <th class="product-price">cijena</th>
                                                            <th class="product-quantity">količina</th>
                                                            <th class="product-subtotal">total</th>
                                                            <th class="product-remove">briši</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="cart-items">
                                                        <?php 
                                                        $products = $_SESSION['products'];
                                                        $quantities = $_SESSION['quantities'];
                                                        $total = 0;

                                                        for ($i=0; $i < count($products) ; $i++) { 
                                                            $product = $products[$i];
                                                            $objekti = Select("proizvodi", "WHERE id='$product'", "", "");

                                                            foreach ($objekti as $objekat) {
                                                                $slike = glob("Proizvodi/".$objekat['id']."/*", GLOB_BRACE);    

                                                                if($objekat['schneiderslika']!=""){
                                                                    $slika = $objekat['schneiderslika'];
                                                                }else{
                                                                    $slika = $slike[0];
                                                                }

                                                                $cijena = Cijena($objekat['mcijena'], $objekat['vcijena']);                                    
                                                                echo '<tr>
                                                                        <td class="product-thumbnail">
                                                                            <div class="pro-thumbnail-img">
                                                                                <img src="'.$slika.'" alt="">
                                                                            </div>
                                                                            <div class="pro-thumbnail-info text-left">
                                                                                <h6 class="product-title-2">
                                                                                    <a href="single-product.php?id='.$objekat['id'].'">'.$objekat['naziv'].'</a>
                                                                                </h6>
                                                                                <p>Brend: '.$objekat['brend'].'</p>
                                                                            </div>
                                                                        </td>
                                                                        <td class="product-price">'.$cijena.' KM</td>
                                                                        <td class="product-quantity">'.$quantities[$i].'</td>
                                                                        <td class="product-subtotal">'.number_format((float)$cijena*$quantities[$i], 2, '.', '').' KM</td>
                                                                        <td class="product-remove">
                                                                            <a href="cart.php?brisi='.$products[$i].'"><i class="zmdi zmdi-close"></i></a>
                                                                        </td>
                                                                    </tr>';
                                                                $total += $cijena;
                                                            }
                                                        }

                                                        if(isset($_REQUEST['brisi'])){
                                                            $index = array_search($_REQUEST['brisi'], $_SESSION['products']);
                                                            unset($_SESSION['products'][$index]);
                                                            $_SESSION["products"] = array_values($_SESSION["products"]);
                                                            unset($_SESSION['quantities'][$index]);
                                                            $_SESSION["quantities"] = array_values($_SESSION["quantities"]);
                                                            echo "<script>window.location='cart.php';</script>";
                                                        }

                                                        $_SESSION['total'] = $total;

                                                        ?>                                                        
                                                    </tbody>
                                                </table>
                                                <?php
                                                if(count($objekti) == 0){
                                                    echo '<div class="col-md-12 p-0 text-center">
                                                            <div class="culculate-shipping box-shadow p-30">
                                                                <h6 class="widget-title mb-20">Nema dodanih proizvoda</h6>
                                                                <p>Pregledajte <a href="products.php">proizvode</a> da bi ih dodali u korpu</p>                                                            
                                                            </div>
                                                        </div>';
                                                }elseif(isset($_SESSION['klijent'])){
                                                    echo '<a href="order.php"><button class="submit-btn-1 mt-30 btn-hover-1 pull-right" type="button">dalje</button></a>';
                                                }else{
                                                    echo '<a href="payment.php"><button class="submit-btn-1 mt-30 btn-hover-1 pull-right" type="button">dalje</button></a>';
                                                }                   
                                                ?> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- shopping-cart end -->
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