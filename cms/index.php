<?php
session_start();
if(isset($_SESSION['korisnik'])){
  echo "<script>window.location='proizvodi.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="bs">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/logo-fav.png">
    <title>Login - CMS</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading"><img src="../images/logo/logo.png" alt="logo" width="140" class="logo-img"><span class="splash-description">Molimo da unesete svoje podatke</span></div>
              <div class="panel-body">
                <form action="" method="POST">
                  <div class="form-group">
                    <input type="text" name="korisnicko" placeholder="Korisničko ime" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="lozinka" placeholder="Lozinka" class="form-control" required>
                  </div>
                  <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Login</button>
                  </div>
                </form>
                <?php
                if(isset($_REQUEST['korisnicko'])){
                  $korisnicko = $_REQUEST['korisnicko'];
                  $lozinka = $_REQUEST['lozinka'];
                  if($korisnicko=="selekting" && $lozinka=="PristupSelekting2018"){
                    $_SESSION['korisnik'] = "admin";
                    echo "<script>window.location='proizvodi.php';</script>";
                  }else{
                    echo "<script>alert('Netačni podaci!');</script>";
                  }
                }
                ?>
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
  </body>
</html>