<?php
session_start();
include "dbkon.php";
include "funkcije.php";

if(!isset($_SESSION['products'])){
  $_SESSION['products'] = array();
  $_SESSION['quantities'] = array();
}

$page = $_REQUEST['page'] ?: 1;

if(isset($_REQUEST['cijena'])){
    $_SESSION['cijena'] = $_REQUEST['cijena'];    
}
if(isset($_REQUEST['pretraga'])){
    $_SESSION['pretraga'] = $_REQUEST['pretraga'];
}
if(isset($_REQUEST['podkategorija'])){
    $_SESSION['podkategorija'] = $_REQUEST['podkategorija'];
}
if(isset($_REQUEST['cijena']) || isset($_REQUEST['pretraga']) || isset($_REQUEST['podkategorija'])){
    echo "<script>window.location='products.php';</script>";
}

if(isset($_REQUEST['session'])){
    $session = $_REQUEST['session'];

    $_SESSION["$session"] = "";

    header("Location: products.php");
}

$klijentid = $_SESSION['klijend'];
$objekti = Select("klijenti", "WHERE klijent='$klijentid'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
    $popust = $objekat['popust'];
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Proizvodi || Selekting</title>
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
                                <h1 class="breadcrumbs-title">Proizvodi</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.php">Početna</a></li>
                                    <li>Proizvodi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

        <!-- Start page content -->
        <div id="page-content" class="page-wrapper">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-push-3 col-xs-12">
                            <div class="shop-content">
                                <!-- shop-option start -->
                                <div class="shop-option box-shadow mb-30 clearfix">
                                    <div class="showing f-right text-right">
                                        <span>Broj rezultata : <a id="brojrezultata">0</a></span>
                                    </div>                                   
                                </div>
                                <!-- shop-option end -->
                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    
                                    <!-- list-view -->
                                    <div role="tabpanel" class="tab-pane active" id="list-view">
                                        <div class="row">
                                            <?php
                                                $limitod = ($page-1)*10;
                                                $where = "WHERE vidljiv='on'";

                                                if(isset($_SESSION['cijena']) && $_SESSION['cijena']!=""){
                                                    $cijena = $conn->real_escape_string($_SESSION['cijena']);
                                                    $cijena = array_filter(explode("-", $cijena));
                                                    $od = trim($cijena[0]);
                                                    $do = trim($cijena[1]);

                                                    if(isset($_SESSION['klijent'])){                        
                                                        $where .= " AND (vcijena>$od AND vcijena<$do)";
                                                    }else{
                                                        $where .= " AND (mcijena>$od AND mcijena <$do)";
                                                    }                                                    
                                                }
                                                if(isset($_SESSION['pretraga']) && $_SESSION['pretraga']!=""){
                                                    $pretraga = $conn->real_escape_string($_SESSION['pretraga']);
                                                    $pretraga = strtolower($pretraga);

                                                    $where .= " AND (LOWER(naziv) LIKE '%$pretraga%' OR LOWER(opis) LIKE '%$pretraga%' OR LOWER(tekstspecifikacije) LIKE '%$pretraga%' OR LOWER(sifra) LIKE '%$pretraga%')";
                                                }

                                                $objekti = Select("proizvodi", $where, "ORDER BY postavljeno DESC", "LIMIT $limitod, 10");

                                                foreach ($objekti as $objekat) {
                                                    $slike = glob("Proizvodi/".$objekat['id']."/*", GLOB_BRACE);

                                                    if($objekat['schneiderslika']!=""){
                                                        $slika = $objekat['schneiderslika'];
                                                    }else{
                                                        $slika = $slike[0];
                                                    }

                                                    $fcijena = Cijena($objekat['mcijena'], $objekat['vcijena']);

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

                                                    echo '<div class="col-md-12">
                                                            <div class="shop-list product-item">
                                                                <div class="product-img">
                                                                    <a href="single-product.php?id='.$objekat['id'].'">
                                                                        <img src="'.$slika.'" alt=""/>
                                                                    </a>
                                                                </div>
                                                                <div class="product-info">
                                                                    <div class="clearfix">
                                                                        <h6 class="product-title f-left">
                                                                            <a href="single-product.php?id='.$objekat['id'].'">'.$objekat['naziv'].'</a>
                                                                        </h6>
                                                                    </div>
                                                                    <h6 class="brand-name mb-30">'.$objekat['brend'].'</h6>
                                                                    <h3 class="pro-price">'.$fcijena.' KM</h3>
                                                                    '.$stanje.'
                                                                    <p>'.truncate(strip_tags($objekat['opis'])).'</p>
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
                                                function truncate($text, $chars = 187) {
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
                                    <?php
                                        if(empty($objekti)){
                                            echo '<div class="shop-option box-shadow mb-30 clearfix">
                                                    <!-- showing -->
                                                    <div class="col-md-12 text-center">
                                                        <span>Nema rezultata pretrage</span>
                                                    </div>                                   
                                                </div>';
                                        }
                                    ?>
                                </div>
                                <!-- Tab Content end -->
                                <!-- shop-pagination start -->
                                <ul class="shop-pagination box-shadow text-center ptblr-10-30">
                                    <li><a class="prosli"><i class="zmdi zmdi-chevron-left"></i></a></li>
                                    <?php
                                        if($page==""){
                                            $page=1;
                                        }                                        

                                        $total = SelectTotal("proizvodi", $where, "ORDER BY postavljeno DESC");

                                        $number = ceil($total/10);
                                        if($number==0){ $number=1; }

                                        for ($i=1; $i <=$number ; $i++) {
                                            if($page==$i){
                                                echo '<li class="active lijevi"><span>'.$i.'</span></li>';
                                            }else{
                                                echo '<li class="lijevi"><a href="products.php?page='.$i.'">'.$i.'</a></li>';
                                            }
                                        }
                                    ?>
                                    <li><a class="iduci"><i class="zmdi zmdi-chevron-right"></i></a></li>
                                </ul>
                                <!-- shop-pagination end -->
                                <?php echo "<script>$('#brojrezultata').text('".$total."')</script>"; ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-pull-9 col-xs-12">
                            <!-- widget-search -->
                            <aside class="widget-search mb-30">
                                <form method="POST">
                                    <input type="text" name="pretraga" placeholder="Pretraga..." value="<?php echo $_SESSION['pretraga']; ?>">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </aside>
                            <!-- widget-filters -->
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Aktivni filteri</h6>
                                <div id="cat-treeview" class="product-cat">
                                    <ul>
                                        <?php
                                            if(isset($_SESSION['cijena']) && $_SESSION['cijena']!=""){
                                                echo '<li><span class="filter">'.$_SESSION['cijena'].' KM<span data-session="cijena" class="closex">x</span></span></li>';
                                            }
                                            if(isset($_SESSION['pretraga']) && $_SESSION['pretraga']!=""){
                                                echo '<li><span class="filter">'.$_SESSION['pretraga'].' <span data-session="pretraga" class="closex">x</span></span></li>';
                                            }
                                            if(isset($_SESSION['podkategorija']) && $_SESSION['podkategorija']!=""){
                                                $podkategorija = $conn->real_escape_string($_SESSION['podkategorija']);
                                                $objekti = Select("podkategorije", "WHERE id='$podkategorija'", "ORDER BY postavljeno DESC", "LIMIT 1");

                                                foreach ($objekti as $objekat) {
                                                    $podkategorija = $objekat['naziv'];
                                                }
                                                echo '<li><span class="filter">'.$podkategorija.' <span data-session="podkategorija" class="closex">x</span></span></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </aside>
                            <!-- widget-categories -->
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Kategorije</h6>
                                <div id="cat-treeview" class="product-cat">
                                    <ul>
                                        <?php
                                            $kategorije = Select("kategorije", "", "ORDER BY postavljeno DESC");

                                            if(isset($_SESSION['pretraga']) && $_SESSION['pretraga']!=""){
                                                $pretraga = $_SESSION['pretraga'];
                                            }else{
                                                $pretraga = "";
                                            }

                                            if(isset($_SESSION['cijena']) && $_SESSION['cijena']!=""){
                                                $cijena = $_SESSION['cijena'];
                                            }else{
                                                $cijena = "";
                                            }

                                            foreach ($kategorije as $kategorija) {
                                                $kategorijaid = $kategorija['id'];
                                                echo '<li class="closed"><a href="#">'.$kategorija['naziv'].'</a>
                                                        <ul>';
                                                        $podkategorije = Select("podkategorije", "WHERE kategorija='$kategorijaid'", "", "LIMIT 1");
                                                        foreach ($podkategorije as $podkategorija) {
                                                            echo '<li><a href="products.php?podkategorija='.$podkategorija['id'].'&pretraga='.$pretraga.'&cijena='.$cijena.'">'.$podkategorija['naziv'].'</a></li>';
                                                        }                                                            
                                                echo   '</ul>
                                                    </li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </aside>
                            <!-- shop-filter -->
                            <aside class="widget shop-filter box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Cijena</h6>
                                <div class="price_filter">
                                    <form method="POST">
                                        <div class="price_slider_amount">
                                            <input type="submit"  value="Raspon (KM): "/> 
                                            <input type="text" id="amount" name="cijena"  placeholder="Dodaj svoju cijenu" value="<?php echo $_SESSION['cijena']; ?>" />                                                                                    
                                        </div>
                                        <div id="slider-range"></div>
                                        <div class="text-center">
                                            <button class="submit-btn-1 mt-20 btn-hover-1" type="submit">filtriraj</button>
                                        </div>
                                    </form>                                    
                                </div>
                            </aside>
                            <!-- operating-system -->
                            <aside class="widget operating-system box-shadow mb-30" style="display: none;">
                                <h6 class="widget-title border-left mb-20">operating system</h6>
                                <form action="action_page.php">
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Windows Phone</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Bleckgerry ios</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Android</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">ios</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Windows Phone</label><br>
                                    <label><input type="checkbox" name="operating-1" value="phone-1">Symban</label><br>
                                    <label class="mb-0"><input type="checkbox" name="operating-1" value="phone-1">Bleckgerry os</label><br>
                                </form>
                            </aside>
                            <!-- widget-product -->
                            <aside class="widget widget-product box-shadow">
                                <h6 class="widget-title border-left mb-20">najnoviji proizvodi</h6>
                                <?php
                                    $objekti = Select("proizvodi", "", "ORDER BY postavljeno DESC", "LIMIT 3");

                                    foreach ($objekti as $objekat) {
                                        $slike = glob("Proizvodi/".$objekat['id']."/*", GLOB_BRACE);
                                        
                                        if($objekat['schneiderslika']!=""){
                                            $slika = $objekat['schneiderslika'];
                                        }else{
                                            $slika = $slike[0];
                                        }

                                        $fcijena = Cijena($objekat['mcijena'], $objekat['vcijena']);

                                        echo '<div class="product-item">
                                                <div class="product-img">
                                                    <a href="single-product.php?id='.$objekat['id'].'">
                                                        <img class="noback" src="'.$slika.'" alt=""/>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-title">
                                                        <a href="single-product.php?id='.$objekat['id'].'">'.$objekat['naziv'].'</a>
                                                    </h6>
                                                    <h3 class="pro-price">'.$fcijena.' KM</h3>
                                                </div>
                                            </div>';
                                    }
                                ?>                                
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

        </div>
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

    <div style="display: none" id="loading-div"></div>
    
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jquery.nivo.slider js -->
    <script src="lib/js/jquery.nivo.slider.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('.shop-pagination .lijevi:gt(4)').hide();

            if($('.lijevi:visible:first').text()=="1"){
                $('.prosli').hide();
            }
            if($('.lijevi:visible:last').text()=="<?php echo ceil($total/10); ?>" || $('.lijevi:visible:last').text()=="1"){
                $('.iduci').hide();
            }

            $(document).on("click", ".prosli", function() {
                var first = $('.shop-pagination').children('.lijevi:visible:first');
                first.prevAll('.lijevi:lt(5)').show();
                if(first.prevAll().length < 4){
                     $('.prosli').hide();   
                }
                if($('.lijevi:visible:first').text()=="1"){
                    $('.prosli').hide();
                }
                first.prev().nextAll('.lijevi').hide();
                $('.iduci').show();
            });

            $(document).on("click", ".iduci", function() {
                var last = $('.shop-pagination').children('.lijevi:visible:last');
                last.nextAll('.lijevi:lt(4)').show();
                if(last.nextAll().length < 4){ 
                    $('.iduci').hide();
                }
                if($('.lijevi:visible:first').text()=="<?php echo ceil($total/10); ?>"){
                    $('.iduci').hide();
                }             
                last.next().prevAll('.lijevi').hide();                 
                $('.prosli').show();
            });

            $(document).on("click", ".closex", function(){
                $(this).parents("li").remove();                
                window.location = 'products.php?session='+$(this).data("session");
            });
        });
    </script>
    <?php
        if(isset($_SESSION['cijena'])){
            echo '<script>$( "#amount" ).val("'.$_SESSION['cijena'].'");</script>';
        }else{
            echo '<script>$( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );</script>';
        }        
    ?>
</body>

</html>