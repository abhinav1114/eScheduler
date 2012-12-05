<?php

if(isset($_POST['date'])){
	$date 		= $_POST['date'];
	$location 	= $_GET['location'];

	print('
	<head>
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script src="http://pluto.cse.msstate.edu/~dcspg31/javascript/jquery.validate.js"></script>

	<link rel="stylesheet" href="http://pluto.cse.msstate.edu/~dcspg31/css/smoothness/jquery-ui-1.9.2.custom.css">
	</head>

	<style>
		.button{ 
			background-color: maroon; 
			color: white;
		}
		
		.error{ 
			color: red;
			font-size: 12px;
			margin-bottom: 10px;
		}
		
		label{
			font-size: 16px;
			display: block;
			text-align: center;
		}
		.center{text-align: center;}
		h4{margin-bottom: 0;}
		p{margin-top: 5px;}
		#buttons{text-align: center;}
		textarea{width: 265px;}
		#subject{
			width: 100%;
			height: 23px;
		}
		#description{
			width: 270px;
			margin: auto;
			font-size: 16px;
		}
		textarea{
			height: 250px;
			text-align: center;
		}
		input{
			text-align: center;
			margin: auto;
		}
		#buttons{text-align: center}
	</style>

	<div id="addForm">
		<h2><form action="addEvent.php?location='.$location.'" method="POST" id="form">
		
			<div id="description">
				<label for="subject">Subject:</label>
				<input id="subject" type="text" name="subject" required="true"/>
				
				<label for="description">Description:</label>
				<p><textarea name="description">
						 Describe the event...
				</textarea></p>
			</div>
			
			<div id="buttons">
				<input type="submit" class="button" value="Submit"/>
				<input type="reset" class="button" value="Cancel"/>
			</div>
			<input type="hidden" name="date" date="true" required="true" value="'.$date.'"/>
			</h2>
		</form> 
	</div>

	<script>
		$(function(){
			$( "#form" ).validate();
		});
	</script>
	');
}
else
	print("No date passed through $_POST");