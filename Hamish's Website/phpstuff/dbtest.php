<!DOCTYPE html>
<html lang="en">
    <?php    include "header.inc.php";?>
<body class="banner">
    <h1>Data Base Test Page</h1>
    <?php
    $host = "feenix-mariadb.swin.edu.au";
    $user = "s103607352";
    $pwd = "110102";
    $sql_db = "s103607352_db";

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if(!$conn){
        echo "<p>Database connection failure</p>";
    }
    else{
        $sql_table="orders";

        $namef = $_POST["name1"];
        $namel = $_POST["name2"];

        $query = $namef + $namel;

        $result = mysqli_query($conn, $query);

        if(!$result){
            echo "<p>Something is wrong with ", $query, "</p>";
        }
        else{
            echo "<table border=\"1\">\n";
            echo "<tr>\n "
                ."<th scope=\"col\">First Name</th>\n "
                ."<th scope=\"col\">Last Name</th>\n "
                ."</tr>\n ";

            while ($row = mysqli_fetch_assoc($result)){
                echo "<tr>\n ";
                echo "<td>", $row["name1"], "</td>\n ";
                echo "<td>", $row["name2"], "</td>\n ";
                echo "</tr>\n ";
            }
            echo "</table>\n";

            mysqli_free_result($result);
        }

        mysqli_close($conn);
    }
    /*  
    $sql_tableCreate = "CREATE TABLE orders (
first_name VARCHAR(10) NOT NULL,
second_name VARCHAR(10) NOT NULL,
email VARCHAR(30) NOT NULL,
street VARCHAR(40) NOT NULL,
suburb VARCHAR(40) NOT NULL,
statte VARCHAR(30) NOT NULL,
pstcode INT(4) NOT NULL,
phone INT(10) NOT NULL,
prefered_contact VARCHAR(30) NOT NULL,
selected_room VARCHAR(30) NOT NULL,
timespent VARCHAR(30) NOT NULL,
ppattending INT(2) NOT NULL,
category VARCHAR(30),
com VARCHAR(200),
cardtype VARCHAR(30) NOT NULL,
crdname VARCHAR(30) NOT NULL,
crdnumber INT(16) NOT NULL,
crdexpire VARCHAR(5) NOT NULL,
crdccv INT(3) NOT NULL);, */
?>
</body>
</html>