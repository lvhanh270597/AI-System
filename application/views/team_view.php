<!DOCTYPE html>
<html>
<head>
	<title><?php echo $info['name']; ?></title>
</head>
<body>
	<?php
	foreach ($members as $mem) {
		echo $mem['memberID']." </br>";
	}
	?>
</body>
</html>