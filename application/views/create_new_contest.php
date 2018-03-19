<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="http://localhost/robotics/templates/js/signup.js"></script>
	<link rel="stylesheet" href="http://localhost/robotics/templates/css/signup.css">	
	<meta charset="utf-8">
	<title>Create new contest</title>
</head>
<body>
<div id="container">	
	<div id="body">					




		<form action="" method="post">
		  <h2>Create new contest</h2>				
				<p>
					<label for="Name" class="floatLabel">Name's contest</label>
					<input id="Name" name="Name" type="text">
				</p>				
				<p>					
					<!doctype html>
					<html lang="en">
					<head>
					  <meta charset="utf-8">
					  <meta name="viewport" content="width=device-width, initial-scale=1">
					  <title>jQuery UI Datepicker - Default functionality</title>
					  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
					  <link rel="stylesheet" href="/resources/demos/style.css">
					  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
					  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
					  <script>
					  $( function() {
					    $( "#datepicker" ).datepicker();
					  } );
					  $( function() {
					    $( "#datepicker2" ).datepicker();
					  } );
					  </script>
					</head>
					<body>
						<p>Start: <input type="text" id="datepicker" name="start"></p>				
						<p>End: <input type="text" id="datepicker2" name="end"></p>				
					</body>

					</html>					
				</p>
				<p>
					<input type="submit" value="Create" id="submit" name="submit">
				</p>
		</form>
	</div>
	<p class="footer"> </p>	
</div>

</body>
</html>