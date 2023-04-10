<?php
    require_once 'php/connection.php';
    global $con;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "UPDATE notifications SET status = 'Read' WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: approval.php");
    }
    else{
        header("Location: dashboard.php");
    }
  } else {
    echo "ID parameter is missing.";
  }
  
?>