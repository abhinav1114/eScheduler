<?php
session_start();
$Nmonth = date("n");
$Year = date("Y");
$_SESSION['month']=$Nmonth;
$_SESSION['year']=$Year;
$_SESSION['loggedin']=True;
header("Location: welcome.php");
?>
