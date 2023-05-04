<?php include 'header.php'; 
require_once 'php/connection.php';
require_once 'php/dashi.php';

global $con;
$user = $_SESSION['ID'];
$userID = implode($user);

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

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Approved Property</h5></center>
                            <center><h2><?php echo $posted; ?></h2></center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Pending Property</h5></center>
                            <center><h2><?php echo $notyet; ?></h2></center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Total Sales</h5></center>
                            <center><h2><?php
                            $sql = "SELECT SUM(price) AS price
                                    FROM seller_property
                                    WHERE status = 'Sold' AND seller_id = '$userID'";
                            $result = mysqli_query($con, $sql);
                            $rows=mysqli_fetch_assoc($result);

                            $total = $rows['price'];

                            $format_total = number_format($total, 2, '.', ',');
                            echo 'Php ' . $format_total;

                        ?></h2></center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Count of Properties</h5></center>

                            <!-- Pie Chart -->
                            <div id="property"></div>

                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#property"), {
                                    series: [<?php echo $house ?>, <?php echo $lot ?>, <?php echo $hL ?>],
                                    chart: {
                                        height: 265,
                                        type: 'pie',
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    labels: ['House', 'Lot', 'House & Lot'],
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
              <center><h5 class="card-title">Property Trends</h5></center>

              <!-- Line Chart -->
              <div id="lineChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#lineChart"), {
                    series: [{
                      name: ['Lot'],
                      data: 
                        [{ <?php 
                      $sql = "SELECT *
                            FROM seller_property
                            WHERE status = 'Sold' AND type = 'Lot';";
                        $result = mysqli_query($con, $sql);
                        $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[] = $row['price'];
                            $sqm[] = $row['sqm'];
                        }
                        
                        echo "x : " . $sqm[0] . ",";
                        echo "y : " . $price[0] . "" ;
                      ?>
                       }],

                    },{
                      name: ['House'],
                      data: 
                        [{ <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House';";
                            $result = mysqli_query($con, $sql);
                            $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[] = $row['price'];
                            $sqm[] = $row['sqm'];
                        }
                        echo "x : " . $sqm[0] . ",";
                        echo "y : " . $price[0] . "" ;
                      ?>
                       }, {
                        <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House';";
                            $result = mysqli_query($con, $sql);
                            $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[] = $row['price'];
                            $sqm[] = $row['sqm'];
                        }
                        echo "x : " . $sqm[1] . ",";
                        echo "y : " . $price[1] . "" ;
                      ?> 
                       }],

                    },{
                      name: ['House and Lot'],
                      data: 
                        [{ <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House and Lot';";
                            $result = mysqli_query($con, $sql);
                            $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[] = $row['price'];
                            $sqm[] = $row['sqm'];
                        }
                        echo "x : " . $sqm[0] . ",";
                        echo "y : " . $price[0] . "" ;
                      ?>
                       },{
                        <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House and Lot';";
                            $result = mysqli_query($con, $sql);
                            $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[] = $row['price'];
                            $sqm[] = $row['sqm'];
                        }
                        echo "x : " . $sqm[1] . ",";
                        echo "y : " . $price[1] . "" ;
                      ?>
                       },{
                        <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House and Lot';";
                            $result = mysqli_query($con, $sql);
                            $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[] = $row['price'];
                            $sqm[] = $row['sqm'];
                        }
                        echo "x : " . $sqm[2] . ",";
                        echo "y : " . $price[2] . "" ;
                      ?>
                       }],

                    }


                    ],
                    chart: {
                      height: 250,
                      type: 'line',
                      zoom: {
                        enabled: false
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'straight'
                    },
                    grid: {
                      row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                      },
                    },
                    xaxis: {
                      type: 'numeric'
                    }
                  }).render();
                });
              </script>
              <!-- End Line Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Column Chart</h5>

              <!-- Column Chart -->
              <div id="columnChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#columnChart"), {
                    series: [{
                      name: 'Lot',
                      data:  <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'Lot';";
                            $result = mysqli_query($con, $sql);
                            $data = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $data[] = $row['price'];
                            }

                      echo json_encode($data); ?>
                    }, {
                      name: 'House',
                      data: <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House';";
                            $result = mysqli_query($con, $sql);
                            $data = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $data[] = $row['price'];
                            }

                      echo json_encode($data); ?>
                    }, {
                      name: 'House And Lot',
                      data: <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House and Lot';";
                            $result = mysqli_query($con, $sql);
                            $data = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $data[] = $row['price'];
                            }

                      echo json_encode($data); ?>
                    }],
                    chart: {
                      type: 'bar',
                      height: 265
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
                      categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
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
 


            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>


<!-- 

                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#lineChart"), {
                    series: [{
                      name: 'Lot',
                      data: 
                      <?php 
                      $sql = "SELECT *
                            FROM seller_property
                            WHERE status = 'Sold' AND type = 'Lot';";
                        $result = mysqli_query($con, $sql);
                        $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[0] = $row['price'];
                            $sqm[0] = $row['sqm'];
                        }
                        
                      ?>
                       [{  <?php echo "'x : '" . implode(", ", $sqm) . "'" ?>,
                                                 <?php echo "'y : '" . implode(", ", $price) . "'" ?>}]
                    }, {
                      name: 'House',
                      data: <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House';";
                            $result = mysqli_query($con, $sql);
                            $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[0] = $row['price'];
                            $sqm[0] = $row['sqm'];
                        }
                        
                      ?>
                        x: <?php echo json_encode($sqm); ?>,
                          y: <?php echo json_encode($price); ?>
                    }, {
                      name: 'House and Lot',
                      data: <?php
                      $sql = "SELECT *
                                FROM seller_property
                                WHERE status = 'Sold' AND type = 'House and Lot';";
                            $result = mysqli_query($con, $sql);
                            $price = array();
                        $sqm = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price[0] = $row['price'];
                            $sqm[0] = $row['sqm'];
                        }
                        
                      ?>
                        x: <?php echo json_encode($sqm); ?>,
                          y: <?php echo json_encode($price); ?>
                    }

                    ],
                    chart: {
                      height: 250,
                      type: 'line',
                      zoom: {
                        enabled: false
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'straight'
                    },
                    grid: {
                      row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                      },
                    },
                    xaxis: {
                      type: 'numeric'
                    }
                  }).render();
                });
               -->