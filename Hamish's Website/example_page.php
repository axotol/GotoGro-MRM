<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include "../phpstuff/header.inc.php";
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
                
                //Put the stuff here^^
                mysqli_close($con)
                ?>
            </section>
        </div>
    </main>
</body>
</html>