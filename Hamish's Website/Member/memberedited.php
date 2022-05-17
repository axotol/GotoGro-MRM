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
                	define('TITLE', 'Edit Member');

                    echo "<h1>Edit Existing Member</h1>";
                    echo "<form>";
                    
                    //store the variables
                    $memberId = $_POST['memberId'];
                    $name = $_POST['name']; 
                    $phoneNum = $_POST['phoneNum'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    
                    //checking variables
                    $validName = false; 
                    $validPhoneNum = false; 
                    $validEmail = false;
                    $validAddress = false;
                    
                    //name validation
                    if (!empty($name)) {
                        if (preg_match("/^[a-zA-Z ]*$/", $name)) {
                            $validName = true;
                        }
                        else {
                            echo "<p>Name must only contain letters and white spaces.</p>";
                        }
                    }
                    else {
                        echo "<p>Please enter the member's Name</p>";
                    }
                    
                    //phone number validation
                    if (!empty($phoneNum)) {
                        if (!is_numeric($phoneNum)) {
                            echo "<p>Phone Number should contain digits (0 - 9) only</p>";
                        } elseif (strlen($phoneNum) != 10) {
                            echo "<p>Phone Number should have exactly 10 digits</p>";
                        }
                        else {
                            $validPhoneNum = true;
                        }
                    }
                    else {
                        echo "<p>Please enter the member's Phone Number</p>";
                    }
                    
                    //email validation
                    if (!empty($email)) {
                        if (preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/", $email)) {
                            $validEmail = true;
                        }
                        else {
                            echo "<p>Invalid Email format.</p>";
                        }
                    }
                    else {
                        echo "<p>Please enter the member's Email</p>";
                    }
                    
                    //address validation
                    if (!empty($address)) {
                        $validAddress = true;
                    }
                    else {
                        echo "<p>Please enter the member's Address</p>";
                    }
                    
                    if ($validName && $validPhoneNum && $validEmail && $validAddress) {
                        $query = "UPDATE member
                                      SET name='".$name."', phoneNum='".$phoneNum."', email='".$email."', address='".$address."'
                                      WHERE memberId=".$memberId."";
                        $myData = mysqli_query($con, $query);
                        
                        if ($myData) {
                            echo "<h4>Member successfully edited!</h4>";
                            echo "<p><a href='editmember.php'>Edit another member</a></p>";
                        }
                        else {
                            echo "<h4>Failed to edit member!</h4>";
                            echo '<p style="color:red;">Could not edit because:<br/>'.mysqli_error($con).'.The query was:' . $query . '.</p>';
                            echo "<p><a href='editmember.php'>Try Again</a></p>";
                        }
                    }
                    else {
                        echo "<p><a href='editmember.php'>Try Again</a></p>";
                    }
                    
                    echo "<p><a href='home.php'>Back to main menu</a></p>";
                    echo "</form>";
                
                mysqli_close($con)
                ?>
            </section>
        </div>
    </main>
</body>
</html>