<!DOCTYPE html>
<html>
<head>
	<title>
		This is simulation page
	</title>
</head>
<body>

	<?php echo $error;?>

	<?php echo form_open_multipart('contest/do_upload/'.$contest);?>

		<label> enter your bot name: </label>

		<input type="text" name="botname">
		<br>

		<input type="file" name="userfile" size="20" />

		<br /><br />

		<input type="submit" value="Submit" />

	</form>
	You can run your program here and view the result step by step		

</body>
</html>