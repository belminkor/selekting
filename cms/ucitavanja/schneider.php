<?php
header('Content-Type: application/json');
session_start();
include "../../dbkon.php";
include "../../funkcije.php";

$sifra = $conn->real_escape_string($_REQUEST['sifra']);

$objekti = Select("schneider", "WHERE sifra='$sifra'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
	$data['sifra'] = $objekat['sifra'];
	$data['opis'] = $objekat['opis'];
	$data['brend'] = $objekat['brend'];
	$data['slika'] = "Slike/".$objekat['slika'];
	$tempns = array_filter(explode("|", $objekat['nazivispecifikacija']));
	$tempts = array_filter(explode("|", $objekat['tekstspecifikacija']));
}

$finalns = "";
$finalts = "";

foreach ($tempns as $index=>$ns) {
	$ns = trim($ns);
	$ts = $tempts[$index];

	$objekti2 = Select("etimopcije", "WHERE kod='$ns'", "", "LIMIT 1");		
	$objekti3 = Select("etimvrijednosti", "WHERE kod='$ts'", "", "LIMIT 1");

	if($objekti3[0]['opis']==""){
		if($ts=="true") $ts = "Yes";
		if($ts=="false") $ts = "No"; 		
		$tsopis = $ts;		
	}else{
		$tsopis = $objekti3[0]['opis'];
	}

	if($objekti2[0]['opis']!="" && $tsopis){
		$finalns = $finalns."|".$objekti2[0]['opis'];
		$finalts = $finalts."|".$tsopis;
	}	
}

$data['nazivispecifikacija'] = $finalns;
$data['tekstspecifikacija'] = $finalts;

echo json_encode($data);
?>