<?php
session_start();
if($_SESSION['loggedin']!=True)
{
    if($_COOKIE['username'] != NULL && $_COOKIE['password'] != NULL)
        header('Location: Login.php');
}


include "db_setup.php";
$eventID	= $_POST['id'];
if($event = getEvent($eventID)){
	$location	= $_GET['location'];

	$html = '
		<style>
			.center{text-align: center;}
			h4{margin-bottom: 0;}
			p{margin-top: 5px;}
			#buttons{text-align: center;}
			textarea{width: 265px;}
			#inputs{
				width: 215px;
				margin: auto;
			}
			#description{
				width: 270px;
				margin: auto;
			}
		</style>
		
		
		<form action="editEvent2.php?location='.$location.'" method="POST">
			<div id="inputs">
				<h4>Subject:</h4>
				<p><input type="text" name="subject" required="true" value="'.$event["eName"].'"/></p>
				
				<h4>Date:</h4>
				<p><input type="text" name="date" id="date" required="true" value="'.$event["eDate"].'"/> <br /></p>
			</div>
			
			<div id="description">
				<h4>Description:</h4>
				<p><textarea name="description"  rows="6">'.$event["eDescription"].'</textarea></p>
			</div>
			
			<div id="buttons">
				<input name="update" type="submit" id="mysubmit" value="Update"/>
				<input name="delete" type="submit" id="mydelete" value="Delete"/>
				<input name="reset" type="reset"  id="myreset" value="Cancel"/>
			</div>
			
			<input type="hidden" name="id" value="'.$eventID.'" />
		</form> 
		<script>
			$("#date").datepicker();
		</script>
	';

	print $html;
} 
else
	print("Error in retrieving event");