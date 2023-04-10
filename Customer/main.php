<?php require_once 'header.php'; 
require_once 'php/connection.php';
global $con;
$user = $_SESSION['ID'];
$userID = implode($user);
$sql = "SELECT * FROM `seller_property` WHERE approved = 'Yes' AND status = 'For Sale' ORDER BY date DESC Limit 5";
$result = $con->query($sql);

$query2 = "SELECT * FROM buyer_survey";
$result2 = mysqli_query($con,$query2);
$row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$customer_ids = array_column($row2, 'customer');

$query3 = "SELECT * FROM buyer_survey WHERE customer='$userID'";
$result3 = mysqli_query($con,$query3);
$row3 = mysqli_fetch_array($result3);
$type = $row3['type'];
$p_price = $row3['price'];

// $script = "SELECT * FROM `seller_property` WHERE approved = 'Yes' AND status = 'For Sale' AND price <= '$p_price' AND type='$type' Limit 5";
// $out = $con->query($script);
if($type == 'All'){
    $script = "SELECT * FROM `seller_property` WHERE approved = 'Yes' AND status = 'For Sale' AND price <= '$p_price' Limit 5";
    $out = $con->query($script);
}
else{
    $script = "SELECT * FROM `seller_property` WHERE approved = 'Yes' AND status = 'For Sale' AND price <= '$p_price' AND type='$type' Limit 5";
    $out = $con->query($script);
}

?>

<body>

    <main id="main">

        <section class="section-property section-t8">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-wrap d-flex justify-content-between">
                            <div class="title-box">
                                <h2 class="title-a">Recommended Properties</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (in_array($userID, $customer_ids)) {
                ?>
                <div id="property-carousel" class="swiper">
                    <div class="swiper-wrapper">
                        <?php
                        if ($out->num_rows > 0) {
                        while ($rows1 = $out->fetch_assoc()) {
                        ?>
                        <div class="carousel-item-b swiper-slide">
                            <div class="card-box-a card-shadow">
                                <div class="img-box-a">
                                    <?php
                                    echo '<img src="../uploads/'.$rows1["image"].'" alt="" class="img-a img-fluid">';
                                  ?>

                                </div>
                                <div class="card-overlay">
                                    <div class="card-overlay-a-content">
                                        <div class="card-header-a">
                                            <h2 class="card-title-a">
                                                <?php
                                                echo '
                                                <a >
                                                '.$rows1["title"].'</a>';
                                              ?>

                                            </h2>
                                        </div>
                                        <div class="card-body-a">
                                            <div class="price-box d-flex">
                                                <?php
                                                echo '
                                                <span class="price-a"> BUY | ₱'.$rows1["price"].'</span>';
                                              ?>

                                            </div>
                                            <?php
                                            echo '<a href="property-single.php?id='.$rows1["id"].'" class="link-a">Click here
                                            to view
                                            <span class="bi bi-chevron-right"></span>
                                        </a>';
                                            ?>

                                        </div>
                                        <div class="card-footer-a">
                                            <ul class="card-info d-flex justify-content-around">
                                                <li>
                                                    <?php
                                                    echo '<h4 class="card-info-title">Area</h4>
                                                    <span>'.$rows1["sqm"].'
                                                        <sup>2</sup>
                                                    </span>';
                                                  ?>

                                                </li>
                                                <li>
                                                    <?php
                                                  echo '<h4 class="card-info-title">Beds</h4>
                                                  <span>'.$rows1["bedroom"].'</span>';

                                                  ?>

                                                </li>
                                                <li>
                                                    <?php
                                                  echo '<h4 class="card-info-title">Bath</h4>
                                                  <span>'.$rows1["cr"].'</span>';

                                                  ?>
                                                </li>
                                                <li>
                                                    <?php
                                                  echo '<h4 class="card-info-title">Garages</h4>
                                                  <span>'.$rows1["garages"].'</span>';
                                                  ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End carousel item -->
                        <?php 
                        }}
                        else{
                            if($type == 'All'){
                                $script2 = "SELECT * FROM `seller_property` WHERE approved = 'Yes' AND status = 'For Sale' Limit 10";
                                $out2 = $con->query($script2);
                            }
                            else{
                                $script2 = "SELECT * FROM `seller_property` WHERE approved = 'Yes' AND status = 'For Sale' AND type='$type' Limit 10";
                                $out2 = $con->query($script2);
                            }

                            while ($rows2 = $out2->fetch_assoc()) {
                                ?>
                        <div class="carousel-item-b swiper-slide">
                            <div class="card-box-a card-shadow">
                                <div class="img-box-a">
                                    <?php
                                            echo '<img src="../uploads/'.$rows2["image"].'" alt="" class="img-a img-fluid">';
                                          ?>

                                </div>
                                <div class="card-overlay">
                                    <div class="card-overlay-a-content">
                                        <div class="card-header-a">
                                            <h2 class="card-title-a">
                                                <?php
                                                        echo '
                                                        <a >
                                                        '.$rows2["title"].'</a>';
                                                      ?>

                                            </h2>
                                        </div>
                                        <div class="card-body-a">
                                            <div class="price-box d-flex">
                                                <?php
                                                        echo '
                                                        <span class="price-a"> BUY | ₱'.$rows2["price"].'</span>';
                                                      ?>

                                            </div>
                                            <?php
                                                    echo '<a href="property-single.php?id='.$rows2["id"].'" class="link-a">Click here
                                                    to view
                                                    <span class="bi bi-chevron-right"></span>
                                                </a>';
                                                    ?>

                                        </div>
                                        <div class="card-footer-a">
                                            <ul class="card-info d-flex justify-content-around">
                                                <li>
                                                    <?php
                                                            echo '<h4 class="card-info-title">Area</h4>
                                                            <span>'.$rows2["sqm"].'
                                                                <sup>2</sup>
                                                            </span>';
                                                          ?>

                                                </li>
                                                <li>
                                                    <?php
                                                          echo '<h4 class="card-info-title">Beds</h4>
                                                          <span>'.$rows2["bedroom"].'</span>';
        
                                                          ?>

                                                </li>
                                                <li>
                                                    <?php
                                                          echo '<h4 class="card-info-title">Bath</h4>
                                                          <span>'.$rows2["cr"].'</span>';
        
                                                          ?>
                                                </li>
                                                <li>
                                                    <?php
                                                          echo '<h4 class="card-info-title">Garages</h4>
                                                          <span>'.$rows2["garages"].'</span>';
                                                          ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End carousel item -->
                        <?php 
                                }
                        }
                }
                else{
                    echo '<h2>Please complete our <a href="survey.php">survey</a> first, so that we can recommend some properties to you. </h2>';
                }
            ?>
                    </div>
                    <div class="propery-carousel-pagination carousel-pagination"></div>
                </div>
            </div>

        </section><!-- End Latest Properties Section -->
        <section class="section-property section-t8">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-wrap d-flex justify-content-between">
                            <div class="title-box">
                                <h2 class="title-a">Latest Properties</h2>

                            </div>
                            <div class="title-link">
                                <a href="property-grid.php">All Property
                                    <span class="bi bi-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="property-carousel" class="swiper">
                    <div class="swiper-wrapper">
                        <?php
                        if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="carousel-item-b swiper-slide">
                            <div class="card-box-a card-shadow">
                                <div class="img-box-a">
                                    <?php
                                    echo '<img src="../uploads/'.$row["image"].'" alt="" class="img-a img-fluid">';
                                  ?>

                                </div>
                                <div class="card-overlay">
                                    <div class="card-overlay-a-content">
                                        <div class="card-header-a">
                                            <h2 class="card-title-a">
                                                <?php
                                                echo '
                                                <a >
                                                '.$row["title"].'</a>';
                                              ?>

                                            </h2>
                                        </div>
                                        <div class="card-body-a">
                                            <div class="price-box d-flex">
                                                <?php
                                                echo '
                                                <span class="price-a"> BUY | ₱'.$row["price"].'</span>';
                                              ?>

                                            </div>
                                            <?php
                                            echo '<a href="property-single.php?id='.$row["id"].'" class="link-a">Click here
                                            to view
                                            <span class="bi bi-chevron-right"></span>
                                        </a>';
                                            ?>

                                        </div>
                                        <div class="card-footer-a">
                                            <ul class="card-info d-flex justify-content-around">
                                                <li>
                                                    <?php
                                                    echo '<h4 class="card-info-title">Area</h4>
                                                    <span>'.$row["sqm"].'
                                                        <sup>2</sup>
                                                    </span>';
                                                  ?>

                                                </li>
                                                <li>
                                                    <?php
                                                  echo '<h4 class="card-info-title">Beds</h4>
                                                  <span>'.$row["bedroom"].'</span>';

                                                  ?>

                                                </li>
                                                <li>
                                                    <?php
                                                  echo '<h4 class="card-info-title">Bath</h4>
                                                  <span>'.$row["cr"].'</span>';

                                                  ?>
                                                </li>
                                                <li>
                                                    <?php
                                                  echo '<h4 class="card-info-title">Garages</h4>
                                                  <span>'.$row["garages"].'</span>';

                                                  ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End carousel item -->

                        <?php 
                        }}
                        ?>

                    </div>
                    <div class="propery-carousel-pagination carousel-pagination"></div>
                </div>


            </div>
        </section><!-- End Latest Properties Section -->


    </main><!-- End #main -->

    </html>
    <?php include 'footer.php'; ?>