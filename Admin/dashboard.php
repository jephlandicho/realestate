<?php include 'header.php'; 
require_once 'php/connection.php';
// global $con;
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
          <div class="col-lg-12">
            <h3></h3>
          </div>

            <div class="col-lg-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Count of Buyer</h5>
                    <h2><?php echo $buyer_count; ?></h2>
                </div>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Count of Agent</h5>
                    <h2><?php echo $agent_count; ?></h2>
                </div>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Approved Property</h5>
                    <h2><?php echo $total_app; ?></h2>
                </div>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Pending Property</h5>
                    <h2><?php echo $notyet; ?></h2>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Property Status Count</h5>

                  <!-- Pie Chart -->
                    <div id="property"></div>

                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#property"), {
                          series: [<?php echo $forsale ?>, <?php echo $sold ?>],
                          chart: {
                            height: 265,
                            type: 'pie',
                            toolbar: {
                              show: true
                            }
                          },
                          labels: ['For Sale', 'Sold'],
                          theme: {
                             monochrome: {
                                enabled: true,
                                color: '#123fc3',
                                shadeTo: 'light',
                                shadeIntensity: 0.65
                             }
                          }
                        }).render();
                      });
                    </script>
                  <!-- End Pie Chart -->
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Highest Price of Property Sold</h5>
                    <!-- Column Chart -->
              <div id="columnChart"></div>


<?php 
// $sql = "SELECT seller_id, SUM(price) AS price
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


//end
 ?>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#columnChart"), {
                    series: [{
                      name: 'Net Profit',
                      data: ['<?php 
                                              $sql = "SELECT seller_id, SUM(price) AS price
                                                FROM seller_property
                                                WHERE status = 'Sold'
                                                GROUP BY seller_id
                                                LIMIT 5;";
                                              $result = mysqli_query($con, $sql);
                                              $row = mysqli_fetch_assoc($result);
                                              $num_rows = mysqli_num_rows($result);
                                              $price = $row['price'];
                                              $seller = $row['seller_id'];
                                              
                                              for ($x = 0; $x <= $num_rows; $x++) {
                                                echo $price;
                                                echo $seller;
                                              }
                                               ;
                      
                      
                                              ?>']
                    }],
                    chart: {
                      type: 'bar',
                      height: 250
                    },
                    plotOptions: {
                      bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                      },
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      show: true,
                      width: 2,
                      colors: ['transparent']
                    },
                    xaxis: {
                      categories: ['<?php
                      $quer = "SELECT name FROM seller_login WHERE id = $seller";
                      $result = mysqli_query($con, $quer);

                      while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['name'];
                        echo $name;
                      }
                      ?>'],
                    },
                    yaxis: {
                      title: {
                        text: '$ (thousands)'
                      }
                    },
                    fill: {
                      opacity: 1
                    },
                    tooltip: {
                      y: {
                        formatter: function(val) {
                          return "$ " + val + " thousands"
                        }
                      }
                    }
                  }).render();
                });
              </script>
              <!-- End Column Chart -->

                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Agent with Most Sales</h5>
                    <!-- Bar Chart -->
              <div id="barChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#barChart"), {
                    series: [{
                      data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
                    }],
                    chart: {
                      type: 'bar',
                      height: 250
                    },
                    plotOptions: {
                      bar: {
                        borderRadius: 4,
                        horizontal: true,
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    xaxis: {
                      categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
                        'United States', 'China', 'Germany'
                      ],
                    }
                  }).render();
                });
              </script>
              <!-- End Bar Chart -->

                </div>
              </div>
            </div>
           
            

        </div>
    </section>    

    </main>


    <?php include 'footer.php'; ?>