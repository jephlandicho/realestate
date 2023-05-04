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



// lot
$sql = "SELECT COUNT(*) AS lot FROM seller_property WHERE type = 'Lot' AND seller_id = '$sellerID'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);
$lot = $row['lot'];
//end lot

//House and Lot
$sql = "SELECT COUNT(*) AS hL FROM seller_property WHERE type = 'House and Lot' AND seller_id = '$sellerID'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);
$hL = $row['hL'];
//end hl

//House
$sql = "SELECT COUNT(*) AS house FROM seller_property WHERE type = 'House' AND seller_id = '$sellerID'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);
$house = $row['house'];

 ?>