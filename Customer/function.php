<?php
function addtolist() {
    $conn = mysqli_connect("localhost","root","","realestate" ) or die ("error" . mysqli_error($conn));
    $property_id = $_POST['dataId'];
    $cust_ID = $_POST['cust_ID'];
    $currentDate = date('Y-m-d');
    $query = "INSERT INTO `saved_property` VALUES ('', '$property_id', '$cust_ID', '$currentDate')";
    $result = mysqli_query($conn,$query);
    if ($result) {
        echo "Success";
      } else {
        echo "Error";
      }
    }
?>