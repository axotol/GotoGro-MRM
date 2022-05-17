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
                	echo "<h1>Sales Record Removed</h1>";
	
                    $recordId = $_POST['recordId']; 
                    $comments = $_POST['comments']; 
                    
                    if (empty($comments)) {
                        $comments = "No reason given.";
                    }
                    
                    if (isset($_POST['returned'])) {
                        $status = '2'; // items are returned
                    }
                    else {
                        $status = '3'; // items are not returned to inventory (either kept by member or item is defective)
                    }
                    
                    $query = "UPDATE salesrecord SET status='".$status."', comments='".$comments."' WHERE salesRecordId=".$recordId."";
                    $myData = mysqli_query($con, $query);
                        
                    if ($myData) {
                        echo "<h4>Sales Record with ID ".$recordId." has been successfully removed from view!</h4>";
                        
                        if (isset($_POST['returned'])) {
                            $query2 = "SELECT * FROM salesrecordline WHERE salesRecordId=".$recordId."";
                            $myData2 = mysqli_query($con, $query2);
                            while ($rows2 = mysqli_fetch_array($myData2)) {
                                $query3 = "SELECT * FROM product WHERE productId=".$rows2[1]."";
                                $myData3 = mysqli_query($con, $query3);
                                
                                if ($myData3) {
                                    $row3 = mysqli_fetch_row($myData3);
                                    if ($row3 > 0) {
                                        $query4 = "UPDATE product SET qty=qty+".$rows2[2]." WHERE productId=".$rows2[1]."";
                                        $myData4 = mysqli_query($con, $query4);
                                        
                                        if ($myData4) {
                                            echo "<p>The quantity of Product with ID ".$rows2[1]." has been increased by ".$rows2[2]."!</p>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else {
                        echo "<h4>Failed to remove sales record from view!</h4>";
                        echo '<p style="color:red;">Could not remove because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
                        echo "<p><a href='removesalesrecord.php'>Try Again</a></p>";
                    }
                
                mysqli_close($con)
                ?>
            </section>
        </div>
    </main>
</body>
</html>