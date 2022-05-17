<?php
	define('TITLE', 'Deactivate Member');
	//header
	require('header.php');
	require('dbcon.php');

	//body
	echo "<h1>Member Deactivated</h1>";
	
	$memberId = $_GET['memberId']; 
	
	$query = "UPDATE member SET status='0' WHERE memberId=".$memberId."";
	$myData = mysqli_query($con, $query);
		
	if ($myData) {
		echo "<h4>Member with ID ".$memberId." has been successfully deactivated!</h4>";
	}
	else {
		echo "<h4>Failed to deactivate member!</h4>";
		echo '<p style="color:red;">Could not deactivate because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
		echo "<p><a href='deactivatemember.php'>Try Again</a></p>";
	}
	
	echo "<p><a href='home.php'>Back to main menu</a></p>";
	
	//footer
	echo "</body>";
	echo "</html>";
	
	mysqli_close($con);
?>