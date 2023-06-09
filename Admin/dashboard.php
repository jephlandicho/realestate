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
                            <center><h5 class="card-title">Count of Buyer</h5></center>
                            <center><h2><?php echo $buyer_count; ?></h2></center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Count of Agent</h5></center>
                            <center><h2><?php echo $agent_count; ?></h2></center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Approved Property</h5></center>
                            <center><h2><?php echo $total_app; ?></h2></center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Pending Property</h5></center>
                            <center><h2><?php echo $notyet; ?></h2></center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Property Status Count</h5></center>

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
                            <center><h5 class="card-title">Highest Price of Property Sold</h5></center>
                            <!-- Column Chart -->
                            <div id="columnChart"></div>

                            <?php 
    $sql = "SELECT seller_id, MAX(price) AS price
            FROM seller_property
            WHERE status = 'Sold'
            GROUP BY seller_id
            LIMIT 5;";
    $result = mysqli_query($con, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row['price'];
    }
?>

                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#columnChart"), {
                                    series: [{
                                        name: 'Total Sold Property',
                                        data: <?php echo json_encode($data); ?>
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
                                        categories: [
                                            <?php
                        $quer = "SELECT name FROM seller_login WHERE id IN (
                                    SELECT seller_id FROM seller_property
                                    WHERE status = 'Sold'
                                    GROUP BY seller_id
                                    )";
                        $result = mysqli_query($con, $quer);
                        $names = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $names[] = $row['name'];
                            // echo json_encode($names);
                        }
                        echo "'" . implode("', '", $names) . "'";
                    ?>
                                        ],
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'Pesos'
                                        }
                                    },
                                    fill: {
                                        opacity: 1
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(val) {
                                                return "PHP " + val
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

<?php 
    $sql = "SELECT seller_id, SUM(price) AS price
            FROM seller_property
            WHERE status = 'Sold'
            GROUP BY seller_id
            LIMIT 5;";
    $result = mysqli_query($con, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row['price'];
    }
?>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <center><h5 class="card-title">Agent with Most Sales</h5></center>
                            <!-- Bar Chart -->
                            <div id="barChart"></div>

                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#barChart"), {
                                    series: [{
                                        name: 'Total Sales',
                                        data: <?php echo json_encode($data); ?>
                                        
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
                                        categories: [<?php
                        $quer = "SELECT name FROM seller_login WHERE id IN (
                                    SELECT seller_id FROM seller_property
                                    WHERE status = 'Sold'
                                    GROUP BY seller_id
                                    )";
                        $result = mysqli_query($con, $quer);
                        $names = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $names[] = $row['name'];
                            // echo json_encode($names);
                        }
                        echo "'" . implode("', '", $names) . "'";
                    ?>
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