<?php
session_start();
include "dbkon.php";
include "funkcije.php";

$ime = $conn->real_escape_string($_REQUEST['ime']);
$prezime = $conn->real_escape_string($_REQUEST['prezime']);
$adresa = $conn->real_escape_string($_REQUEST['adresa']);
$grad = $conn->real_escape_string($_REQUEST['grad']);
$drzava = $conn->real_escape_string($_REQUEST['drzava']);
$postanski = $conn->real_escape_string($_REQUEST['postanski']);
$email = $conn->real_escape_string($_REQUEST['email']);
$telefon = $conn->real_escape_string($_REQUEST['telefon']);
$kompanija = $conn->real_escape_string($_REQUEST['kompanija']);
$proizvodi = implode(",", $_SESSION['products']);
$kolicine = implode(",", $_SESSION['quantities']);
$total = $_SESSION['total'];
$klijent = $_SESSION['klijent'];

$idnarudzbe = Insert("narudzbe", "ime, prezime, adresa, grad, drzava, postanski, email, telefon, kompanija, proizvodi, kolicine, total, klijent", "'$ime', '$prezime', '$adresa', '$grad', '$drzava', '$postanski', '$email', '$telefon', '$kompanija', '$proizvodi', '$kolicine', '$total', '$klijent'");

$_SESSION['products'] = array();
$_SESSION['quantities'] = array();

$_SESSION['idnarudzbe'] = $idnarudzbe;

echo "<script>window.location='order-completed.php';</script>";
?>