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
                	define('TITLE', 'Deactivate Member');

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
                
                mysqli_close($con)
                ?>
            </section>
        </div>
    </main>
</body>
</html>