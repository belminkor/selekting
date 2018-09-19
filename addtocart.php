<?php
header('Content-Type: application/json');
session_start();
include "dbkon.php";

if(!isset($_SESSION['products'])){
  $_SESSION['products'] = array();
  $_SESSION['quantities'] = array();
}

$productid = $_REQUEST['productid'];
$quantity = $_REQUEST['quantity'];

array_push($_SESSION['products'], $productid);
array_push($_SESSION['quantities'], $quantity);

$data['response'] = "ok";
echo json_encode($data);
?>