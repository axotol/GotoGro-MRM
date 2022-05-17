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
                	define('TITLE', 'View Purchase Logs & Product Levels');
                	echo "<h1>View Purchase Logs and Product Levels</h1>";
	
                    //check if form is submitted
                    if (isset($_POST['submitted'])) {
                        $date = $_POST['date'];
                        
                        echo "<table style='border: 1px solid; border-collapse: collapse;'>";
                        echo "<tr style='border: 1px solid;'>";
                        echo "<th style='border: 1px solid;'>Product ID</th>";
                        echo "<th style='border: 1px solid;'>Product Name</th>";
                        echo "<th style='border: 1px solid;'>Current Product Level</th>";
                        echo "<th style='border: 1px solid;'>Amount Purchased on ".$date."</th>";
                        echo "<th style='border: 1px solid;'>Amount Lost</th>";
                        echo "<th style='border: 1px solid;'>Cost Per Unit ($)</th>";
                        echo "<th style='border: 1px solid;'>Total Cost ($)</th>";
                        echo "<th style='border: 1px solid;'>Price Per Unit ($)</th>";
                        echo "<th style='border: 1px solid;'>Total Revenue ($)</th>";
                        echo "<th style='border: 1px solid;'>Total Profit ($)</th>";
                        echo "</tr>";
                        
                        $csv = "product_id,product_name,current_product_level,amount_purchased_on_".$date.",amount_lost,cost_per_unit,total_cost,price_per_unit,total_revenue,total_profit";
                        
                        $numOfItems = 0;
                        $totalCost = 0;
                        $totalRevenue = 0;
                        $totalProfit = 0;
                        
                        $query = "SELECT * FROM product";
                        $myData = mysqli_query($con, $query);
                        
                        while ($rows = mysqli_fetch_array($myData)) {
                            $sum = 0;
                            $cost = 0;
                            $revenue = 0;
                            $profit = 0;
                            $query2 = "SELECT * FROM salesrecord WHERE date='".$date."' AND status=1";
                            $myData2 = mysqli_query($con, $query2);
                            while ($rows2 = mysqli_fetch_array($myData2)) {
                                $query3 = "SELECT * FROM salesrecordline WHERE salesRecordId='".$rows2['salesRecordId']."' AND productId='".$rows['productId']."'";
                                $myData3 = mysqli_query($con, $query3);
                                $row = mysqli_fetch_row($myData3);
                                if ($row > 0) {
                                    $sum += $row['2'];
                                }
                            }
                            
                            $sum2 = 0;
                            
                            $query4 = "SELECT * FROM salesrecord WHERE date='".$date."' AND status=3";
                            $myData4 = mysqli_query($con, $query4);
                            while ($rows4 = mysqli_fetch_array($myData4)) {
                                $query5 = "SELECT * FROM salesrecordline WHERE salesRecordId='".$rows4['salesRecordId']."' AND productId='".$rows['productId']."'";
                                $myData5 = mysqli_query($con, $query5);
                                $row = mysqli_fetch_row($myData5);
                                if ($row > 0) {
                                    $sum2 += $row['2'];
                                }
                            }
                            
                            $cost = ($sum + $sum2) * $rows['cost'];
                            $revenue = $sum * $rows['price'];
                            $profit = $revenue - $cost;
                        
                            echo "<tr style='border: 1px solid;'>";
                            echo "<td style='border: 1px solid;'>".$rows['productId']."</td>";
                            echo "<td style='border: 1px solid;'>".$rows['name']."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".$rows['qty']."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".$sum."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".$sum2."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".$rows['cost']."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".number_format($cost, 2)."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".$rows['price']."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".number_format($revenue, 2)."</td>";
                            echo "<td style='border: 1px solid; text-align: right;'>".number_format($profit, 2)."</td>";
                            echo "</tr>";
                            
                            $csv .= "\n" . $rows['productId'] . "," . $rows['name'] . "," . $rows['qty'] . "," . $sum . "," . $sum2 . "," . $rows['cost'] . "," . number_format($cost, 2) . "," . $rows['price'] . "," . number_format($revenue, 2) . "," . number_format($profit, 2);
                            
                            $numOfItems += $sum;
                            $totalCost += $cost;
                            $totalRevenue += $revenue;
                            $totalProfit += $profit;
                        }
                        
                        echo "<tr style='border: 1px solid;'>";
                        echo "<td colspan='6' style='border: 1px solid; background-color: #cccccc;'></td>";
                        echo "<td style='border: 1px solid; text-align: right;'>".number_format($totalCost, 2)."</td>";
                        echo "<td style='border: 1px solid; background-color: #cccccc;'></td>";
                        echo "<td style='border: 1px solid; text-align: right;'>".number_format($totalRevenue, 2)."</td>";
                        echo "<td style='border: 1px solid; text-align: right;'>".number_format($totalProfit, 2)."</td>";
                        echo "</tr>";
                        
                        $csv .= "\n,,,,,," . number_format($totalCost, 2) . ",," . number_format($totalRevenue, 2) . "," . number_format($totalProfit, 2);
                        
                        echo "</table>";
                        echo "<br/>";
                        
                        echo "<form action='downloadcsv.php' method='post'>";
                        echo "<button type='submit'>Download as CSV file</button>";
                        echo "<input type = 'hidden' name = 'csv' value='".$csv."'/>";
                        echo "<input type = 'hidden' name = 'date' value='".$date."'/>";
                        echo "</form>";
                        
                        echo "<br/>";
                        echo "<a href='home.php'>Back to main menu</a>";
                    }
                    else {
                        //title
                        echo "<h4>Please select a date to view the records</h4>";
                        
                        //display the form
                        echo "<form action='viewlogsandlevels.php' method='post'>";
                        echo "<label for='date'>Date:</label>";
                        echo "<input id='date' name='date' type='date'>";
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