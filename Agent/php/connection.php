<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "realestate";
    $con = mysqli_connect($server,$username,$password,$dbname);
    if(!$con)
    {
        die('Cannot connect'.mysqli_error($con));
    }

?>