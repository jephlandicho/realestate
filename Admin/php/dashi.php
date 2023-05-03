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



//property prices 
// $sql = "SELECT seller_id, MAX(price) as price
//         FROM seller_property
//         WHERE status = 'Sold'";
// $result = mysqli_query($con, $sql);

// $row = mysqli_fetch_assoc($result);
// $price = $row['price'];
// $seller = $row['seller_id'];

// $quer = "SELECT username FROM seller_login WHERE id = $seller";
// $result = mysqli_query($con, $quer);

// $row = mysqli_fetch_assoc($result);
// $uname = $row['username'];

// $quer = "SELECT name FROM seller_login WHERE id = $seller";
// $result = mysqli_query($con, $quer);

// $row = mysqli_fetch_assoc($result);
// $name = $row['name'];
// //end

//seller name in










?>



