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

                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Most Sold Property</h5>
                        <!-- Donut Chart -->
                      <div id="donutChart"></div>

                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          new ApexCharts(document.querySelector("#donutChart"), {
                            series: [44, 55, 13, 43, 22],
                            chart: {
                              height: 250,
                              type: 'donut',
                              toolbar: {
                                show: true
                              }
                            },
                            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                          }).render();
                        });
                      </script>
                      <!-- End Donut Chart -->

                    </div>
                  </div>
                </div>

            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>