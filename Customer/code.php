<?php
require_once 'php/connection.php';
global $con;

$email = $_GET['email']; 
$sql2 = "SELECT code FROM buyer_login WHERE email = '$email'";
$result1 = $con->query($sql2);
$row = $result1->fetch_assoc();
$sqlcode = $row['code'];

if(isset($_POST['btnresetcode'])) { // check if the form was submitted
$code = $_POST['code']; // retrieve the value of the "code" input field

if($sqlcode == $code) {
$sql3 = "UPDATE buyer_login SET verified = '1' WHERE email = '$email'";
$result2 = mysqli_query($con, $sql3);
if($result2){
echo "<script>
alert('Email is verified!');
window.location = 'profile.php';
</script>";
}
else{
echo 'Wrong query';
}
}
else{
echo "<script>
alert('Code did not matched!');
window.location = 'profile.php';
</script>";
}
}
?>