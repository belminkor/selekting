<?php
session_start();
include "../dbkon.php";
include "../funkcije.php";
if(!isset($_SESSION['korisnik'])){
  echo "<script>window.location='index.php';</script>";
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
    <link rel="shortcut icon" href="../img/icon/logo-fav.png">
    <title>CMS - Podkategorije</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>
  <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
          <div class="navbar-header"><a href="proizvodi.php" class="navbar-brand"></a>
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
            <div class="col-sm-12">
              <div class="panel panel-default panel-table panel-border-color panel-border-color-primary">
                <div class="panel-heading">
                  Podkategorije
                  <a href="dodaj-podkategoriju.php">
                    <button type="button" class="btn btn-space btn-primary btn-sm pull-right"><i class="icon mdi mdi-plus"></i> Dodaj podkategoriju</button>
                  </a>
                </div>
                <hr>
                <div class="panel-body">
                  <div class="input-group input-group-sm col-md-12">
                    <input id="filter" placeholder="Pretraži" type="text" class="form-control border-less">
                  </div>
                  <table class="table table-striped table-borderless">
                    <thead>
                      <tr>
                        <th>Naziv podkategorije</th>
                        <th>Kategorija</th>
                        <th class="actions">Edituj</th>
                        <th class="actions">Briši</th>
                      </tr>
                    </thead>
                    <tbody class="no-border-x filtriraj">
                      <?php
                      $objekti = Select("podkategorije", "", "ORDER BY postavljeno DESC", "");

                      foreach ($objekti as $objekat) {
                          $kategorija = $objekat['kategorija'];

                          $objekti2 = Select("kategorije", "WHERE id='$kategorija'", "", "LIMIT 1");

                          foreach ($objekti2 as $objekat2) {
                            $kategorija = $objekat2['naziv'];
                          }

                          echo '<tr>
                                  <td>'.$objekat['naziv'].'</td>                        
                                  <td>'.$kategorija.'</td>
                                  <td class="actions"><a href="dodaj-podkategoriju.php?edituj='.$objekat['id'].'" class="icon"><i class="mdi mdi-edit"></i></a></td>
                                  <td class="actions"><a href="podkategorije.php?brisi='.$objekat['id'].'" class="icon"><i class="mdi mdi-delete"></i></a></td>
                                </tr>';
                      }
                       if(isset($_REQUEST['brisi'])){
                            $id = $_REQUEST['brisi'];
                            Remove("podkategorije", $id);

                            echo "<script>alert('Podkategorija je izbrisana!');window.location='podkategorije.php';</script>";
                        }
                      ?>
                    </tbody>
                  </table>
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
    <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
        $('#filter').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');
            $('.filtriraj tr').hide();
            $('.filtriraj tr').filter(function () {
                return rex.test($(this).text());
            }).show();
        });
    });
    </script>
    
  </body>

</html>