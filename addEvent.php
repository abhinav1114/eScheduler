<?php
    session_start();
	if($_SESSION['loggedin']!=True)
	{
		if($_COOKIE['username'] != NULL && $_COOKIE['password'] != NULL)
			header('Location: Login.php');
	}

	$subject 		= $_POST['subject'];
	$description 	= $_POST['description'];
	$date 			= $_POST['date'];
	$ID 			= $_SESSION['id'];
	$location		= $_GET['location'];

	require_once('db_setup.php');

	$con = mysql_connect($db_server, $db_username, $db_password);
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($db_username, $con);

	$query2 = sprintf("INSERT INTO Events (User_ID,eName,eDescription,eDate) VALUES ('%s','%s','%s','%s')",
	mysql_escape_string($ID),
	mysql_escape_string($subject),
	mysql_escape_string($description),
	mysql_escape_string($date));

	$result = mysql_query($query2);

	if(!mysql_errno($con))
		$_SESSION['db_message'] = "Successfully Added Event";
	else
		$_SESSION['db_error']	 = "There were technical difficulties in adding your event!";
		
	header("Location: $location");
?>