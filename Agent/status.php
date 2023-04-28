<?php
require_once 'php/connection.php';
global $con;

$id = $_GET['id'];
$sql = "UPDATE `seller_property` SET `status` = 'Sold' WHERE `seller_property`.`id` = '$id'";
$result = mysqli_query($con, $sql);

if($result){
    echo "<script>
        window.location = 'properties.php';
    </script>";
}
else{
    echo "<script>
        window.location = 'dashboard.php';
    </script>";
}
?>