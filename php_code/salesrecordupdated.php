<?php
	define('TITLE', 'Update Sales Record');
	//header
	require('header.php');
	require('dbcon.php');

	//body
	echo "<h1>Sales Record Updated</h1>";
	
	$recordId = $_POST['recordId']; 
	$memberId = $_POST['memberId'];
	$comments = $_POST['comments']; 
	
	$query = "UPDATE salesrecord SET memberId=".$memberId.", comments='".$comments."' WHERE salesRecordId=".$recordId."";
	$myData = mysqli_query($con, $query);
		
	if ($myData) {
		echo "<h4>Sales Record with ID ".$recordId." has been successfully updated!</h4>";
	}
	else {
		echo "<h4>Failed to update sales record from view!</h4>";
		echo '<p style="color:red;">Could not update because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
		echo "<p><a href='updatesalesrecord.php'>Try Again</a></p>";
	}
	
	echo "<p><a href='home.php'>Back to main menu</a></p>";
	
	//footer
	echo "</body>";
	echo "</html>";
	
	mysqli_close($con);
?>