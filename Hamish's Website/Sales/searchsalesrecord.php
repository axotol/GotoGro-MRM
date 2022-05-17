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
                echo "<h1>Search for Sales Record</h1>";
	
                //check if form is submitted
                if (isset($_POST['submitted'])) {
                    echo "<form>";
                    
                    //store the variable
                    $recordId = $_POST['recordId']; 
                    
                    //checking variable
                    $validId = false;
                    
                    if (!empty($recordId)) {
                        if (!is_numeric($recordId)) {
                            echo "<p>Record ID should contain digits (0 - 9) only</p>";
                            echo "<p><a href='searchsalesrecord.php'>Try Again</a></p>";
                        }
                        else {
                            $validId = true;
                        }
                    }
                    else {
                        echo "<p>Please enter the Sales Record's ID</p>";
                        echo "<p><a href='searchsalesrecord.php'>Try Again</a></p>";
                    }
                    
                    //ensure that an id has been entered
                    if ($validId) {
                        $query = "SELECT * FROM salesrecord WHERE salesRecordId=".$recordId."";
                        $myData = mysqli_query($con, $query);
                        
                        if ($myData) {
                            $row = mysqli_fetch_row($myData);
                            if ($row > 0) {
                                echo "<h4>The details of Sales Record with ID ".$recordId." are as follows</h4>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<td>Member ID:</td>";
                                echo "<td>".$row[1]."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Date:</td>";
                                echo "<td>".$row[2]."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Time:</td>";
                                echo "<td>".$row[3]."</td>";
                                echo "</tr>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Status:</td>";
                                if ($row[4] == '1') {
                                    echo "<td>Active</td>";
                                }
                                else {
                                    echo "<td>Inactive</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>Comments:</td>";
                                    echo "<td>".$row[5]."</td>";
                                }
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
                                
                                $i = 1;
                                $totalPrice = 0;
                                $query2 = "SELECT * FROM salesrecordline WHERE salesRecordId=".$recordId."";
                                $myData2 = mysqli_query($con, $query2);
                                while ($rows2 = mysqli_fetch_array($myData2)) {
                                    $query3 = "SELECT * FROM product WHERE productId=".$rows2[1]."";
                                    $myData3 = mysqli_query($con, $query3);
                                    
                                    if ($myData3) {
                                        $row3 = mysqli_fetch_row($myData3);
                                        if ($row3 > 0) {
                                            echo "<tr style='border: 1px solid;'>";
                                            echo "<td style='border: 1px solid;'>".$i."</td>";
                                            echo "<td style='border: 1px solid;'>".$row3[1]."</td>";
                                            echo "<td style='border: 1px solid; text-align: right'>".$rows2[2]."</td>";
                                            echo "<td style='border: 1px solid; text-align: right'>".$row3[3]."</td>";
                                            echo "<td style='border: 1px solid; text-align: right'>".number_format($rows2[2] * $row3[3], 2)."</td>";
                                            echo "</tr>";
                                            $i++;
                                            $totalPrice += $rows2[2] * $row3[3];
                                        }
                                    }
                                }
                                
                                echo "<tr style='border: 1px solid;'>";
                                echo "<td colspan='4' style='border: 1px solid;'>Total</td>";
                                echo "<td style='border: 1px solid; text-align: right'>".number_format($totalPrice, 2)."</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<p><a href='searchsalesrecord.php'>Search for another sales record</a></p>";
                            }
                            else {
                                echo "<h4>Sales Record with ID ".$recordId." does not exist!</h4>";
                                echo "<p><a href='searchsalesrecord.php'>Try Again</a></p>";
                            }
                        }
                        else {
                            echo "<h4>Failed to retrieve sales record!</h4>";
                            echo '<p style="color:red;">Could not find sales record because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
                            echo "<p><a href='searchsalesrecord.php'>Try Again</a></p>";
                        }
                    }
                    
                    echo "<p><a href='home.php'>Back to main menu</a></p>";
                    echo "</form>";
                }
                else {
                    //title
                    echo "<h4>Please enter the Sales Record's ID below</h4>";
                    
                    //display the form
                    echo "<form action='searchsalesrecord.php' method='post'>";
                    echo "<label for='recordId'>Sales Record ID:</label></td>";
                    echo "<input id='recordId' name='recordId' type='text'></td>";
                    echo "<br/>";
                    echo "<br/>";
                    //submit button
                    echo "<button type='submit'>Submit</button>";
                    echo "<input type = 'hidden' name = 'submitted' value='true'/>";
                    echo "</form>";
                }
                mysqli_close($con)
                ?>
            </section>
        </div>
    </main>
</body>
</html>