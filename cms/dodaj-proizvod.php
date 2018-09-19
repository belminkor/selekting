<?php
session_start();
include "../dbkon.php";
include "../funkcije.php";

if(!isset($_SESSION['korisnik']) && $_SESSION['korisnik']!="admin"){
  echo "<script>window.location='index.php';</script>";
}

$edituj = $conn->real_escape_string($_REQUEST['edituj']);

$objekti = Select("proizvodi", "WHERE id='$edituj'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
    $sifra = $objekat['sifra'];
    $naziv = $objekat['naziv'];
    $brend = $objekat['brend'];
    $mcijena = $objekat['mcijena'];
    $vcijena = $objekat['vcijena'];
    $kategorija = $objekat['kategorija'];
    $podkategorija = $objekat['podkategorija'];
    $najprodavanije = $objekat['najprodavanije'];
    $vidljiv = $objekat['vidljiv'];
    $opis = $objekat['opis'];
    $schneiderslika = $objekat['schneiderslika'];
    $nazivspecifikacije = explode("|", $objekat['nazivspecifikacije']);
    $tekstspecifikacije = explode("|", $objekat['tekstspecifikacije']);

}

if($najprodavanije=="on"){ $najprodavanije="checked"; }
if($vidljiv=="on"){ $vidljiv="checked"; }

$stranica = "Proizvodi";
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>CMS - Dodaj proizvod</title>
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
                <div class="panel-heading panel-heading-divider">Dodaj proizvod</div>
                <div class="panel-body">
                  <form id="form" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Šifra proizvoda</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-key"></i></span>
                          <input id="sifra" placeholder="Unesite šifru proizvoda" class="form-control" type="text" value="<?php echo $sifra; ?>" required name="sifra">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Naziv proizvoda</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-view-list"></i></span>
                          <input placeholder="Unesite naziv proizvoda" class="form-control" type="text" value="<?php echo $naziv; ?>" required id="naziv" name="naziv">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Brend proizvoda</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-tag"></i></span>
                          <input placeholder="Unesite brend proizvoda" class="form-control" type="text" min="0" value="<?php echo $brend; ?>" required id="brend" name="brend">
                        </div>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Maloprodajna cijena proizvoda</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-money"></i></span>
                          <input placeholder="Unesite cijenu proizvoda" class="form-control" type="number" min="0" step="0.00001" value="<?php echo $mcijena; ?>" id="mpc" required name="mcijena">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Veleprodajna cijena proizvoda</label>
                      <div class="col-sm-6">
                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon"><i class="icon mdi mdi-money"></i></span>
                          <input placeholder="Unesite cijenu proizvoda" class="form-control" type="number" step="0.00001" value="<?php echo $vcijena; ?>" id="vpc" required name="vcijena">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kategorija</label>
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
                      <label class="col-sm-3 control-label">Podkategorija</label>
                      <div class="col-sm-6">
                        <select class="form-control select" id="podkategorija" name="podkategorija" required>
                          <?php
                          if(isset($_REQUEST['edituj'])){                            
                            $objekti = Select("podkategorije", "WHERE kategorija='$kategorija'", "ORDER BY postavljeno DESC", "");

                            foreach ($objekti as $objekat) {
                              echo '<option value="'.$objekat['id'].'">'.$objekat['naziv'].'</option>';                            
                            }
                            if($podkategorija!=""){ echo '<script>var element = document.getElementById("podkategorija"); element.value = "'.$podkategorija.'";</script>'; }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Najprodavaniji proizvod</label>
                      <div class="col-sm-6">
                        <div class="be-checkbox be-checkbox-color inline">
                          <input id="najprodavanije" type="checkbox" name="najprodavanije" <?php echo $najprodavanije; ?>>
                          <label for="najprodavanije">Najprodavaniji proizvod</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Vidljiv u trgovini</label>
                      <div class="col-sm-6">
                        <div class="be-checkbox be-checkbox-color inline">
                          <input id="vidljiv" type="checkbox" name="vidljiv" <?php echo $vidljiv; ?>>
                          <label for="vidljiv">Vidljiv u trgovini</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Detaljni opis</label>
                      <div class="col-sm-6">
                        <textarea class="form-control" id="opis" name="opis"><?php echo $opis; ?></textarea>
                      </div>
                    </div>

                    <div class="panel-heading panel-heading-divider">Tehničke specifikacije</div>

                    <div class="tehnicke">
                      <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" id="dodaj-specifikaciju" class="btn btn-space btn-primary btn-lg"><i class="icon mdi mdi-plus"></i> Dodajte specifikaciju</button>
                        </div>                      
                      </div>
                      <hr>

                      <table class="table table-striped table-borderless">
                        <thead>
                          <tr>
                            <th>Naziv</th>  
                            <th>Tekst</th>
                            <th class="actions">Briši</th>                          
                          </tr>
                        </thead>
                        <tbody class="no-border-x" id="tabela-specifikacija">
                          <?php
                          if(isset($_REQUEST['edituj'])){
                            for ($i=0; $i < count($nazivspecifikacije); $i++) { 
                              echo '<tr>
                                      <td><input placeholder="Unesite naziv specifikacije" class="form-control" type="text" required name="nazivspecifikacije[]" value="'.$nazivspecifikacije[$i].'"></td>
                                      <td><input placeholder="Unesite tekst specifikacije" class="form-control" type="text" required name="tekstspecifikacije[]" value="'.$tekstspecifikacije[$i].'"></td>
                                      <td class="actions"><a class="icon uklonispecifikaciju"><i class="mdi mdi-delete pointer"></i></a></td>
                                    </tr>';  
                            }
                          }
                          ?>                          
                        </tbody>
                      </table>
                    </div>

                    <hr>
                    <div class="row">
                      <div class="col-md-12 text-center">
                          <button type="button" id="dodaj-specifikaciju2" class="btn btn-space btn-primary btn-lg"><i class="icon mdi mdi-plus"></i> Dodajte specifikaciju</button>
                      </div>                      
                    </div>

                    <div class="panel-heading panel-heading-divider">Dodajte slike</div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Slike</label>
                      <div class="col-sm-9">
                        <?php
                          if(isset($_REQUEST['edituj'])){

                              $slike = glob("../Proizvodi/$edituj/*", GLOB_BRACE);
                          
                              foreach ($slike as $slika) {
                                  echo '<div class="col-md-4">
                                          <div class="primg" style="background-image: url('.$slika.');"><img onclick="window.location=\'dodaj-proizvod.php?edituj='.$edituj.'&brisi='.$slika.'\';" src="assets/img/close.png" class="closeimg"></div>
                                        </div>';
                              } 
                          }
                        ?>                        
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Dodajte slike</label>
                      <div class="col-sm-6">
                        <input name="slike[]" id="slike" class="inputfile" type="file">
                        <label for="slike" class="btn-default"> <i class="mdi mdi-upload"></i><span>Izaberite slike</span></label>
                      </div>
                      <input type="hidden" name="schneiderslika" id="schneiderslika">
                    </div>
                    <hr>
                    <div class="text-center">
                      <button type="submit" class="btn btn-space btn-primary btn-lg"><i class="icon mdi mdi-save"></i> Spasi izmjene</button>
                    </div>
                  </form>
                  <?php
                  if(isset($_REQUEST['naziv'])){
                    $sifra = $conn->real_escape_string($_REQUEST['sifra']);
                    $naziv = $conn->real_escape_string($_REQUEST['naziv']);
                    $brend = $conn->real_escape_string($_REQUEST['brend']);
                    $mcijena = $conn->real_escape_string($_REQUEST['mcijena']);
                    $vcijena = $conn->real_escape_string($_REQUEST['vcijena']);
                    $kategorija = $conn->real_escape_string($_REQUEST['kategorija']);
                    $podkategorija = $conn->real_escape_string($_REQUEST['podkategorija']);
                    $najprodavanije = $conn->real_escape_string($_REQUEST['najprodavanije']);
                    $vidljiv = $conn->real_escape_string($_REQUEST['vidljiv']);
                    $opis = $conn->real_escape_string($_REQUEST['opis']);
                    $schneiderslika = $conn->real_escape_string($_REQUEST['schneiderslika']);
                    $nazivspecifikacije = implode("|", $_REQUEST['nazivspecifikacije']);
                    $tekstspecifikacije = implode("|", $_REQUEST['tekstspecifikacije']);

                    if(!isset($_REQUEST['edituj'])){
                      $id = Insert("proizvodi", "sifra, naziv, brend, mcijena, vcijena, kategorija, podkategorija, najprodavanije, vidljiv, opis, schneiderslika, nazivspecifikacije, tekstspecifikacije", "'$sifra','$naziv','$brend','$mcijena','$vcijena','$kategorija','$podkategorija','$najprodavanije','$vidljiv','$opis','$schneiderslika','$nazivspecifikacije','$tekstspecifikacije'");

                      Slike("slike", "../Proizvodi", $id, "slika.png", true);
                      
                      echo "<script>alert('Proizvod je dodan!');window.location='proizvodi.php';</script>";
                    }else{
                      $id = $conn->real_escape_string($_REQUEST['edituj']);
                      Update("proizvodi", "sifra='$sifra', naziv='$naziv', brend='$brend', mcijena='$mcijena', vcijena='$vcijena', kategorija='$kategorija', podkategorija='$podkategorija', najprodavanije='$najprodavanije', vidljiv='$vidljiv', opis='$opis', schneiderslika='$schneiderslika', nazivspecifikacije='$nazivspecifikacije', tekstspecifikacije='$tekstspecifikacije'",  $id);

                      Slike("slike", "../Proizvodi", $id, "slika.png", true);

                      echo "<script>alert('Promjene su spašene!');window.location='proizvodi.php';</script>";

                    }
                  }
                  if(isset($_REQUEST['brisi'])){
                    $brisi = $_REQUEST['brisi'];
                    unlink($brisi);
                    echo "<script>window.location='dodaj-proizvod.php?edituj=".$edituj."';</script>";
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
    <script type="text/javascript">
      $("#kategorija").change(function(){
          $("#podkategorija").load("ucitaj-podkategorije.php?kategorija="+$(this).val());
      });

      $("#dodaj-specifikaciju, #dodaj-specifikaciju2").click(function(){
        $("#tabela-specifikacija").append('<tr><td><input placeholder="Unesite naziv specifikacije" class="form-control" type="text" required name="nazivspecifikacije[]"></td><td><input placeholder="Unesite tekst specifikacije" class="form-control" type="text" required name="tekstspecifikacije[]"></td><td class="actions"><a class="icon uklonispecifikaciju"><i class="mdi mdi-delete pointer"></i></a></td></tr>');
      });

      $(document).on("click", ".uklonispecifikaciju", function(){
        $(this).parents("tr").remove();
      });

      $("#sifra").blur(function(){
        var sifra = $(this).val();
        $.ajax({
              url: 'ucitavanja/schneider.php',
              type: 'POST',
              data: {'sifra': sifra},
              success: function(data, status) {
                if ($(data).length){
                  $("#brend").val(data['brend']);
                  $("#opis").text(data['opis']);
                  $("#schneiderslika").val(data['slika']);
                  var ns = data['nazivispecifikacija'].split("|");
                  var ts = data['tekstspecifikacija'].split("|");
                  for (var i = 0; i < ns.length; i++) {
                    if(ns[i]!=""){
                      $("#tabela-specifikacija").append('<tr><td><input placeholder="Unesite naziv specifikacije" class="form-control" type="text" required name="nazivspecifikacije[]" value="'+ ns[i] +'"></td><td><input placeholder="Unesite tekst specifikacije" class="form-control" type="text" required name="tekstspecifikacije[]" value="'+ ts[i] +'"></td><td class="actions"><a class="icon uklonispecifikaciju"><i class="mdi mdi-delete pointer"></i></a></td></tr>');
                    }
                  }
                }
              }
            });
        
        $.ajax({
              url: 'ucitavanja/stanje.php',
              type: 'POST',
              data: {'sifra': sifra},
              success: function(data, status) {
                if ($(data).length){
                  $("#naziv").val(data['naziv']);
                  $("#vpc").val(data['vpc']);
                  $("#mpc").val(data['mpc']);
                }
              }
            });
      });
    </script>
  </body>
</html>