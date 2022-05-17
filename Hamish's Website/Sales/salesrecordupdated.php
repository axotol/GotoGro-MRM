<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../phpstuff/header.inc.php";
    	  require('../phpstuff/dbcon.php');
    ?>
    <title>	
        <?php if (defined('TITLE')) {print TITLE;}
		else {print 'GotoGro-MRM';}?>
    </title>
</head>
<body class="banner">
<?php    include "../phpstuff/menu.inc.php";?>
    <main class="nothome">
        <div class="text">
            <section class="content">
                <?php 
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
                mysqli_close($con)
                ?>
            </section>
        </div>
    </main>
</body>
</html>