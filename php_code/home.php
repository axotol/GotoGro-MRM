<?php
	//header
	require('header.php');
?>
	<h1>Welcome to GotoGro-MRM!</h1>
	<h2>Please select one of the following options</h2>
	<ol>
		<li>
			Member-related functions
			<ol>
				<li><a href='addmember.php'>Add a new member</a></li>
				<li><a href='deactivatemember.php'>Deactivate member</a></li>
				<li><a href='searchmember.php'>Search for member</a></li>
				<li><a href='editmember.php'>Edit existing member</a></li>
			</ol>
		</li>
		<br/>
		<li>
			Sales-related functions
			<ol>
				<li><a href='addsalesrecord.php'>Add a sales record</a></li>
				<li><a href='wip.php'>Remove sales record</a></li>
				<li><a href='wip.php'>Search for sales record</a></li>
				<li><a href='wip.php'>Update sales record</a></li>
			</ol>
		</li>
		<br/>
		<li><a href='viewlogsandlevels.php'>View Purchase Logs and Product Levels</a></li>
		<br/>
		<li>
			Sales Report Generation
			<ol>
				<li><a href='viewreport_daily.php'>Produce a daily sales report</a></li>
				<li><a href='viewreport_weekly.php'>Produce a weekly sales report</a></li>
				<li><a href='viewreport_monthly.php'>Produce a monthly sales report</a></li>
			</ol>
		</li>
	</ol>
	</body>
</html>