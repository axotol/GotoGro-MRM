<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<!-- Site Title-->
		<title>
		<?php
			if (defined('TITLE')) {
				print TITLE;
			}
			else {
				print 'GotoGro-MRM';
			}
		?>
		</title>
		<link rel="stylesheet" href="stylesheet.css">
	</head>

	<body>
	
		<div class="navbar">
			<a href='home.php'>Home</a>
			<div class="dropdown">
				<button class="dropbtn">Member
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="addmember.php">Add new member</a>
					<a href="deactivatemember.php">Deactivate member</a>
					<a href="searchmember.php">Search for member</a>
					<a href="editmember.php">Edit existing member</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Sales Record
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="addsalesrecord.php">Add sales record</a>
					<a href="removesalesrecord.php">Remove sales record</a>
					<a href="searchsalesrecord.php">Search for sales record</a>
					<a href="updatesalesrecord.php">Update sales record</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Report
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="viewlogsandlevels.php">Purchase Logs and Product Levels</a>
					<a href="viewreport_daily.php">Daily</a>
					<a href="viewreport_weekly.php">Monthly</a>
					<a href="viewreport_monthly.php">Weekly</a>
				</div>
			</div>
		</div>