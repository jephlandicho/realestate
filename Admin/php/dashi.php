<?php 
require_once 'php/connection.php';


// agent count
  $sql = "SELECT COUNT(*) AS agent_count FROM seller_login";
  $result = mysqli_query($con, $sql);

  if (!$result) {
      die("Error: " . mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($result);
  $agent_count = $row['agent_count'];
// end of agent count


// buyer count
  $sql = "SELECT COUNT(*) AS buyer_count FROM buyer_login";
  $result = mysqli_query($con, $sql);

  if (!$result) {
      die("Error: " . mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($result);
  $buyer_count = $row['buyer_count'];
// end of buyer count


// approved
  $sql = "SELECT COUNT(*) AS total_app FROM seller_property WHERE approved = 'Yes'";
  $result = mysqli_query($con, $sql);

  if (!$result) {
      die("Error: " . mysqli_error($con));
  }
  $row = mysqli_fetch_assoc($result);
  $total_app = $row['total_app'];
// end of approved

// not yet approved
  $sql = "SELECT COUNT(*) AS notyet FROM seller_property WHERE approved = 'No'";
  $result = mysqli_query($con, $sql);

  if (!$result) {
    die("Error: " . mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($result);
  $notyet = $row['notyet'];         
// end of not yet approved


// for sale
  $sql = "SELECT COUNT(*) AS forsale FROM seller_property WHERE status = 'For Sale'";

  $result = mysqli_query($con, $sql);

  if (!$result) {
      die("Error: " . mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($result);
  $forsale = $row['forsale'];
// end of for sale


// sold
$sql = "SELECT COUNT(*) AS sold FROM seller_property WHERE status = 'Sold'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);
$sold = $row['sold'];
// end of sold

 ?>