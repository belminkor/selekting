<?php
session_start();
include "dbkon.php";
include "funkcije.php";

if(!isset($_SESSION['products'])){
  $_SESSION['products'] = array();
  $_SESSION['quantities'] = array();
}

$id = $conn->real_escape_string($_REQUEST['id']);

$objekti = Select("proizvodi", "WHERE id='$id'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
    $sifra = $objekat['sifra'];
    $naziv = $objekat['naziv'];
    $brend = $objekat['brend'];
    $mcijena = $objekat['mcijena'];
    $vcijena = $objekat['vcijena'];
    $kategorija = $objekat['kategorija'];
    $podkategorija = $objekat['podkategorija'];
    $istaknuto = $objekat['istaknuto'];
    $najprodavanije = $objekat['najprodavanije'];
    $vidljiv = $objekat['vidljiv'];
    $opis = $objekat['opis'];
    $metaopis = strip_tags($opis);
    $schneiderslika = $objekat['schneiderslika'];
    $nazivspecifikacije = explode("|", $objekat['nazivspecifikacije']);
    $tekstspecifikacije = explode("|", $objekat['tekstspecifikacije']);

    if($objekat['kolicina']>0){
        $stanje = '<i class="fa fa-check"></i>';
    }else{
        $stanje = '<i class="fa fa-close"></i>';
    }

    if($objekat['kolicina']>0 || isset($_SESSION['klijent'])){
        $addtocart = '<a onclick="mainAddToCart();" title="Add to cart" tabindex="0"><i class="zmdi zmdi-shopping-cart-plus"></i></a>';
    }else{
        $addtocart = '<a onclick="alert(\'Proizvod nije na stanju.\');" title="Add to cart" tabindex="0"><i class="zmdi zmdi-shopping-cart-plus"></i></a>';
    }

}

$cijena = Cijena($mcijena, $vcijena);

$slike = glob("Proizvodi/".$id."/*", GLOB_BRACE);

if($schneiderslika!=""){
    $slika = $schneiderslika;
}else{
    $slika = $slike[0];
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Selekting || <?php echo $naziv; ?></title>
    <meta name="description" content="<?php echo $metaopis; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?php echo $metaopis; ?>">
    <meta name="keywords" content="">
    <meta name="author" content="ID Solutions">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="http://selekting.com">
    <meta property="og:locale" content="bs_BA">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $naziv; ?> - Selekting">
    <meta property="og:description" content="<?php echo $metaopis; ?>">
    <meta property="og:url" content="http://selekting.com/single-product.php?id=<?php echo $id; ?>">
    <meta property="og:site_name" content="<?php echo $naziv; ?> - Selekting">
    <meta property="article:publisher" content="https://www.facebook.com/IDSBiH/">
    <meta property="og:image" content="http://selekting.com/<?php echo $slika; ?>">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="http://selekting.com">
    <meta name="twitter:url" content="http://selekting.com/single-product.php?id=<?php echo $id; ?>">
    <meta name="twitter:title" content="<?php echo $naziv; ?> - Selekting">
    <meta name="twitter:description" content="<?php echo $metaopis; ?>">
    <meta name="twitter:image" content="http://selekting.com/<?php echo $slika; ?>">

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

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-3.1.1.min.js"></script>
    
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
                                <h1 class="breadcrumbs-title"><?php echo $naziv; ?></h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.php">Početna</a></li>
                                    <li><?php echo $naziv; ?></li>
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
                        <div class="col-md-12 col-xs-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mb-80">
                                <div class="row">
                                    <!-- imgs-zoom-area start -->
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div class="imgs-zoom-area">                                            
                                            <img id="zoom_03" src="<?php echo $slika; ?>" data-zoom-image="<?php echo $slika; ?>" alt="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div id="gallery_01" class="carousel-btn slick-arrow-3 mt-30">
                                                        <?php
                                                            foreach ($slike as $slika) {
                                                                echo '<div class="p-c">
                                                                        <a href="#" data-image="'.$slika.'" data-zoom-image="'.$slika.'">
                                                                            <img class="zoom_03" src="'.$slika.'" alt="">
                                                                        </a>
                                                                      </div>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- imgs-zoom-area end -->
                                    <!-- single-product-info start -->
                                    <div class="col-md-7 col-sm-7 col-xs-12"> 
                                        <div class="single-product-info">
                                            <h3 class="text-black-1"><?php echo $naziv; ?></h3>
                                            <h6 class="brand-name-2"><?php echo $brend; ?></h6>
                                            <!-- hr -->
                                            <hr>
                                            <!-- single-product-tab -->
                                            <div class="single-product-tab">
                                                <ul class="reviews-tab mb-20">
                                                    <li  class="active"><a href="#description" data-toggle="tab">opis</a></li>
                                                    <li ><a href="#spec" data-toggle="tab">tehničke specifikacije</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="description">
                                                        <p><?php echo $opis; ?></p>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="spec">
                                                        <table class="table table-striped table-borderless">
                                                            <tbody class="no-border-x" id="tabela-specifikacija">
                                                              <?php                                            
                                                                for ($i=0; $i < count($nazivspecifikacije); $i++) { 
                                                                  echo '<tr>
                                                                          <td>'.$nazivspecifikacije[$i].'</td>
                                                                          <td>'.$tekstspecifikacije[$i].'</td>
                                                                        </tr>';  
                                                                }
                                                              ?>                          
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  hr -->
                                            <hr>
                                            <!-- single-pro-color-rating -->
                                            <div class="single-pro-color-rating clearfix">                                                
                                                <div class="sin-pro-color f-left">
                                                    <p class="color-title f-left" style="width: 100px;">Cijena: &nbsp;<?php echo $cijena; ?> KM</p>
                                                </div>
                                                <div class="sin-pro-color f-right">
                                                    <p class="color-title f-right" style="width: 100px;">Na stanju: &nbsp;<?php echo $stanje; ?></p>
                                                </div>
                                            </div>
                                            <!-- hr -->
                                            <hr>
                                            <!-- plus-minus-pro-action -->
                                            <div class="plus-minus-pro-action">
                                                <div class="sin-plus-minus f-left clearfix">
                                                    <p class="color-title f-left">Qty</p>
                                                    <div class="cart-plus-minus f-left">
                                                        <input type="text" value="1" id="Qty" class="cart-plus-minus-box">
                                                        <input type="hidden" id="productid"  value="<?php echo $id; ?>">
                                                    </div>   
                                                </div>
                                                <div class="sin-pro-action f-right">
                                                    <ul class="action-button">                                                        
                                                        <li>
                                                            <?php echo $addtocart; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    <!-- single-product-info end -->
                                </div>
                            </div>
                            <!-- single-product-area end -->
                            <div class="related-product-area">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-title text-left mb-40">
                                            <h2 class="uppercase">slični proizvodi</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="active-related-product">
                                        <?php
                                            $objekti = Select("proizvodi", "WHERE kategorija='$kategorija' AND id!='$id'", "ORDER BY postavljeno DESC", "LIMIT 3");

                                            foreach ($objekti as $objekat) {
                                                $slike = glob("Proizvodi/".$id."/*", GLOB_BRACE);

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
                                                                <h3 class="pro-price">'.$cijena.' KM</h3>
                                                                '.$stanje.'
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
                                            if(empty($objekti)){
                                                echo "<script>$('.related-product-area').hide();</script>";
                                            }
                                        ?>
                                    </div>   
                                </div>
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
                                        <img alt="" src="img/product/quickview.jpg">
                                    </div>
                                </div><!-- .product-images -->
                                
                                <div class="product-info">
                                    <h1>Aenean eu tristique</h1>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            <span class="new-price">£160.00</span>
                                            <span class="old-price">£190.00</span>
                                        </div>
                                    </div>
                                    <a href="single-product-left-sidebar.html" class="see-all">See all features</a>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="numbers-row">
                                                <input type="number" id="french-hens" value="3">
                                            </div>
                                            <button class="single_add_to_cart_button" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="quick-desc">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.
                                    </div>
                                    <div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
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
                                                <li>
                                                    <a class="rss" href="#" target="_blank" title="RSS">
                                                        <i class="zmdi zmdi-rss"></i>
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

    
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jquery.nivo.slider js -->
    <script src="lib/js/jquery.nivo.slider.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>

    <script type="text/javascript">
        function mainAddToCart(){
            var productid = $("#productid").val();
            var quantity = $("#Qty").val();
            $.ajax({
                url: 'addtocart.php',
                type: 'POST',
                data: {'productid': productid,'quantity': quantity},
                success: function(data, status) {
                  if(data['response'] == "ok") {
                    alert('Dodano u korpu!');
                    $(".cart-quantity").text(parseInt($(".cart-quantity").text())+quantity);
                  }else{
                    alert('Greška! Molimo pokušajte kasnije!');
                  }
                }
              });
        }
    </script>
</body>

</html>