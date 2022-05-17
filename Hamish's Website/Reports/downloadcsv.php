<?php
	$csv = $_POST['csv'];
	
	$filename = "report.csv";
	header("Content-Type: text/plain");
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header("Content-Length: " . strlen($csv));
	echo $csv;
?>