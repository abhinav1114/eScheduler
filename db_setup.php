<?php
// Database server, username, and password constants
$db_server 		= "localhost:3306";
$db_username 	= "dcspg31";
$db_password 	= "walkingdead";
$db_name		= "dcspg31";

/* Create a connection */
$connection = new mysqli($db_server,$db_username,$db_password,$db_name);
	
/* Check the connection */
if ($connection->connect_errno) {
	printf("Connection failed: %s\n", mysqli_connect_error());
	exit();
}




/* Database Functions */

function getUser($userID){
	global $connection;
	
	/* Process results */
	if ($result = $connection->query("SELECT * FROM User1 WHERE ID='$userID'")){
	
		/* Check to see if any results */
		if($result->num_rows == 1){
			//Grabs events
			$user = $result->fetch_array(MYSQLI_ASSOC);
			$date = new DateTime($user['Time_Stamp']);
			
			//Store info in 'userInfo' array
			$userInfo = array(
				'ID'			=> $userID,
				'Username'		=> $user["Username"],
				'Email'			=> $user["Email"],
				'First_Name'	=> $user["First_Name"],
				'Last_Name'		=> $user["Last_Name"],
				'Date_Added'	=> $date->format("l F d,Y")
			);
			
			/* Returns userInfo array */
			return $userInfo;
		}

		/* close result set */
		$result->close();
	}

	/* close connection */
	$mysqli->close();
	
	return NULL;
}

function getEvent($id){
	global $connection;
	
	/* Process results */
	if ($result = $connection->query("SELECT * FROM Events WHERE ID='$id'")){
		/* Check to see if any results */
		if($result->num_rows == 1){
			//Grabs events
			$event = $result->fetch_array(MYSQLI_ASSOC);
			$user = getUser($event["User_ID"]);
			
			//Store info in 'eventInfo' array
			$eventInfo = array(
				'ID'			=> $id,
				'User_ID'		=> $event["User_ID"],
				'Username'		=> $user["Username"],
				'User_Email'	=> $user["Email"],
				'First_Name'	=> $user["First_Name"],
				'Last_Name'		=> $user["Last_Name"],
				'eName'			=> $event["eName"],
				'eDescription'	=> $event["eDescription"],
				'eDate'			=> $event["eDate"]
			);
			
			/* Returns eventInfo array */
			return $eventInfo;
		}

		/* close result set */
		$result->close();
	}
	
	return NULL;
}

function updateEvent($info){
	global $connection;
	$date 			= new DateTime($info["date"]);
	$subject		= $connection->real_escape_string($info['subject']);
	$description	= $connection->real_escape_string($info['description']);
	$fomatted_date	= $date->format('Y-m-d');
	$id				= $info['id'];
	
	if(!$connection->query("UPDATE `dcspg31`.`Events` SET `eName` = '$subject', 
		`eDescription` = '$description', `eDate` = '$fomatted_date' 
		WHERE `Events`.`ID` = '$id'"))
		return $connection->error;
	
	return NULL;
}

function deleteEvent($id){
	global $connection;
	
	if(!$connection->query("DELETE FROM `dcspg31`.`Events` WHERE `Events`.`ID` = $id"))
		return false;
	
	return true;
}
