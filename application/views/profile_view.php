<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="http://localhost/robotics/templates/js/signup.js"></script>
	<link rel="stylesheet" href="http://localhost/robotics/templates/css/signup.css">	
	<meta charset="utf-8">
	<title>Update your account</title>
</head>
<body>
<div id="container">	
	<div id="body">							
		<form action="" method="post">
		  <h2>Update</h2>
				<p>
					<label for="StudentID" class="floatLabel">StudentID</label>					
					<?php
						echo '<input id="SID" name="SID" type="text" readonly="true" value="' . $memberID . '" />';						
					?>					
				</p>
				<p>
					<label for="Name" class="floatLabel">Name</label>
					<?php
						echo '<input id="Name" name="Name" type="text" value="' . $name . '" />';						
					?>					
				</p>				
				<p>
					<input type="submit" value="Save" id="submit" name="submit">
				</p>
		</form>
	</div>
	<p class="footer"> </p>	
</div>

</body>
</html>