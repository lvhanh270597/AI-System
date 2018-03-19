<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="http://localhost/robotics/templates/js/signup.js"></script>
	<link rel="stylesheet" href="http://localhost/robotics/templates/css/signup.css">	
	<meta charset="utf-8">
	<title>Create new team</title>
</head>
<body>
<div id="container">	
	<div id="body">							
		<form action="" method="post">
		  <h2>Create new team</h2>				
				<p>
					<label for="Name" class="floatLabel">Name's team</label>
					<input id="Name" name="Name" type="text">
				</p>
				<p>
					<label for="password" class="floatLabel">Password</label>
					<input id="password" name="password" type="password">
					<span>Enter a password longer than 8 characters</span>
				</p>
				<p>
					<label for="confirm_password" class="floatLabel">Confirm Password</label>
					<input id="confirm_password" name="confirm_password" type="password">
					<span>Your passwords do not match</span>
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
