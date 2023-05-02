<?php
    session_start();
    if(!isset($_SESSION['customer_username'])){
        header('location:index.php');
        exit();
    }
    include 'php/connection.php'; 
    global $con;
    
$info = $_SESSION['cus_info'];

$infomation = implode($info);

$cus_ID = $_SESSION['ID'];
$C_ID = implode($cus_ID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php
    $title = basename($_SERVER['PHP_SELF'],'.php');
    // $title = explode('-',$title);
    $title = ucfirst($title);
    ?>
    <title><?=$title ?> | Customer Panel</title>
    <title>Real Estate</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/icon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>


<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="Logo" width="75" height="75"></a>
    <a style="padding: 20px" class="navbar-brand text-brand" href="main.php">Real<span class="color-b">Estate</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="main.php"><i class="fa fa-home fa-lg"></i> Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="property-grid.php"> Property</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="contact.php"> Contact</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="list.php"> <i class="fa fa-list-alt fa-lg"></i> Saved Properties</a>
            </li>
        </ul>

        <ul class="navbar-nav mr-auto" style="margin-left: 200px;">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0 " href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        <?php echo $infomation ?>
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $infomation  ?></h6>
                        <span></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="profile.php">
                            <i class="bi bi-person"></i>&nbsp;&nbsp;<span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>&nbsp;&nbsp;
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="php/logout.php">
                            <i class="bi bi-box-arrow-right"></i>&nbsp;&nbsp;
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>



        <!-- <form class="form-inline">

            <a class="btn btn-default" href="php/logout.php"><i class="fa fa-user fa-lg"></i> Profile</a>
        </form> -->
    </div>
</nav>
<?php
        $verify = "SELECT verified FROM `buyer_login` WHERE id='$C_ID'";
        $result2 = mysqli_query($con, $verify);
        $rows = mysqli_fetch_assoc($result2);
        $verification = $rows["verified"];

        if ($verification == 0){
        echo '<div class="alert alert-warning fixed-top w-100" role="alert" style=" margin-top: 60px;">
        <strong>Verification Required:</strong> Please <a href="profile.php"> verify </a> your account to save/inquire property.
        </div>';
        }
    ?>