<?php
session_start();
include "../dbkon.php";
include "../funkcije.php";

if(!isset($_SESSION['korisnik']) && $_SESSION['korisnik']!="admin"){
  echo "<script>window.location='index.php';</script>";
}

$edituj = $conn->real_escape_string($_REQUEST['edituj']);

$objekti = Select("klijenti", "WHERE id='$edituj'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
    $korisnicko = $objekat['korisnicko'];
    $popust = $objekat['popust'];
    $ime = $objekat['ime'];
    $prezime = $objekat['prezime'];
    $kompanija = $objekat['kompanija'];
    $adresa = $objekat['adresa'];
    $grad = $objekat['grad'];
    $drzava = $objekat['drzava'];
    $postanski = $objekat['postanski'];
    $email = $objekat['email'];
    $telefon = $objekat['telefon'];
    $blokiran = $objekat['blokiran'];
}

if($blokiran=="on"){ $blokiran="checked"; }

$stranica = "Klijenti";
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
    <title>CMS - Dodaj klijenta</title>
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
                <div class="panel-heading panel-heading-divider">Dodaj klijenta</div>
                <div class="panel-body">
                  <form method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Korisničko ime</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite korisnicko ime" class="form-control" type="text" value="<?php echo $korisnicko; ?>" required name="korisnicko">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Lozinka</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite lozinku" class="form-control" type="password" value="<?php echo $lozinka; ?>" required name="lozinka">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Blokiran pristup</label>
                      <div class="col-sm-6">
                        <div class="be-checkbox be-checkbox-color inline">
                          <input id="blokiran" type="checkbox" name="blokiran" <?php echo $blokiran; ?>>
                          <label for="blokiran">Blokiran pristup</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Popust</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite popust (bez znaka %)" min="0" max="100" class="form-control" type="number" value="<?php echo $popust; ?>" required name="popust">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Ime</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite ime" class="form-control" type="text" value="<?php echo $ime; ?>" required name="ime">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Prezime</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite prezime" class="form-control" type="text" value="<?php echo $prezime; ?>" required name="prezime">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kompanija</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite naziv kompanije" class="form-control" type="text" value="<?php echo $kompanija; ?>" required name="kompanija">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Adresa</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite adresu" class="form-control" type="text" value="<?php echo $adresa; ?>" required name="adresa">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Grad</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite grad" class="form-control" type="text" value="<?php echo $grad; ?>" required name="grad">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Država</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite državu" class="form-control" type="text" value="<?php echo $drzava; ?>" required name="drzava">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Poštanski broj</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite poštanski broj" class="form-control" type="text" value="<?php echo $postanski; ?>" required name="postanski">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">E-mail</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite e-mail" class="form-control" type="text" value="<?php echo $email; ?>" required name="email">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Telefon</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite telefon" class="form-control" type="text" value="<?php echo $telefon; ?>" required name="telefon">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="text-center">
                      <button type="submit" class="btn btn-space btn-primary btn-lg"><i class="icon mdi mdi-save"></i> Spasi izmjene</button>
                    </div>
                  </form>
                  <?php
                  if(isset($_REQUEST['korisnicko'])){
                    $korisnicko = $conn->real_escape_string($_REQUEST['korisnicko']);
                    $lozinka = $conn->real_escape_string($_REQUEST['lozinka']);
                    $popust = $conn->real_escape_string($_REQUEST['popust']);
                    $blokiran = $conn->real_escape_string($_REQUEST['blokiran']);
                    $ime = $conn->real_escape_string($_REQUEST['ime']);
                    $prezime = $conn->real_escape_string($_REQUEST['prezime']);
                    $kompanija = $conn->real_escape_string($_REQUEST['kompanija']);
                    $adresa = $conn->real_escape_string($_REQUEST['adresa']);
                    $grad = $conn->real_escape_string($_REQUEST['grad']);
                    $drzava = $conn->real_escape_string($_REQUEST['drzava']);
                    $postanski = $conn->real_escape_string($_REQUEST['postanski']);
                    $email = $conn->real_escape_string($_REQUEST['email']);
                    $telefon = $conn->real_escape_string($_REQUEST['telefon']);

                    $hash = password_hash($lozinka, PASSWORD_DEFAULT, ['cost' => 12]);

                    if(!isset($_REQUEST['edituj'])){
                      $id = Insert("klijenti", "korisnicko,lozinka,popust,ime,prezime,kompanija,adresa,grad,drzava,postanski,email,telefon, blokiran", "'$korisnicko','$hash','$popust','$ime','$prezime','$kompanija','$adresa','$grad','$drzava','$postanski','$email','$telefon', '$blokiran'");

                      echo "<script>alert('Klijent je dodan!');window.location='klijenti.php';</script>";
                    }else{
                      $id = $conn->real_escape_string($_REQUEST['edituj']);
                      Update("klijenti", "korisnicko='$korisnicko',lozinka='$hash',popust='$popust',ime='$ime',prezime='$prezime',kompanija='$kompanija',adresa='$adresa',grad='$grad',drzava='$drzava',postanski='$postanski',email='$email',telefon='$telefon', blokiran='$blokiran'",  $id);

                      echo "<script>alert('Promjene su spašene!');window.location='klijenti.php';</script>";

                    }
                  }
                  ?>
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
  </body>

</html>