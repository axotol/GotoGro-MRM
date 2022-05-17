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

                echo "<h1>Deactivate Member</h1>";
                
                //check if form is submitted
                if (isset($_POST['submitted'])) {
                    echo "<form>";
                    
                    //store the variable
                    $memberId = $_POST['memberId']; 
                    
                    //checking variable
                    $validId = false;
                    
                    if (!empty($memberId)) {
                        if (!is_numeric($memberId)) {
                            echo "<p>Member ID should contain digits (0 - 9) only</p>";
                            echo "<p><a href='deactivatemember.php'>Try Again</a></p>";
                        }
                        else {
                            $validId = true;
                        }
                    }
                    else {
                        echo "<p>Please enter the Member's ID</p>";
                        echo "<p><a href='deactivatemember.php'>Try Again</a></p>";
                    }
                    
                    //ensure that an id has been entered
                    if ($validId) {
                        $query = "SELECT * FROM member WHERE memberId=".$memberId."";
                        $myData = mysqli_query($con, $query);
                        
                        if ($myData) {
                            $row = mysqli_fetch_row($myData);
                            if ($row > 0) {
                                echo "<h4>The member's details are as follows</h4>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<td>Member ID:</td>";
                                echo "<td>".$row[0]."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Name:</td>";
                                echo "<td>".$row[1]."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Phone Number:</td>";
                                echo "<td>".$row[2]."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Email:</td>";
                                echo "<td>".$row[3]."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Address:</td>";
                                echo "<td>".$row[4]."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Status:</td>";
                                if ($row[5] == '1') {
                                    echo "<td>Active</td>";
                                }
                                else {
                                    echo "<td>Inactive</td>";
                                }
                                echo "</tr>";
                                echo "</table>";
                                if ($row[5] == '1') {
                                    echo "<br/>";
                                    echo "<a href='memberdeactivated.php?memberId=".$memberId."'>Deactivate Member</a>";
                                }
                                else {
                                    echo "<p>Member is already inactive!</p>";
                                }
                            }
                            else {
                                echo "<h4>Member with ID ".$memberId." does not exist!</h4>";
                                echo "<p><a href='deactivatemember.php'>Try Again</a></p>";
                            }
                        }
                        else {
                            echo "<h4>Failed to retrieve member!</h4>";
                            echo '<p style="color:red;">Could not find member because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
                            echo "<p><a href='deactivatemember.php'>Try Again</a></p>";
                        }
                    }
                    
                    echo "<p><a href='home.php'>Back to main menu</a></p>";
                    echo "</form>";
                }
                else {
                    //title
                    echo "<h4>Please enter the Member's ID below</h4>";
                    
                    //display the form
                    echo "<form action='deactivatemember.php' method='post'>";
                    echo "<label for='memberId'>Member ID:</label></td>";
                    echo "<input id='memberId' name='memberId' type='text'></td>";
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