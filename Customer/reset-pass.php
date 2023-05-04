<?php

require_once 'php/query.php';

$user = new Admin();
$msg = '';

if(isset($_GET['email'])){
    $email = $user->test_input($_GET['email']);
        if(isset($_POST['facultyPassResetBtn'])){
            $newpass = $_POST['password'];
            $cnewpass = $_POST['cpassword'];

            if($newpass == $cnewpass){
                $pass = sha1($newpass);
                $user->update_password($pass,$email);
                $msg = 'Password changed successfully<a href="index.php"> Login Here </a>';
            }
            else{
                $msg = 'Password did not matched';
            }
        }

        
}
else{
    header('location:index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha512-znmTf4HNoF9U6mfB6KlhAShbRvbt4CvCaHoNV0gyssfToNQ/9A0eNdUbvsSwOIUoJdMjFG2ndSvr0Lo3ZpsTqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link href="assets/img/icon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <title>Reset Password</title>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center rounded" style="min-height: 100vh;">
        <form autocomplete="off" class="border shadow p-3 rounded" style="width: 450px;" id="faculty-login-form"
            method="post">
            <div id="loginAlert">
                <?php echo $msg; ?>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="../assets/img/favicon.png" alt="">
                        <span class="d-none d-lg-block"><span style="color: black;">Lupa</span>Bahay</span>
                    </a>
                </div><!-- End Logo -->
                <div id="adminLoginAlert"> </div>
                <h2 class="text-center">Reset Password</h2>
                <br>
                <center>
                    <br>
                    <div class="input-container">
                        <i style="font-size: 20px;" class="fa fa-key icon"></i>
                        <input
                            style="border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove; outline: none; width: 300px; font-size: 20px;"
                            type="password" name="password" class="input-container" id="password"
                            placeholder=" New Password" required minlength="8">
                    </div>
                    <br>
                    <div class="input-container">
                        <i style="font-size: 20px;" class="fa fa-solid fa-lock"></i>
                        <input
                            style="border-top-style: hidden; border-right-style: hidden; border-left-style: hidden; border-bottom-style: groove; outline: none; width: 300px; font-size: 20px;"
                            type="password" name="cpassword" class="input-container" id="cpassword"
                            placeholder="Confirm Password" required minlength="8">
                    </div>
                    <br>
                    <div class="form-group mb-3">
                        <input style="color:white; border-radius: 50px; width: 150px;" type="submit"
                            name="facultyPassResetBtn" class="btn btn-primary btn-lg" id="facultyPassResetBtn"
                            value="RESET">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"
        integrity="sha512-c4wThPPCMmu4xsVufJHokogA9X4ka58cy9cEYf5t147wSw0Zo43fwdTy/IC0k1oLxXcUlPvWZMnD8be61swW7g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"
        integrity="sha512-xd+EFQjacRjTkapQNqqRNk8M/7kaek9rFqYMsbpEhTLdzq/3mgXXRXaz1u5rnYFH5mQ9cEZQjGFHFdrJX2CilA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>