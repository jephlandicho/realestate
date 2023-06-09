<?php
    session_start();
    if(!isset($_SESSION['seller_username'])){
        header('location:index.php');
        exit();
    }
    include 'php/connection.php'; 
    global $con;
 $info = $_SESSION['seller_info'];

 $infomation = implode($info);
 $user = $_SESSION['seller_username'];
    $id = $_SESSION['ID'];
    $agent_id = implode($id);

    $count = "SELECT COUNT(*) as total_rows FROM notifications WHERE `user_type` = 'Agent' AND `user_target` = '$agent_id' AND `status` = 'Unread'";
    $result = mysqli_query($con, $count);
    $row = mysqli_fetch_assoc($result);
    $total_notif = $row["total_rows"];
   
    $sql = "SELECT * FROM notifications WHERE `user_type` = 'Agent' AND `user_target` = '$agent_id' AND `status` = 'Unread'";
    $result1 = mysqli_query($con, $sql);

    $sql2 = "SELECT * FROM seller_login WHERE username='$user'";
    $result3 = mysqli_query($con, $sql2);
    $row = mysqli_fetch_assoc($result3);
    $img = $row['image'];
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
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <title><?=$title ?> | Agent Panel</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Datatables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <!-- Ajax CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css"
        integrity="sha512-tlP4yGOtHdxdeW9/VptIsVMLtgnObNNr07KlHzK4B5zVUuzJ+9KrF86B/a7PJnzxEggPAMzoV/eOipZd8wWpag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.min.css"
        integrity="sha512-fZNmykQ6RlCyzGl9he+ScLrlU0LWeaR6MO/Kq9lelfXOw54O63gizFMSD5fVgZvU1YfDIc6mxom5n60qJ1nCrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="../assets/img/favicon.png" alt="">
                <span class="d-none d-lg-block"><span style="color: black;">Lupa</span>Bahay</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">


                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number"><?= $total_notif ?></span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have <?= $total_notif ?> new notifications
                        </li>
                        <?php
                        while ($row = mysqli_fetch_assoc($result1)){
                            echo '<li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-success"></i>
                            <div>
                            <a class="text-success" href="x-notif.php?id='.$row['id'].'"> <h4>'.$row['message']. '</h4> </a>';
                                
                                $created_at = $row["created_at"];

                                // Get the current date and time
                                $current_time = time();

                                // Get the time difference in seconds
                                $time_diff = $current_time - strtotime($created_at);

                                // Check if it's the same day
                                if (date('Y-m-d', $current_time) == date('Y-m-d', strtotime($created_at))) {
                                // Display the time ago in minutes
                                $time = round($time_diff / 60) . " minutes ago";
                                } else {
                                // Display the date
                                $time = date('F j, Y', strtotime($created_at));
                                }
                                echo '
                                <p>'.$time.'</p>
                            </div>
                        </li>';

                        }

                        ?>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <img src="../uploads/<?php echo $img ?>" alt="">
                            <?php echo $infomation ?>
                        </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $infomation ?></h6>
                            <span></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="php/logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <?php
        $verify = "SELECT verified FROM `seller_login` WHERE id='$agent_id'";
        $result2 = mysqli_query($con, $verify);
        $rows = mysqli_fetch_assoc($result2);
        $verification = $rows["verified"];

        if ($verification == 0){
        echo '<div class="alert alert-warning fixed-top w-100" role="alert" style=" margin-left: 300px; margin-top: 60px;">
        <strong>Verification Required:</strong> Please <a href="profile.php"> verify </a> your account to post property.
        </div>';
        }
    ?>



    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='dashboard.php')?"active-nav":""; ?> "
                    href="dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='posting.php')?"active-nav":""; ?> "
                    href="posting.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    <span>Post Property</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='properties.php')?"active-nav":""; ?> "
                    href="properties.php">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Properties</span>
                </a>
            </li>

            <li class="nav-heading">Accounts</li>

            <li class="nav-item">
                <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='profile.php')?"active-nav":""; ?> "
                    href="profile.php">
                    <i class="ri-user-line"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->