<?php
session_start();
include "../dbkon.php";
include "../funkcije.php";

if(!isset($_SESSION['korisnik']) && $_SESSION['korisnik']!="admin"){
  echo "<script>window.location='index.php';</script>";
}

$edituj = $conn->real_escape_string($_REQUEST['edituj']);

$objekti = Select("narudzbe", "WHERE id='$edituj'", "", "LIMIT 1");

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
    $proizvodi = explode(",", $objekat['proizvodi']);
    $kolicine = explode(",", $objekat['kolicine']);
    $total = $objekat['total'];
    $klijent = $objekat['klijent'];
}

$stranica = "Narudzbe";
?>
<!DOCTYPE html>
<html lang="bs">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>CMS - Detaljno</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="assets/lib/summernote/summernote.css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>
  <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
          <div class="navbar-header"><a href="novosti.php" class="navbar-brand"></a>
          </div>
          <div class="be-right-navbar">
            <div class="page-title"><span>CMS (Sustav za upravljanje sadržajima)</span></div>
            <ul class="nav navbar-nav navbar-right be-icons-nav">
            </ul>
          </div>
        </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">CMS (Sustav za upravljanje sadržajima)</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                  <li class="divider">Meni</li>
                  <?php include "navigacija.php"; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Detaljno</div>
                <div class="panel-body">
                  <form id="form" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Ime i prezime</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $ime." ".$prezime; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kompanija</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $kompanija; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Adresa</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $adresa; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Grad</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $grad; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Država</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $drzava; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Poštanski</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $postanski; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $email; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Telefon</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input class="form-control" type="text" value="<?php echo $telefon; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Proizvod</th>  
                          <th>Količina</th>
                          <th>Cijena</th>                          
                        </tr>
                      </thead>
                      <tbody class="no-border-x filtriraj">
                        <?php
                        for ($i=0; $i < count($proizvodi); $i++) { 
                          $id = $proizvodi[$i];
                          $objekti = Select("proizvodi", "WHERE id='$id'", "", "LIMIT 1"); 
                          foreach ($objekti as $objekat) {
                            $nazivproizvoda = $objekat['naziv'];
                            $cijenaproizvoda = Cijena($objekat['mcijena'], $objekat['vcijena'],$klijent);
                          }
                          echo '<tr>
                                  <td>'.$nazivproizvoda.'</td>
                                  <td>'.$kolicine[$i].'</td>
                                  <td>'.$kolicine[$i]*$cijenaproizvoda.' BAM</td>
                                </tr>';                          
                        }                                              
                        ?>
                        <tfoot>
                          <tr>
                            <th>Total:</th>
                            <th><?php echo count($proizvodi); ?></th>
                            <th><?php echo $total; ?> BAM</th>
                          </tr>
                        </tfoot>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <script src="assets/lib/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="assets/lib/summernote/summernote-ext-beagle.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.textEditors();

        $('#form').submit(function(e){
          $("#texteditor").html($('#editor1').summernote('code'));
        });

        $('#editor1').summernote('code', '<?php echo $tempopis; ?>');

        
      });

    </script>
  </body>

</html>