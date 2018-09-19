<?php
ini_set('memory_limit','1536M'); // 1.5 GB
ini_set('max_execution_time', 18000); // 5 sati

require('libs/xmlreader-iterators.php');

include "../../dbkon.php";
include "../../funkcije.php";

$xmlFile = "stanje/selekting.xml";

$reader = new XMLReader();
$reader->open($xmlFile);

$productIterator = new XMLElementIterator($reader, 'artikal');

$products = array();

foreach ($productIterator as $product) {
    $xml = $product->asSimpleXML();
    
    if(substr($xml['vpc'], 0, 1)==="."){
    	$vpc = "0".$xml['vpc'];
    }else{
    	$vpc = $xml['vpc'];
    }
    if(substr($xml['mpc'], 0, 1)==="."){
    	$mpc = "0".$xml['mpc'];
    }else{
    	$mpc = $xml['mpc'];
    }

    $products[] = array(    	
    	'sifra' => (string)$xml['sifra'],
        'naziv' => (string)$xml['naziv'],
        'kolicina' => (string)$xml['kolicina'],
        'vpc' => (string)$vpc,
        'mpc' => (string)$mpc,
    );
}

TruncateTable("stanja");

foreach ($products as $product) {
	$sifra = $conn->real_escape_string($product['sifra']);
	$naziv = $conn->real_escape_string($product['naziv']);
    $kolicina = $conn->real_escape_string($product['kolicina']);
    $vpc = $conn->real_escape_string($product['vpc']);
    $mpc = $conn->real_escape_string($product['mpc']);

    UpdatePoSifri("proizvodi", "naziv='$naziv', mcijena='$mpc', vcijena='$vpc', kolicina='$kolicina'",  $sifra);

	Insert("stanja", "sifra,naziv,kolicina,vpc,mpc", "'$sifra','$naziv','$kolicina','$vpc','$mpc'")."<br>";	
}

echo "Gotovo";
?>