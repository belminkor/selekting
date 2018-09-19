<?php
session_start();

$session = $_REQUEST['session'];

$_SESSION["$session"] = "";
?>