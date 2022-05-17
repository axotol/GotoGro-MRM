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
                	function compare($a, $b) {
                        return $b[2] - $a[2];
                    }
                    echo "<h1>Produce a Monthly Sales Report</h1>";
	
                    //check if form is submitted
                    if (isset($_POST['submitted'])) {
                        $date = $_POST['date'];
                        $month = date("m",strtotime($date));
                        $year = date("Y",strtotime($date));
                        
                        $csv = "no,product_id,product_name,amount_purchased,price_per_unit,total_revenue";
                        
                        $arr = array();
                        
                        $numOfItems = 0;
                        $totalRevenue = 0;
                        
                        $query = "SELECT * FROM product";
                        $myData = mysqli_query($con, $query);
                        
                        while ($rows = mysqli_fetch_array($myData)) {
                            $sum = 0;
                            $cost = 0;
                            $revenue = 0;
                            $profit = 0;
                            
                            $query2 = "SELECT * FROM salesrecord WHERE MONTH(date)=".$month." AND YEAR(date)=".$year." AND status=1";
                            $myData2 = mysqli_query($con, $query2);
                            
                            while ($rows2 = mysqli_fetch_array($myData2)) {
                                $query3 = "SELECT * FROM salesrecordline WHERE salesRecordId='".$rows2['salesRecordId']."' AND productId='".$rows['productId']."'";
                                $myData3 = mysqli_query($con, $query3);
                                $row = mysqli_fetch_row($myData3);
                                if ($row > 0) {
                                    $sum += $row['2'];
                                }
                            }
                            
                            if ($sum > 0) {
                                $revenue = $sum * $rows['price'];
                                
                                $numOfItems += $sum;
                                $totalRevenue += $revenue;
                                
                                array_push($arr, array($rows['productId'], $rows['name'], $sum, $rows['price'], $revenue));
                            }
                        }
                        
                        echo "<h4>Month Selected: ".date("F", mktime(0, 0, 0, $month, 10))." ".$year."</h4>";
                        
                        if (count($arr) > 0) {
                            usort($arr, "compare");
                            
                            echo "<table style='border: 1px solid; border-collapse: collapse;'>";
                            echo "<tr style='border: 1px solid;'>";
                            echo "<th style='border: 1px solid;'>No.</th>";
                            echo "<th style='border: 1px solid;'>Product ID</th>";
                            echo "<th style='border: 1px solid;'>Product Name</th>";
                            echo "<th style='border: 1px solid;'>Amount Purchased</th>";
                            echo "<th style='border: 1px solid;'>Price Per Unit ($)</th>";
                            echo "<th style='border: 1px solid;'>Total Revenue ($)</th>";
                            echo "</tr>";		
                            
                            for ($i = 0; $i < count($arr); $i++) {
                                echo "<tr style='border: 1px solid;'>";
                                echo "<td style='border: 1px solid;'>".($i + 1)."</td>";
                                echo "<td style='border: 1px solid;'>".$arr[$i][0]."</td>";
                                echo "<td style='border: 1px solid;'>".$arr[$i][1]."</td>";
                                echo "<td style='border: 1px solid; text-align: right;'>".$arr[$i][2]."</td>";
                                echo "<td style='border: 1px solid; text-align: right;'>".$arr[$i][3]."</td>";
                                echo "<td style='border: 1px solid; text-align: right;'>".number_format($arr[$i][4], 2)."</td>";
                                echo "</tr>";
                                
                                $csv .= "\n" . ($i + 1) . "," . $arr[$i][0] . "," . $arr[$i][1] . "," . $arr[$i][2] . "," . $arr[$i][3] . "," . number_format($arr[$i][4], 2);
                            }
                            
                            echo "<tr style='border: 1px solid;'>";
                            echo "<td colspan='5' style='border: 1px solid; background-color: #cccccc;'></td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".number_format($totalRevenue, 2)."</td>";
                            echo "</tr>";
                            
                            $csv .= "\n,,,,," . number_format($totalRevenue, 2);
                            
                            echo "</table>";
                            echo "<br/>";
                            
                            echo "<form action='downloadcsv.php' method='post'>";
                            echo "<button type='submit'>Download as CSV file</button>";
                            echo "<input type = 'hidden' name = 'csv' value='".$csv."'/>";
                            echo "</form>";
                            echo "<br/>";
                        }
                        else {
                            echo "<p>No items were sold in this month.</p>";
                        }
                        
                        echo "<a href='home.php'>Back to main menu</a>";
                    }
                    else {
                        //title
                        echo "<h4>Please select a month for the sales report</h4>";
                        
                        //display the form
                        echo "<form action='viewreport_monthly.php' method='post'>";
                        echo "<label for='date'>Date:</label>";
                        echo "<input id='date' name='date' type='month'>";
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