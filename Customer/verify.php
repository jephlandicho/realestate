<?php
require_once 'php/connection.php';
global $con;

$email = $_GET['email']; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);

$code = rand(999999, 111111);
$code = str_shuffle($code);

try{
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'landichojehosaphat@gmail.com';
$mail->Password = 'vgilenumidpjorop';

$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('landichojehosaphat@gmail.com','Real Estate');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Verify Email';
$mail->Body = '<h3> Enter the code below to verify you email <br> Code:&nbsp; '.$code.' <br> Regards <br> Real Estate </h3>';
$mail->send();
// echo $admin->showMessage('We have send you the code to verify your email, please check your email <a
//     href="reset-code.php?email='.$email.'"> Enter Code here </a>');

$sql = "UPDATE buyer_login SET code = '$code' WHERE email = '$email'";
$result = mysqli_query($con, $sql);
}
catch(Exception $e){
    echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha512-znmTf4HNoF9U6mfB6KlhAShbRvbt4CvCaHoNV0gyssfToNQ/9A0eNdUbvsSwOIUoJdMjFG2ndSvr0Lo3ZpsTqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/img/icon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <title>Verify Email</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center rounded" style="min-height: 100vh;">
        <form action="code.php?email=<?= $email?>" autocomplete="off" class="border shadow p-3 rounded"
            style="width: 450px;" id="verify_form" method="post">
            <div class="mb-3">
                <br>
                <h2 class="text-center">Enter the Code</h2>
                <br>
                <center>
                    <br>
                    <h5>
                        Please check your email to get the code
                    </h5>
                    <div class="input-container">

                        <input
                            style="border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove; outline: none; width: 300px; font-size: 20px;"
                            type="number" name="code" class="input-container" id="code" placeholder="Enter the Code"
                            required>
                    </div>
                    <br>
                    <br>
                    <div class="form-group mb-3">
                        <input style="color:black; border-radius: 50px; width: 150px;" type="submit" name="btnresetcode"
                            class="btn btn-info btn-lg" id="btn_verify" value="Verify">
                    </div>
                </center>
        </form>

    </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"
        integrity="sha512-c4wThPPCMmu4xsVufJHokogA9X4ka58cy9cEYf5t147wSw0Zo43fwdTy/IC0k1oLxXcUlPvWZMnD8be61swW7g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>