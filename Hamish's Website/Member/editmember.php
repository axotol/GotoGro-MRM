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
                	echo "<h1>Edit Existing Member</h1>";
	
                    //check if form is submitted
                    if (isset($_POST['submitted'])) {
                        //store the variable
                        $memberId = $_POST['memberId']; 
                        
                        //checking variable
                        $validId = false;
                        
                        if (!empty($memberId)) {
                            if (!is_numeric($memberId)) {
                                echo "<p>Member ID should contain digits (0 - 9) only</p>";
                                echo "<p><a href='editmember.php'>Try Again</a></p>";
                            }
                            else {
                                $validId = true;
                            }
                        }
                        else {
                            echo "<p>Please enter the Member's ID</p>";
                            echo "<p><a href='editmember.php'>Try Again</a></p>";
                        }
                        
                        //ensure that an id has been entered
                        if ($validId) {
                            $query = "SELECT * FROM member WHERE memberId=".$memberId."";
                            $myData = mysqli_query($con, $query);
                            
                            if ($myData) {
                                $row = mysqli_fetch_row($myData);
                                if ($row > 0) {
                                    //title
                                    echo "<h4>Please enter the member's new details below</h4>";
                                    
                                    //display the form
                                    echo "<form action='memberedited.php' method='post' id='editform'>";
                                    echo "<table>";
                                    echo "<tr>";
                                    echo "<td><label for='name'>Name:</label></td>";
                                    echo "<td><input id='name' name='name' type='text' value='".$row[1]."'></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td><label for='phoneNum'>Phone Number:</label></td>";
                                    echo "<td><input id='phoneNum' name='phoneNum' type='text' value='".$row[2]."'></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td><label for='email'>Email:</label></td>";
                                    echo "<td><input id='email' name='email' type='text' value='".$row[3]."'></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td><label for='address'>Address:</label></td>";
                                    echo "<td><input id='address' name='address' type='text' value='".$row[4]."'></td>";
                                    echo "</tr>";
                                    echo "</table>";
                                    echo "<br/>";
                                    //submit button
                                    echo "<button type='submit' form='editform'>Submit</button>";
                                    echo "<input type = 'hidden' name = 'memberId' value='".$memberId."'/>";
                                    echo "</form>";
                                }
                                else {
                                    echo "<h4>Member with ID ".$memberId." does not exist!</h4>";
                                    echo "<p><a href='editmember.php'>Try Again</a></p>";
                                }
                            }
                            else {
                                echo "<h4>Failed to retrieve member!</h4>";
                                echo '<p style="color:red;">Could not find member because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
                                echo "<p><a href='editmember.php'>Try Again</a></p>";
                            }
                        }
                        
                        echo "<p><a href='home.php'>Back to main menu</a></p>";
                    }
                    else {
                        //title
                        echo "<h4>Please enter the Member's ID below</h4>";
                        
                        //display the form
                        echo "<form action='editmember.php' method='post' id='searchform'>";
                        echo "<label for='memberId'>Member ID:</label></td>";
                        echo "<input id='memberId' name='memberId' type='text'></td>";
                        echo "<br/>";
                        echo "<br/>";
                        //submit button
                        echo "<button type='submit' form='searchform'>Submit</button>";
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