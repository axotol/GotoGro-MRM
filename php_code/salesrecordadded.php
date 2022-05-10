<?php
	define('TITLE', 'Add Sales Record');
	//header
	require('header.php');
	require('dbcon.php');

	//body
	echo "<h1>Add a Sales Record</h1>";
	
	//check if form is submitted
	if (isset($_POST['submitted'])) {
		//info needed for sales record creation
		$memberId = $_POST['memberId'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		
		//info needed for sales record line creation
		$productIds = $_POST['productIds'];
		$quantities = $_POST['quantities'];
		
		//for looping purposes
		$numOfItems = $_POST['numOfItems'];
		
		$query = "INSERT INTO salesrecord (memberId, date, time, status) 
				  VALUES ('".$memberId."', '".$date."', '".$time."', '1')";
		$myData = mysqli_query($con, $query);
		
		if ($myData) {		
			$query = "SELECT * FROM salesrecord ORDER BY salesRecordId DESC LIMIT 1"; 
			$myData = mysqli_query($con, $query);
			$row = mysqli_fetch_row($myData);
			if ($row > 0) {
				$salesRecordId = $row[0];
			}
			
			echo "<h4>Sales Record of ID ".$salesRecordId." was successfully added!</h4>";
			
			for ($i = 0; $i < $numOfItems; $i++) {
				$query = "INSERT INTO salesrecordline (salesRecordId, productId, qty) 
						  VALUES ('".$salesRecordId."', '".$productIds[$i]."', '".$quantities[$i]."')";
				$myData = mysqli_query($con, $query);

				if ($myData) {
					$query = "UPDATE product SET qty=qty-".$quantities[$i]." WHERE productId=".$productIds[$i]."";
					mysqli_query($con, $query);
					
					echo "<p>Product of ID ".$productIds[$i]." was successfully added!</p>";
				}
				else {
					echo "<p>Product of ID ".$productIds[$i]." could not be added because:<br/>".mysqli_error($con).". The query was: ".$query.".</p>";
				}
			}
			
			echo "<p><a href='home.php'>Back to Main Menu</a></p>";
		}
		else {
			echo "<h4>Failed to add sales record!</h4>";
			echo '<p style="color:red;">Could not add because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
			echo "<p><a href='addsalesrecord.php'>Try Again</a></p>";
		}
	}
	else {
		//info needed for sales record creation
		$memberId = $_POST['memberId'];
		$date = date("Y-m-d");
		$time = date("H:i:s");
		
		//info needed for sales record line creation
		$productIds = $_POST['productIds'];
		$quantities = $_POST['quantities'];
		
		//for looping purposes
		$numOfItems = $_POST['numOfItems'];
		$totalPrice = 0.0;
		$success = true;
	
		echo "<form action='salesrecordadded.php' method='post'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>Member ID:</td>";
		echo "<td>".$memberId."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Date:</td>";
		echo "<td>".$date."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Time:</td>";
		echo "<td>".$time."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Shopping Cart:</td>";
		echo "<td></td>";
		echo "</tr>";
		echo "</table>";
		echo "<table style='border: 1px solid; border-collapse: collapse;'>";
		echo "<tr style='border: 1px solid;'>";
		echo "<th style='border: 1px solid;'>No</th>";
		echo "<th style='border: 1px solid;'>Product Name</th>";
		echo "<th style='border: 1px solid;'>Qty</th>";
		echo "<th style='border: 1px solid;'>Price per Unit ($)</th>";
		echo "<th style='border: 1px solid;'>Total Price ($)</th>";
		echo "</tr>";
		for ($i = 0; $i < $numOfItems; $i++) {
			$query = "SELECT * FROM product WHERE productId=".$productIds[$i]."";
			$myData = mysqli_query($con, $query);

			if ($myData) {
				$row = mysqli_fetch_row($myData);
				if ($row > 0) {
					echo "<tr style='border: 1px solid;'>";
					echo "<td style='border: 1px solid;'>".($i + 1)."</td>";
					echo "<td style='border: 1px solid;'>".$row[1]."</td>";
					echo "<td style='border: 1px solid; text-align: right'>".$quantities[$i]."</td>";
					echo "<td style='border: 1px solid; text-align: right'>".$row[3]."</td>";
					echo "<td style='border: 1px solid; text-align: right'>".number_format($quantities[$i] * $row[3], 2)."</td>";
					echo "</tr>";
					echo "<input type='hidden' name='productIds[]' value='".$productIds[$i]."'/>";
					echo "<input type='hidden' name='quantities[]' value='".$quantities[$i]."'/>";
					$totalPrice += $quantities[$i] * $row[3];
				}
				else {
					$success = false;
					echo "<tr>";
					echo "<td colspan='5'>Failed to retrieve product!";
					echo '<p style="color:red;">Could not retrieve because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</td>';
					echo "</tr>";
				}
			}
			else {
				$success = false;
				echo "<h4>Failed to retrieve product!</h4>";
				echo '<p style="color:red;">Could not retrieve because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
				break;
			}
		}
		echo "<tr style='border: 1px solid;'>";
		echo "<td colspan='4' style='border: 1px solid;'>Total</td>";
		echo "<td style='border: 1px solid; text-align: right'>".number_format($totalPrice, 2)."</td>";
		echo "</tr>";
		echo "</table>";
		if ($success) {
			echo "<br/>";
			echo "<button type='submit'>Complete Transaction</button>";
			echo "<input type = 'hidden' name = 'submitted' value='true'/>";
			echo "<input type = 'hidden' name = 'memberId' value='".$memberId."'/>";
			echo "<input type = 'hidden' name = 'date' value='".$date."'/>";
			echo "<input type = 'hidden' name = 'time' value='".$time."'/>";
			echo "<input type = 'hidden' name = 'numOfItems' value='".$numOfItems."'/>";
			echo "</form>";
			echo "<br/>";
			echo "<a href='home.php'>Cancel Transaction</a>";
		}
		else {
			echo "</form>";
			echo "<p><a href='addsalesrecord.php'>Try Again</a></p>";
			echo "<p><a href='home.php'>Back to main menu</a></p>";
		}
	}
	
	//footer
	echo "</body>";
	echo "</html>";
	
	mysqli_close($con);
?>