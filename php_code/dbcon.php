<?php 
    //preset variable
    $host="localhost";
    $user="root";
    $password="";
    $dbname="gotogro_mrm";

    //connect to database
    $con=new mysqli($host,$user,$password,$dbname)
    or die ('Could not cannot to the database server'.mysqli_connect_error());
?>