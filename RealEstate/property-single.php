<?php require_once 'header.php'; 
require_once 'php/connection.php';

global $con;
// $session_id = $_SESSION['ID'];
// $sess_id = implode($session_id);

if (isset($_GET["id"])) {
    $property_id = $_GET["id"];

    $sql = "SELECT `title`, `more_info`, `price`, `sqm`, `type`, `approved`, `status`, `seller_id`, `latitude`, `longitude`, `location`, `bedroom`, `garages`, `cr`, seller_property.image, `date`, sl.name as Name,floor_sqm, sl.email FROM `seller_property`
    INNER JOIN seller_login as sl ON seller_property.seller_id = sl.id
    INNER JOIN seller_property_photos as sp ON seller_property.id = sp.property_id
    WHERE seller_property.id = '$property_id'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $price = $row["price"];
    $_price = number_format($price,2);

    $email = $row["email"];

    $lat = $row["latitude"];
    $long = $row["longitude"];

    echo "<script> var latitude = '$lat'; var longitude = '$long';</script>";


    $q = "SELECT `photos` FROM `seller_property_photos` WHERE `property_id` = '$property_id'";
    $r = $con->query($q);

    $q1 = "SELECT * FROM `amenities` WHERE `property_id` = '$property_id'";
    $r1 = $con->query($q1);

}
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<style>
#locmap {
    height: 300px;
    width: 100%;
    z-index: 1;
}
</style>

<body>
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <?php
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                            ?>
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <?php
                            echo '<h1 class="title-single">'.$row["title"].'</h1>';
                            echo '<span class="color-text-a">'.$row["location"].'</span>';
                            ?>

                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="property-grid.php">Properties</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php
                                    echo $row["title"];
                                    ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </section><!-- End Intro Single-->

        <!-- ======= Property Single ======= -->
        <section class="property-single nav-arrow-b">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div id="property-single-carousel" class="swiper">
                            <div class="swiper-wrapper">
                                <?php
                                if ($r->num_rows > 0) {
                                    while($ro = $r->fetch_assoc()){;
                                        ?>
                                <div class="carousel-item-a swiper-slide d-flex justify-content-center">
                                    <?php
                                    echo '<img src="'.$ro["photos"].'" alt="">';
                                    ?>
                                </div>
                                <?php
                                }} 
                                ?>
                            </div>
                        </div>
                        <div class="property-single-carousel-pagination carousel-pagination"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?php
                                if ($result->num_rows > 0) {
                                    
                            ?>
                        <div class="row justify-content-between">
                            <div class="col-md-5 col-lg-4">
                                <div class="property-price d-flex justify-content-center foo">
                                    <div class="card-header-c d-flex">
                                        <div class="card-box-ico">
                                            <span>₱</span>
                                        </div>
                                        <br><br>
                                        <div class="card-title-c align-self-center">
                                            <?php
                                                echo '<h5 class="title-c">'.$_price.'</h5>';
                                                ?>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div>
                                    <div class="title-box-d section-t4">
                                        <h3 class="title-d"> Message/Save</h3>
                                    </div>
                                    <button id='message' class="btn btn-primary btn-lg">
                                        Message
                                    </button>
                                    <button id="add_to_list" data-id="<?php echo $property_id; ?>"
                                        class="btn btn-info btn-lg">
                                        Save Property
                                    </button>
                                </div>
                                <div class="property-summary">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="title-box-d section-t4">
                                                <h3 class="title-d">Quick Summary</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-list">
                                        <ul class="list">
                                            <?php
                                            // echo $sess_id;
                                            echo '
                                            <li class="d-flex justify-content-between">
                                                <strong>Location: </strong>
                                                <span>' .$row["location"].'</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Property Type:</strong>
                                                <span>'.$row["type"].'</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Land Area:</strong>
                                                <span>'.$row["sqm"].'
                                                    <sup>2</sup>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                            <strong>Floor Area:</strong>
                                            <span>'.$row["floor_sqm"].'
                                                <sup>2</sup>
                                            </span>
                                        </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Beds:</strong>
                                                <span>'.$row["bedroom"].'</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Baths:</strong>
                                                <span>'.$row["cr"].'</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Garage:</strong>
                                                <span>'.$row["garages"].'</span>
                                            </li>';
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-lg-7 section-md-t3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title-box-d">
                                            <br><br>
                                            <h3 class="title-d color-text-a" style="font-weight: bold;">Property
                                                Description</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-description">
                                    <?php
                                echo '<p class="description color-text-a">'.$row["more_info"].'
                                </p>' ;
                                ?>
                                </div>
                                <div class="row section-t3">
                                    <div class="col-sm-12">
                                        <div class="title-box-d">
                                            <h3 class="title-d color-text-a" style="font-weight: bold;">Amenities</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="amenities-list color-text-a">
                                    <ul class="list-a no-margin">
                                        <?php
                                if ($r1->num_rows > 0) {
                                    while($roww = $r1->fetch_assoc()){;
                                    echo '<li>'.$roww['amenities'].'</li>';    
                                }}
                                else{
                                    echo '<p class="description color-text-a"> No amenities listed </p>';
                                } 
                                ?>
                                    </ul>
                                </div>
                                <div class="row section-t3">
                                    <div class="col-sm-12">
                                        <div class="title-box-d">
                                            <h3 class="title-d color-text-a" style="font-weight: bold;">Map
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div id="locmap"></div>
                                </div>
                            </div>

                        </div>
                        <?php
                                }
                        ?>

                    </div>
                </div>
            </div>
            </div>
            </div>

            </div>
            </div>
        </section><!-- End Property Single-->
        <br><br><br>
    </main><!-- End #main -->

    </html>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script>
    $(document).ready(function() {
        $("#add_to_list").on("click", function() {
            window.location = '../Customer/';
        });
        $("#message").on("click", function() {
            window.location = '../Customer/';
        });
        var lat = latitude;
        var lng = longitude;
        console.log(lat, lng);
        const maps = L.map('locmap').setView([lat, lng], 15);
        // google streets
        const googleStreets = L.tileLayer(
            'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(maps);

        // Satelite Layer
        googleSat = L.tileLayer(
            'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            });
        googleSat.addTo(maps);
        // control what layers to see in the map
        var baseLayers = {
            "Google Map": googleStreets,
            "Satellite": googleSat,
        };
        L.control.layers(baseLayers).addTo(maps);
        var marker = L.marker([lat, lng]).addTo(maps);
        $('#location-map').modal('show');
        setTimeout(function() {
            window.dispatchEvent(new Event("resize"));
        }, 500);
    });
    </script>