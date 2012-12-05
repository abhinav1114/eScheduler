<?php
session_start();
$today = new DateTime('today',new DateTimeZone('America/Chicago'));
$_SESSION['month']=$today->format("n");
$_SESSION['year']=$today->format("Y");
header('Location: welcome.php');
?>
