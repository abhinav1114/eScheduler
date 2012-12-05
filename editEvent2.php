<?php
session_start();
if($_SESSION['loggedin']!=True)
{
    if($_COOKIE['username'] != NULL && $_COOKIE['password'] != NULL)
        header('Location: Login.php');
}

require_once('db_setup.php');
$location = $_GET['location'];

if(isset($_POST["update"])){
	$info = array(
		'id'			=> $_POST["id"],
		'subject'		=> $_POST['subject'],
		'date'			=> $_POST['date'],
		'description'	=> $_POST['description']
	);
	
	$result = updateEvent($info);
	if($result == NULL)
		$_SESSION["db_message"] = "Successfully updated event!";
	else
		$_SESSION["db_error"] = $result;
}

elseif(isset($_POST["delete"])){
	$id = $_POST["id"];
	
	if(deleteEvent($id))
		$_SESSION["db_message"] = "Successfully deleted event!";
	else
		$_SESSION["db_error"] = "Error in deleting event!";
}
else
	$_SESSION["db_error"] = "Nothing provided";
	

header("Location: http://pluto.cse.msstate.edu/~dcspg31/$location");

?>