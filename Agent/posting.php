<?php include 'header.php';
    $errormsg="";
    $msg="";
    $imgerror="";
    $user = $_SESSION['ID'];
    $userID = implode($user);
    require_once 'php/connection.php';
    global $con;
    $query = "SELECT id FROM seller_property order by id desc";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['id'];
    if(empty($lastid)){
        $number = "RS-0000001";
    }
    else
    {
        $idd = str_replace('RS-','',$lastid);
        $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
        $number = 'RS-'.$id;
    
    }

    if(isset($_POST['add']))
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
        $inputData = $_POST['amenities'];
        $ameni = explode(',',$inputData);
        // handling the images
        $image = $_FILES['mainimage']['name'];
        $img_size = $_FILES['mainimage']['size'];
            if($img_size > 20000000)
            {
                $imgerror="<p class='alert alert-warning'>Your File is too Large</p>";
            }
            else{
                $temp_name  =$_FILES['mainimage']['tmp_name'];
                move_uploaded_file($temp_name,"../uploads/$image");
                
                $sql = "INSERT INTO seller_property VALUES ('$number','$title','$description','$price','$sqm','$typeofProp','No','For Sale','$userID','$Latitude','$Longitude','$Location','$rooms','$garages','$cr','$image','$current_date','$floorarea')";
                $result = mysqli_query($con, $sql);
                foreach($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['files']['name'][$key];
                    $file_path = '../uploads/' . $file_name;
                    
                    // Move file to server
                    move_uploaded_file($tmp_name, $file_path);
                    
                    // Save file path to database
                    $query = "INSERT INTO seller_property_photos VALUES ('','$number','$file_path')";
                    $result2 = mysqli_query($con, $query);
                }

                foreach($ameni as $row){
                    $sqlquery = "INSERT INTO amenities VALUES ('','$number','$row')";
                    $result3 = mysqli_query($con, $sqlquery);
                }
                if($result && $result2 && $result3 ){
                    $message = "New property posted";
                    $datetime = date('Y-m-d H:i:s');
                    $notifquery = "INSERT INTO notifications VALUES ('','$userID','$message','','Admin','Posted','$datetime','Unread')";
                    $result4 = mysqli_query($con, $notifquery);
                    if (!$result4) {
                        echo "Error: " . mysqli_error($con);
                      }
                    echo "<script>
                    swal({
                        title: 'Success!',
                        text: 'Property listed successfully!',
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


        

    }
?>
<style>
h5 {
    color: #012970;
    font-weight: 500;
}

#map {
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
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Post Property</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Post Property</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <form method="post" id="property_form" enctype="multipart/form-data">
                <div class="form-group">
                    <?php echo $errormsg; ?>
                    <?php echo $msg; 
                    
                    ?>

                    <h5 style="margin-top:20px">
                        Basic Information
                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="title">Title:</label>
                            <input class="form-control" name="title" id="title" rows="3" required></input>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="category1">Type of Property:</label><br>
                                <select name="type" class="form-select" id="property-type" onchange="showOptions()">
                                    <option value=""></option>
                                    <option value="House">House</option>
                                    <option value="Lot">Lot</option>
                                    <option value="House and Lot">House and Lot</option>
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
                                                <input class="form-control" type="number" name="num-bedrooms">
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
                                                <input class="form-control" type="number" name="garages">
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
                                                <input class="form-control" type="number" name="comfort-room">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="description">Amenities: (<em> <i> Amenities can be seperated by commas</i>
                                </em>)</label>
                            <textarea class="form-control" name="amenities" id="amenities" rows="3" required></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label for="description">Add more Information:</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                required></textarea>
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
                                    <input class="form-control" id="sqm" type="number" name="sqm" placeholder=""
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category1">Price:</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">₱</span>
                                    <input class="form-control" id="price" name="price" pattern="[0-9,.]*"
                                        onkeyup="formatPrice(this)" placeholder="" required></input>
                                    <div class="input-group-append">
                                        <a class="input-group-text" type="button">Predict</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div id="floorarea" style="display: none;">
                                    <div>
                                        <label for="floorarea" style="display: block; text-align: left;">Floor
                                            Area (SQM):</label>
                                        <input class="form-control" type="number" name="floorarea">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 style="margin-top:20px;">
                        Property Photos
                    </h5>
                    <hr>
                    <?php echo $imgerror; ?>
                    <div class="row" style="margin-top:10px">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Main photo:</label>
                                <input class="form-control" name="mainimage" type="file" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Other photos:</label>
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
                            <div class="map" id="map"></div>
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
                            <input class="form-control" name="Latitude" id="Latitude" type="number" readonly
                                required></input>
                            <label>Longitude:</label>
                            <input class="form-control" name="Longitude" id="Longitude" type="number" readonly
                                required></input>
                            <label>Location:</label>
                            <input class="form-control" name="Location" id="Location" type="text"></input>
                        </div>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary m-2" name="add"
                        style="float:right; width:100px">


                </div>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="js/map.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
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

    // Add a keyup event listener to the textbox
    priceTextbox.addEventListener("keyup", function() {
        // Retrieve the current value of the textbox
        var value = priceTextbox.value;

        // Remove any existing commas from the value
        value = value.replace(/,/g, "");

        // Insert a comma every three digits
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Set the new value back to the textbox
        priceTextbox.value = value;
    });

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