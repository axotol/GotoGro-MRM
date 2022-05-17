<?php
	define('TITLE', 'Add Sales Record');
	//header
	require('header.php');
	require('dbcon.php');

	//body
	echo "<h1>Add a Sales Record</h1>";
	
	//check if form is submitted
	if (isset($_POST['submitted'])) {
		//store the variable
		$memberId = $_POST['memberId']; 
		$numOfItems = $_POST['numOfItems']; 
		
		//checking variable
		$validId = false;
		$validNum = false;
		
		if (!empty($memberId)) {
			if (!is_numeric($memberId)) {
				echo "<p>Member ID should contain digits (0 - 9) only</p>";
			}
			else {
				$validId = true;
			}
		}
		else {
			echo "<p>Please enter the Member's ID</p>";
		}
		
		if (!empty($numOfItems)) {
			if (!is_numeric($numOfItems)) {
				echo "<p>Number of Items should contain digits (0 - 9) only</p>";
			}
			else {
				$validNum = true;
			}
		}
		else {
			echo "<p>Please enter the Number of Items</p>";
		}
		
		//ensure that an id has been entered
		if ($validId && $validNum) {
			$query = "SELECT * FROM member WHERE memberId=".$memberId." AND status=1";
			$myData = mysqli_query($con, $query);
			
			if ($myData) {
				$row = mysqli_fetch_row($myData);
				if ($row > 0) {
					echo "<h4>Member ".$row[0]."'s Shopping Cart</h4>";
					echo "<form action='salesrecordadded.php' method='post'>";
					echo "<table>";
					echo "<tr>";
					echo "<th>No</th>";
					echo "<th>Product ID</th>";
					echo "<th>Qty</th>";
					echo "</tr>";
					for ($i = 0; $i < $numOfItems; $i++) {
						echo "<tr>";
						echo "<td>".($i + 1)."</td>";
						echo "<td><input name='productIds[]' type='text'></td>";
						echo "<td><input name='quantities[]' type='text'></td>";
						echo "</tr>";
					}
					echo "</table>";
					echo "<br/>";
					echo "<button type='submit'>Submit</button>";
					echo "<input type='hidden' name='memberId' value='".$memberId."'/>";
					echo "<input type='hidden' name='numOfItems' value='".$numOfItems."'/>";
					echo "</form>";
				}
				else {
					$query = "SELECT * FROM member WHERE memberId=".$memberId."";
					$myData = mysqli_query($con, $query);
					
					if ($myData) {
						$row = mysqli_fetch_row($myData);
						if ($row > 0) {
							echo "<h4>Member with ID ".$memberId." has been deactivated!</h4>";
						}
						else {
							echo "<h4>Member with ID ".$memberId." does not exist!</h4>";
						}
					}					
					
					echo "<p><a href='addsalesrecord.php'>Try Again</a></p>";
				}
			}
			else {
				echo "<h4>Failed to retrieve member!</h4>";
				echo '<p style="color:red;">Could not find member because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
				echo "<p><a href='addsalesrecord.php'>Try Again</a></p>";
			}
		}
		else {
			echo "<p><a href='addsalesrecord.php'>Try Again</a></p>";
		}
		
		echo "<p><a href='home.php'>Back to main menu</a></p>";
	}
	else {
		//title
		echo "<h4>Please enter the details below</h4>";
		
		//display the form
		echo "<form action='addsalesrecord.php' method='post'>";
		echo "<table>";
		echo "<tr>";
		echo "<td><label for='memberId'>Member ID:</label></td>";
		echo "<td><input id='memberId' name='memberId' type='text'></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><label for='numOfItems'>Number of Items:</label></td>";
		echo "<td><input id='numOfItems' name='numOfItems' type='text'></td>";
		echo "</tr>";
		echo "</table>";
		echo "<br/>";
		//submit button
		echo "<button type='submit'>Submit</button>";
		echo "<input type = 'hidden' name = 'submitted' value='true'/>";
		echo "</form>";
	}	
	
	//footer
	echo "</body>";
	echo "</html>";
	
	mysqli_close($con);
?>