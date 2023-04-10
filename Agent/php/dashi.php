<?php 

$seller = $_SESSION['ID'];
$sellerID = implode($seller);

// approved
  $sql = "SELECT COUNT(*) AS posted FROM seller_property WHERE approved = 'Yes' AND seller_id = '$sellerID'";
  $result = mysqli_query($con, $sql);

  if (!$result) {
      die("Error: " . mysqli_error($con));
  }
  $row = mysqli_fetch_assoc($result);
  $posted = $row['posted'];
// end of approved


//not yet
  $sql = "SELECT COUNT(*) AS notyet FROM seller_property WHERE approved = 'No' AND seller_id = '$sellerID'";
  $result = mysqli_query($con, $sql);

  if (!$result) {
    die("Error: " . mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($result);
  $notyet = $row['notyet'];
// end of not yet
 ?>