<?php
require_once 'php/connection.php';
global $con;

$id = $_GET['id'];
$sql = "DELETE FROM seller_property WHERE `seller_property`.`id`= '$id'";
$result = mysqli_query($con, $sql);
if($result){
    echo "<script>
        alert('Deleted Successfully');
        window.location = 'properties.php';
    </script>";
}
?>