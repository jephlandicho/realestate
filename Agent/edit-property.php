<?php include 'header.php';
require_once 'php/connection.php';
global $con;

$id = $_GET['id'];
$sql = "SELECT * FROM seller_property WHERE `seller_property`.`id`= '$id'";
$result = $con->query($sql);

if(isset($_POST['edit']))
{
    $title = $_POST['title'];
    $typeofProp = $_POST['type'];
    $price = $_POST['price'];
    $price = str_replace(",", "", $price);
    $sqm = $_POST['sqm'];
    $floorarea = $_POST['floorarea'];
    $description = $_POST['description'];
    $Latitude = $_POST['Latitude'];
    $Longitude = $_POST['Longitude'];
    $Location = $_POST['Location'];
    $rooms = $_POST['num-bedrooms'];
    $garages = $_POST['garages'];
    $cr = $_POST['comfort-room'];
    $Location = $_POST['Location'];
    $current_date = date('Y-m-d');

    // handling the images
    // `id`, `title`, `more_info`, `price`, `sqm`, `type`, `approved`, `status`, `seller_id`, `latitude`, `longitude`, `location`, `bedroom`, `garages`, `cr`, `image`, `date`, `floor_sqm`
    if (!empty($_FILES['mainimage']['name'])) {
        // The variable is not empty, so do something with the file
        $image = $_FILES['mainimage']['name'];
        $img_size = $_FILES['mainimage']['size'];
        $temp_name  =$_FILES['mainimage']['tmp_name'];
        move_uploaded_file($temp_name,"../uploads/$image");
        $sql5 = "UPDATE seller_property SET title='$title',more_info='$description',price='$price',sqm='$sqm',type='$typeofProp',latitude='$Latitude',longitude='$Longitude',location='$Location',bedroom='$rooms',garages='$garages',cr='$cr',image='$image',floor_sqm='$floorarea' WHERE id='$id'";
        $result5 = mysqli_query($con, $sql5);
    } else {
        $sql6 = "UPDATE seller_property SET title='$title',more_info='$description',price='$price',sqm='$sqm',type='$typeofProp',latitude='$Latitude',longitude='$Longitude',location='$Location',bedroom='$rooms',garages='$garages',cr='$cr',floor_sqm='$floorarea' WHERE id='$id'";
        $result6 = mysqli_query($con, $sql6);
    }
            
        // Retrieve existing photos
        $query1 = "SELECT photos FROM seller_property_photos WHERE property_id='$id'";
        $result7 = mysqli_query($con, $query1);
        $existing_photos = array();
        while ($row2 = mysqli_fetch_assoc($result7)) {
            $existing_photos[] = $row2['photos'];
        }
        if (isset($_FILES['files']) && $_FILES['files']['error'][0] !== 4) {
        // Loop through new uploaded files
        foreach($_FILES['files']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['files']['name'][$key];
            $file_path = '../uploads/' . $file_name;
            
            // Check if file is already in existing photos
            if (!in_array($file_name, $existing_photos)) {
                // Move file to server
                move_uploaded_file($tmp_name, $file_path);
                
                // Insert new photo record into database
                $query3 = "INSERT INTO seller_property_photos (property_id, photos) VALUES ('$id', '$file_name')";
                $result9 = mysqli_query($con, $query3);
            }
        }

        // Update existing photos in database
        $query5 = "UPDATE seller_property_photos SET photos = CASE";
        foreach ($existing_photos as $photo) {
            $query5 .= " WHEN photos='$photo' THEN '$photo'";
        }
        $query5 .= " ELSE photos END WHERE property_id='$id'";
        $result = mysqli_query($con, $query5);
    }
    $inputData = $_POST['amenities'];
    $ameni = explode(',', $inputData);
    
    // Delete all existing rows for the given number
    $sqlquery2 = "DELETE FROM amenities WHERE property_id = '$id'";
    $r3 = mysqli_query($con, $sqlquery2);
    
    // Insert new rows
    foreach ($ameni as $row) {
        $sqlquery3 = "INSERT INTO amenities VALUES ('', '$id', '$row')";
        $r4 = mysqli_query($con, $sqlquery3);
    }
    
            if($result6 || $result5 || r4 && result9 ){
                echo "<script>
                swal({
                    title: 'Success!',
                    text: 'Property updated!',
                    icon: 'success',
                    button: 'OK',
                    allowOutsideClick: false,
                    closeOnEsc: false
                }).then(function() {
                    window.location = 'properties.php';
                });
            </script>";
            }
            else{
                echo "<script>
                    swal({
                        title: 'Error!',
                        text: 'Something went wrong!',
                        icon: 'error',
                        button: 'OK',
                        allowOutsideClick: false,
                        closeOnEsc: false
                    }).then(function() {
                        window.location = 'posting.php';
                    });
                </script>";
            }

        

}
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
#locmap {
    margin-top: 20px;
    height: 300px;
    width: 100%;
    z-index: 1;
}

.hide {
    display: none;
}

input[type="text"],
textarea {
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
}

select {
    width: 200px;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    background-color: #fff;
}

.container {
    text-align: right;
    /* Center the items horizontally */
}

/* Style for the modal */
.modal {
    display: none;
    /* Hide the modal by default */
    position: fixed;
    /* Position the modal */
    z-index: 1;
    /* Set the modal above all other elements */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scrolling if needed */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black with opacity */
}

/* Style for the modal content */
.modal-content {
    background-color: #fefefe;
    /* White background */
    margin: 15% auto;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    /* 80% width */
    z-index: 9999;
}

/* Style for the question mark icon */
.question-mark-icon {
    display: inline-block;
    width: 20px;
    height: 20px;
    background-image: url('questionmark.png');
    background-size: cover;
    cursor: pointer;
    background-size: 20px 20px;
    background-repeat: no-repeat;
    position: relative;
}


.question-mark-icon::before {
    /* content: "Need Help?"; */
    /* Change this text to whatever you want to display */
    display: none;
    position: absolute;
    top: -20px;
    left: calc(100% + 10px);
    /* Change the value of 10px to adjust the distance to the right */
    padding: 10px;
    background-color: #fff;
    border: 1px solid #000;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    font-size: 14px;
    font-weight: bold;
    z-index: 999;
}

.question-mark-icon:hover::before {
    display: block;
}

.photo-carousel {
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel-item {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel-item img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}
</style>


<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Property</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">My Properties</li>
                    <li class="breadcrumb-item active">Edit Property</li>
                </ol>

            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <?php
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            ?>
            <form method="post" id="property_form" enctype="multipart/form-data">
                <div class="form-group">

                    <h5 style="margin-top:20px">
                        Basic Information
                    </h5>
                    <hr>
                    <div class="row">

                        <div class="col-lg-6">
                            <label for="title">Title:</label>
                            <input class="form-control" name="title" id="title" rows="3"
                                value='<?= $row["title"]?>'></input>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="category1">Type of Property:</label><br>
                                <select name="type" class="form-select" id="property-type" onchange="showOptions()">

                                    <?php
                                $options = array("House", "Lot", "House and Lot");
                                foreach ($options as $option) {
                                    if ($option == $row["type"]) {
                                        echo '<option value="'.$option.'" selected>'.$option.'</option>';
                                    } else {
                                        echo '<option value="'.$option.'">'.$option.'</option>';
                                    }
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row d-flex">
                                <div class="col-lg-4 py-2 flex-fill">
                                    <div class="form-group">
                                        <div id="num-bedrooms" style="display: none;">
                                            <div style="margin-right: 20px;">
                                                <label for="num-bedrooms"
                                                    style="display: block; text-align: left;">Bedroom:</label>
                                                <input id='beds' class="form-control" type="number" name="num-bedrooms"
                                                    value='<?= $row["bedroom"]?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 py-2 flex-fill">
                                    <div class="form-group">
                                        <div id="garages" style="display: none;">
                                            <div style="margin-right: 20px;">
                                                <label for="garages"
                                                    style="display: block; text-align: left;">Garages:</label>
                                                <input id='cars' class="form-control" type="number" name="garages"
                                                    value='<?= $row["garages"]?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 py-2 flex-fill">
                                    <div class="form-group">
                                        <div id="comfort-room" style="display: none;">
                                            <div style="margin-right: 20px;">
                                                <label for="comfort-room"
                                                    style="display: block; text-align: left;">Comfort Room:</label>
                                                <input id='cr' class="form-control" type="number" name="comfort-room"
                                                    value='<?= $row["cr"]?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="description">Amenities: (<em> <i> Amenities can be seperated by commas</i>
                                </em>)</label>
                            <?php
                                $sql1 = "SELECT * FROM `amenities` WHERE `property_id` = '$id'";
                                $result1 = $con->query($sql1);

                                // Concatenate the amenities into a single string with commas separating them
                                $amenities_string = "";
                                if ($result1->num_rows > 0) {
                                    while($rows = $result1->fetch_assoc()) {
                                        $amenities_string .= $rows["amenities"] . ", ";
                                    }
                                    $amenities_string = rtrim($amenities_string, ", "); // Remove the trailing comma and space
                                }                           
                                ?>
                            <textarea class="form-control" name="amenities" id="amenities" rows="3"
                                required><?php echo $amenities_string; ?></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label for="description">Add more Information:</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                required><?= $row["more_info"]?></textarea>

                        </div>
                    </div>
                    <h5 style="margin-top:20px">
                        Property Price and Size
                    </h5>
                    <hr>
                    <div class="row" style="margin-top:20px">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category1">Land Area (SQM):</label>
                                <div class="input-group">
                                    <input id='landsize' class="form-control" id="sqm" type="number" name="sqm"
                                        placeholder="" required value='<?= $row["sqm"]?>'>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div id="floorarea" style="display: none;">
                                    <div>
                                        <label for="floorarea" style="display: block; text-align: left;">Floor
                                            Area (SQM):</label>
                                        <input id='floorsize' class="form-control" type="number" name="floorarea"
                                            value='<?= $row["floor_sqm"]?>'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category1">Price:</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">₱</span>
                                    <input class="form-control" id="price" name="price" pattern="[0-9,.]*"
                                        onkeyup="formatPrice(this)" placeholder="" required
                                        value='<?= $row["price"]?>'></input>
                                    <div class="input-group-append">
                                        <a class="input-group-text" type="button" onclick="submitData()">Suggest</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <h5 style="margin-top:20px;">
                        Property Photos
                    </h5>
                    <hr>

                    <div class="row" style="margin-top:10px">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Main photo:</label>
                                <br>
                                <br>
                                <a href="../uploads/<?= $row["image"] ?>" target="_blank">
                                    <img src="../uploads/<?= $row["image"] ?>" class="img-fluid"
                                        style="width: 300px; height: 300px; object-fit: cover;">
                                </a>
                                <br>
                                <br>
                                <input class="form-control" name="mainimage" type="file">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Other photos:</label>
                                <br>
                                <br>
                                <div class="swiper-container photo-carousel" style="overflow: hidden; ">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $query = "SELECT photos FROM `seller_property_photos` WHERE property_id = '$id'";
                                        $result2 = mysqli_query($con, $query);
                                        $photos = mysqli_fetch_all($result2, MYSQLI_ASSOC);

                                        // Display the photos as <img> tags inside a carousel item
                                        foreach ($photos as $photo) {
                                            echo '<div class="swiper-slide"><img src="../uploads/' . $photo['photos'] . '" style="width: 300px; height: 300px;"></div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <br>
                                <input class="form-control" name="files[]" type="file" multiple>
                            </div>
                        </div>
                    </div>
                    <h5 style="margin-top:20px">
                        Property Location
                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="locmap" id="locmap"></div>
                        </div>
                        <!-- The question mark icon -->
                        <div title="Need Help?" class="question-mark-icon" onclick="openModal()"></div>

                        <!-- The modal -->
                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">

                                <h2>HOW TO USE THE MAP</h2>
                                <p>Here are some tips for using the map:</p>
                                <ul>
                                    <li>
                                        <p><i class="bi bi-stack"></i> If you click on this icon, you can select the
                                            view of the map, whether it's in Google Maps or satellite view </p>
                                    </li>

                                    <li>
                                        <p><i class="bi bi-search"></i> If you click on the search icon, you can input
                                            the location of the property. After hitting enter, a pin will appear, which
                                            you can drag to the exact location. The latitude and longitude of the
                                            property will be displayed on the right side of the screen</p>
                                    </li>

                                    <li>On the top left side, you can see two icons<br>
                                        The <i class="bi bi-plus-square-fill"></i> plus icon is used to zoom in on the
                                        map and the <i class="bi bi-dash-square-fill"></i> minus icon is used for
                                        zooming out on the map</li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Latitude:</label>
                            <input class="form-control" name="Latitude" id="Latitude" type="number" readonly required
                                value='<?= $row["latitude"]?>'></input>
                            <label>Longitude:</label>
                            <input class="form-control" name="Longitude" id="Longitude" type="number" readonly required
                                value='<?= $row["longitude"]?>'></input>
                            <label>Location:</label>
                            <input class="form-control" name="Location" id="Location" type="text"
                                value='<?= $row["location"]?>'></input>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary m-2" name="edit"
                    style="float:right; width:100px">
            </form>
            <?php
                    }
                ?>
        </div>
    </main>
    <?php 
include 'footer.php'; ?>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- <script src="js/map.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Include Swiper library -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
    var mySwiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
        },
        // pagination: {
        //     el: '.swiper-pagination',
        //     clickable: true,
        // },
    });

    $(document).ready(function() {
        // Get the values of lat and lng from the text box
        var lat = $('#Latitude').val();
        var lng = $('#Longitude').val();


        // Convert the string values to numbers
        lat = parseFloat(lat);
        lng = parseFloat(lng);


        const maps = L.map('locmap').setView([lat, lng], 15);

        // Google Streets Layer
        const googleStreets = L.tileLayer(
            'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(maps);

        // Satellite Layer
        googleSat = L.tileLayer(
            'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            });
        googleSat.addTo(maps);

        // Control what layers to see in the map
        var baseLayers = {
            "Google Map": googleStreets,
            "Satellite": googleSat,
        };
        L.control.layers(baseLayers).addTo(maps);

        // Add a marker to the map
        var marker = L.marker([lat, lng]).addTo(maps);
        // Trigger a resize event to make sure the map is properly displayed
        setTimeout(function() {
            window.dispatchEvent(new Event("resize"));
        }, 500);


        var geocoderNominatim = new L.Control.Geocoder.Nominatim();
        var geocoder = L.Control.geocoder({
                defaultMarkGeocode: false,
                draggable: true,
                geocoder: geocoderNominatim
            })
            .on('markgeocode', function(e) {
                var box = e.geocode.center;
                var name = e.geocode.name;
                document.getElementById("Latitude").value = box.lat;
                document.getElementById("Longitude").value = box.lng;
                document.getElementById("Location").value = e.geocode.name;
                MarkLayer = L.marker([box.lat, box.lng], {
                    draggable: true
                }).addTo(maps).
                on('dragend', onDragEnd).
                bindPopup(e.geocode.name).
                openPopup();
                displayLatLng(box);

                group = new L.featureGroup([MarkLayer]);

                maps.fitBounds(group.getBounds());

            }).addTo(maps);

        function onDragEnd(event) {
            var latlng = event.target.getLatLng();
            geocoderNominatim.reverse(latlng, maps.options.crs.scale(maps.getZoom()),
                function(reverseGeocoded) {
                    event.target.setPopupContent(reverseGeocoded[0].name).openPopup();
                    document.getElementById("Location").value = reverseGeocoded[0].name;
                }, this)
            displayLatLng(latlng);

        }

        function displayLatLng(latlng) {
            document.getElementById("Latitude").value = latlng.lat;
            document.getElementById("Longitude").value = latlng.lng;

        }
    });

    function showOptions() {
        var propertyType = document.getElementById("property-type").value;
        var rooms = document.getElementById("num-bedrooms");
        var cr = document.getElementById("comfort-room");
        var garages = document.getElementById("garages");

        if (propertyType == "House" || propertyType == "House and Lot") {
            rooms.style.display = "block";
            cr.style.display = "block";
            garages.style.display = "block";
            floorarea.style.display = "block";

        } else {
            rooms.style.display = "none";
            cr.style.display = "none";
            garages.style.display = "none";
            floorarea.style.display = "none";

        }
    }
    window.addEventListener("DOMContentLoaded", function() {
        showOptions();
    });

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the question mark icon
    var icon = document.querySelector(".question-mark-icon");

    // When the user clicks on the icon, open the modal
    function openModal() {
        modal.style.display = "block";
    }

    // When the user clicks on the close button, close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    let inputData = document.getElementById('amenities').value;
    let words = inputData.split(',');
    // Get the price textbox element

    var priceTextbox = document.getElementById("price");
    // priceTextbox.addEventListener("keyup", formatPrice);
    // priceTextbox.addEventListener("input", formatPrice);
    priceTextbox.addEventListener("input", function() {
        formatPrice();
    });
    // Add a keyup event listener to the textbox
    function formatPrice() {
        // Retrieve the current value of the textbox
        var value = priceTextbox.value;

        // Remove any existing commas from the value
        value = value.replace(/,/g, "");

        // Insert a comma every three digits
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Set the new value back to the textbox
        priceTextbox.value = value;
    };

    function formatPrice(input) {
        // Remove any non-numeric characters
        var value = input.value.replace(/[^0-9.]/g, '');

        // Format the number with commas and decimals
        var parts = value.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        if (parts.length > 1) {
            parts[1] = parts[1].slice(0, 2);
            value = parts.join('.');
        } else {
            value = parts[0];
        }

        // Set the formatted value back to the input
        input.value = value;
    }
    </script>