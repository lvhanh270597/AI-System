<!DOCTYPE html>
<html>
<head>
	<title>Simulation</title>
</head>
<body>
	Select the bots which you want to test
	<form action="" method="post">
		<select name="a">
			<?php  
				foreach ($codes as $value) {
					echo '<option value="'.$value['codeID'].'">'.$value['name'].' </option>'."<br>";
				}

			?>						
		</select> 
		<select name="b">
			<?php  
				foreach ($codes as $value) {
					echo '<option value="'.$value['codeID'].'">'.$value['name'].' </option>'."<br>";
				}

			?>			
		</select>
		<input type="submit" name="submit" value="Run">
	</form>
</body>
</html>