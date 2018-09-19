<?php
session_start();
include "../dbkon.php";
include "../funkcije.php";

if(!isset($_SESSION['korisnik']) && $_SESSION['korisnik']!="admin"){
  echo "<script>window.location='index.php';</script>";
}

$edituj = $conn->real_escape_string($_REQUEST['edituj']);

$objekti = Select("podkategorije", "WHERE id='$edituj'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
    $naziv = $objekat['naziv'];    
    $kategorija = $objekat['kategorija'];
}

$stranica = "Podkategorije";
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
    <title>CMS - Dodaj podkategoriju</title>
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
                <div class="panel-heading panel-heading-divider">Dodaj podkategoriju</div>
                <div class="panel-body">
                  <form method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Izaberi kategoriju</label>
                      <div class="col-sm-6">
                        <select class="form-control select" id="kategorija" name="kategorija" required>
                          <option disabled selected>Izaberite kategoriju</option>
                          <?php
                          $objekti = Select("kategorije", "", "ORDER BY postavljeno DESC", "");

                          foreach ($objekti as $objekat) {
                            echo '<option value="'.$objekat['id'].'">'.$objekat['naziv'].'</option>';
                          }
                          ?>
                        </select>
                        <?php
                            if($kategorija!=""){ echo '<script>var element = document.getElementById("kategorija"); element.value = "'.$kategorija.'";</script>'; }
                        ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Naziv podkategorije</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite naziv podkategorije" class="form-control" type="text" value="<?php echo $naziv; ?>" required name="naziv">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="text-center">
                      <button type="submit" class="btn btn-space btn-primary btn-lg"><i class="icon mdi mdi-save"></i> Spasi izmjene</button>
                    </div>
                  </form>
                  <?php
                  if(isset($_REQUEST['naziv'])){
                    $naziv = $conn->real_escape_string($_REQUEST['naziv']);
                    $kategorija = $conn->real_escape_string($_REQUEST['kategorija']);

                    if(!isset($_REQUEST['edituj'])){
                      $id = Insert("podkategorije", "naziv, kategorija", "'$naziv', '$kategorija'");

                      echo "<script>alert('Podkategorija je dodana!');window.location='podkategorije.php';</script>";
                    }else{
                      $id = $conn->real_escape_string($_REQUEST['edituj']);
                      Update("podkategorije", "naziv='$naziv', kategorija='$kategorija'",  $id);

                      echo "<script>alert('Promjene su spašene!');window.location='podkategorije.php';</script>";

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