<!DOCTYPE html>
<html>
<head>
  <title><? echo $title; ?></title>
</head>
<body>
  	<form method="post" action="">
    	<button type="submit" name="button" value="create"> Create </button>
      <button type="submit" name="button" value="submit"> Submit </button>
      <button type="submit" name="button" value="simulate"> Simulate </button>
  	</form>
  	Your team: <?php echo '<a href="http://localhost/robotics/index.php/team/info/'.$myTeamID.'"> '. $myTeam.'</a>'; ?> </br>
  	<?php
  	echo '<a href="http://localhost/robotics/index.php/contest/leave_team/'.$myTeamID.'"> Leave your team </a> ';
  	?>
	</br>
  	List of all teams
  	<table>	  	
	  	<?php
	  		foreach ($teams as $team) {
	  			echo "<tr> <td> ".$team['name']."</td>";	  			
	  			echo '<td> <a href="http://localhost/robotics/index.php/contest/join_team/'.$team['teamID'].'"> Join </a> </td>';
	  			echo "</tr>";	  			
	  		}
	  	?>
	</table>
  
</body>
</html>