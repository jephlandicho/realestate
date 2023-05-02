<?php include 'header.php'; 
include 'php/connection.php'; 
global $con;
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT seller_property.id, `title`, sl.name AS Name, `more_info`, `price`, `sqm`, `type`, `latitude`, `longitude`, `location`, `bedroom`, `garages`, `cr`, seller_property.image,`date`,`floor_sqm`,seller_property.seller_id FROM `seller_property` 
INNER JOIN `seller_login` AS sl ON seller_property.seller_id = sl.id
WHERE approved='No' ORDER BY date DESC";
$result = $con->query($sql);
?>
<!-- -->
<style type="text/css">
#locmap {
    height: 300px;
    width: 100%;
    z-index: 1;
}

.image-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    padding: 10px;
}

.image-container .image {
    height: 180px;
    width: 240px;
    /*	border: 10px solid #ffff;*/
    overflow: hidden;
    cursor: pointer;
}

.image-container .image img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: .2s linear;
}

.image-container .image:hover img {
    transform: scale(1.1);
}

.modal-body .popup-image {
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.7);
    height: 100%;
    width: 100%;
    z-index: 100;
    display: none;
}

.modal-body .popup-image span {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 60px;
    font-weight: bolder;
    color: #fff;
    cursor: pointer;
    z-index: 100;
}

.modal-body .popup-image img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 5px;
    border-radius: 5px;
    width: 750px;
    object-fit: cover;
}

@media (max-width: 768px) {
    .modal-body .popup-image img {
        width: 95%;
    }
}
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Property for Approval</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Property for Approval</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section admin-confirmation">
        <div class="row">
            <?php if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { ?>
            <div class="col-md-4 px-10">
                <div class=" card" style="">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align:center"> <strong> <?php echo $row["title"]; ?>
                            </strong> </h5>
                        <p class="card-text">
                            <input class="property_id" type="hidden" value="<?php echo $row["id"]?>">
                            <strong> Agent: </strong> <?php echo $row["Name"]; ?> <br>
                            <strong> Type: </strong> <?php echo $row["type"]; ?> <br>
                            <strong> Land Area (SQM): </strong> <?php echo $row["sqm"]; ?> <br>
                            <?php
                            $price = $row["price"];
                            $_price = number_format($price,2);
                            ?>
                            <strong> Price: </strong> ₱ <?php echo $_price ?><br>
                            <strong> Location: </strong> <a style="cursor: pointer;" data-id2="<?php echo $row["id"]?>"
                                class="show-loc">
                                <?php echo $row["location"]; ?></a><br>
                            <strong> Date: </strong> <?php echo $row["date"]; ?><br>
                        </p>
                        <div style="text-align: center">
                            <button data-id="<?php echo $row["id"]?>" type_prop="<?php echo $row["type"]?>"
                                title="View Property Details" id="btn_details" type="button"
                                class="btn btn-primary btn_details" data-bs-backdrop="static" data-bs-keyboard="false">
                                Details</button>
                            <button data-id1="<?php echo $row["id"]?>" title="View Property Photos" id="btn_photos"
                                type="button" class="btn btn-secondary btn_photos" data-bs-backdrop="static"
                                data-bs-keyboard="false">
                                Photos</button>
                            <button data-id2="<?php echo $row["seller_id"]?>" data-id3="<?php echo $row["id"]?>"
                                title="Approved Property" id="btn_approved" type="button"
                                class="btn btn-success btn_approved">
                                <i class="bi bi-check-circle"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <?php
            }} else {echo "<h3 class='text-center text-secondary'> NO PROPERTIES TO BE APPROVED </h3>";} ?>
        </div>



    </section>
</main>

<!-- modals -->
<div id="imagesModal" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Images</h5>
                <button class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 25px">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="image-container">
                    <!-- <div class="row"> -->
                    <div class="row img_con"></div>
                    <!-- </div> -->
                </div>

                <div class="popup-image">
                    <span>&times;</span>
                    <img src="">
                </div>

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>

<div id="detailsModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Details</h5>
                <button class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 25px">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="bedroom" style="display: none;">
                    <div style="float: center; ">
                        <label style="display: inline-block;"><strong>Bedroom:</strong></label>
                        <div style="display: inline-block;" class=" bedroom"></div>
                    </div>
                </div>
                <div id="cr" style="display: none;">
                    <div style="float: center;">
                        <label style="display: inline-block;"><strong>Comfort
                                Room:</strong></label>
                        <div style="display: inline-block;" class="cr"></div>
                    </div>
                </div>
                <div id="garages" style="display: none;">
                    <div style="float: center; ">
                        <label style="display: inline-block;"><strong>Garage:</strong></label>
                        <div style="display: inline-block;" class="garages"></div>
                    </div>
                </div>
                <div id="floor" style="display: none;">
                    <div style="float: center;">
                        <label style="display: inline-block;"><strong>Floor Area (SQM):</strong></label>
                        <div style="display: inline-block;" class="floor"></div>
                    </div>
                </div>
                <br>
                <strong>Amenities:</strong>
                <div class="amenities">

                </div>
                <br>
                <strong>More Information:</strong>
                <div class="detailss"></div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<div id="location-map" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Location</h5>
                <button class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 25px">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="locmap"></div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script>
$(document).ready(function() {
    $(".btn_details").on("click", function() {
        var dataId = $(this).attr("data-id");
        var type = $(this).attr("type_prop");
        $.ajax({
            method: 'POST',
            dataType: 'JSON',
            url: "z-details.php",
            data: {
                dataId: dataId
            },
            success: function(data) {
                let header = document.querySelector(".detailss");
                var rooms = document.getElementById("bedroom");
                var garages = document.getElementById("garages");
                var crs = document.getElementById("cr");
                var floors = document.getElementById("floor");

                let bed = document.querySelector(".bedroom");
                let kitch = document.querySelector(".garages");
                let cr = document.querySelector(".cr");
                let floor = document.querySelector(".floor");
                header.innerText = data[0];
                if (type == "House" || type == "House and Lot") {
                    bed.innerText = data[1];
                    kitch.innerText = data[2];
                    cr.innerText = data[3];
                    floor.innerText = data[4];

                    rooms.style.display = "block";
                    garages.style.display = "block";
                    crs.style.display = "block";
                    floors.style.display = "block";
                } else {
                    rooms.style.display = "none";
                    garages.style.display = "none";
                    crs.style.display = "none";
                    floors.style.display = "none";
                }
                $('#detailsModal').modal('show');

            }
        });

    });

    $(".btn_details").on("click", function() {
        var dataId = $(this).attr("data-id");
        $.ajax({
            method: 'POST',
            dataType: 'JSON',
            url: "z-amenities.php",
            data: {
                dataId: dataId
            },
            success: function(data) {
                console.log(data);
                if (Array.isArray(data)) {
                    data.forEach(function(ame) {
                        // Select the element and get its HTML content
                        var amenity = $(".amenities");
                        var html = amenity.html();
                        // Append a new list item to the HTML content
                        html += "<li style='list-style:none;'>&#8226;" + ame +
                            "</li>";
                        // Set the updated HTML content back to the element
                        amenity.html(html);
                    });
                }
                $('#detailsModal').modal('show');
            }
        });

    });

    $(".btn_photos").on("click", function() {
        var dataId = $(this).attr("data-id1");
        $.ajax({
            method: 'POST',
            dataType: 'JSON',
            url: "z-image.php",
            data: {
                dataId: dataId
            },
            success: function(d) {

                if (d.success) {

                    d.seller_property_photos.forEach(function(i) {
                        $(".img_con").html($(".img_con").html() +
                            "<div class='col-md-4'> <div class='image'><img src='../uploads/" +
                            i.photos +
                            "' data-ajax='" + i
                            .id + "'id='i" + i
                            .id + "'></div></div>");
                    })
                    $('#imagesModal').modal('show');
                    document.querySelectorAll('.image-container img').forEach(image => {
                        image.onclick = () => {
                            document.querySelector('.popup-image').style
                                .display = 'block';
                            document.querySelector('.popup-image img').src =
                                image.getAttribute('src');
                        }
                    })

                    document.querySelector('.popup-image span').onclick = () => {
                        document.querySelector('.popup-image').style.display =
                            'none';
                    }
                } else {
                    alert('No images found');
                }
            }
        });

    });

    $(".show-loc").on("click", function() {
        var dataId = $(this).attr("data-id2");
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: "z-get_location.php",
            data: {
                dataId: dataId
            },
            success: function(data) {
                var lat = data[0];
                var lng = data[1];
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

            }
        });

    });

    $(".btn_approved").on("click", function() {
        var dataId = $(this).attr("data-id3");
        var dataId1 = $(this).attr("data-id2");
        // console.log(dataId, dataId1)
        $.ajax({
            method: 'POST',
            url: "z-approved.php",
            data: {
                dataId: dataId,
                dataId1: dataId1
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Approved',
                    text: 'New Property Approved',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(function() {
                    // this gets run after the OK button is clicked
                    window.location = 'posted.php';
                });

            }
        });

    });
    $('#imagesModal').on('hidden.bs.modal', function() {
        location.reload();
    })
    $('#detailsModal').on('hidden.bs.modal', function() {
        location.reload();
    })
    $('#location-map').on('hidden.bs.modal', function() {
        location.reload();
    })

});
</script>