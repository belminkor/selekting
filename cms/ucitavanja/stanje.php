<?php
header('Content-Type: application/json');
session_start();
include "../../dbkon.php";
include "../../funkcije.php";

$sifra = $conn->real_escape_string($_REQUEST['sifra']);

$objekti = Select("stanja", "WHERE sifra='$sifra'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
	$data['sifra'] = $objekat['sifra'];
	$data['naziv'] = $objekat['naziv'];
	$data['vpc'] = $objekat['vpc'];
	$data['mpc'] = $objekat['mpc'];
}

echo json_encode($data);
?>