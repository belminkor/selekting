<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "c14_selekting";

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SET NAMES 'utf8'";
$conn->query($sql);
if ($conn->connect_error) {
    die("Greska:" . $conn->connect_error);
}
?>