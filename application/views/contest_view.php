<!DOCTYPE html>
<html>
<head>
	<title>Contest</title>
</head>
<body>
	<h1> All contest will show here</h1>
	<?php

	foreach ($contest as $key => $value) {
		echo $value['name'].' '.$value['start'].' '.$value['end'];		
		echo '<a href="http://localhost/robotics/index.php/contest/enter/' . $value['contestID'] .'"> Enter </a> </br>';
	}

	?>
</body>
</html>