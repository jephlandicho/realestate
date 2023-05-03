<?php include 'header.php'; 
require_once 'php/connection.php';
require_once 'php/dashi.php';
?>

<body>

    <!-- HANGGANG DITO ANG KUKUNIN-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section>
            <div class="row">

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Posted</h5>
                            <h2><?php echo $posted; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Not Yet Posted</h5>
                            <h2><?php echo $notyet; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sales</h5>
                            <h2><?php ?></h2>
                        </div>
                    </div>
                </div>


            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>