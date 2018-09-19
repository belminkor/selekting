<?php
include "../funkcije.php";
$kategorija = $_REQUEST['kategorija'];

$objekti = Select("podkategorije", "WHERE kategorija='$kategorija'", "", "LIMIT 1");

foreach ($objekti as $objekat) {
	echo '<option value="'.$objekat['id'].'">'.$objekat['naziv'].'</option>';
}
?>