<?php

function getDetails() {
    $conn = mysqli_connect("localhost","root","","realestate" ) or die ("error" . mysqli_error($conn));
    $property_id = $_POST['dataId'];
    $query = "SELECT * FROM `seller_property` WHERE seller_property.id='$property_id'";
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($result)){
        $Contentdata[0]=$row['more_info'];
        $Contentdata[1]=$row['bedroom'];
        $Contentdata[2]=$row['garages'];
        $Contentdata[3]=$row['cr'];
        $Contentdata[4]=$row['floor_sqm'];

    }
    echo json_encode($Contentdata);
}

function getAmenities() {
    $conn = mysqli_connect("localhost","root","","realestate" ) or die ("error" . mysqli_error($conn));
    $property_id = $_POST['dataId'];
    $query = "SELECT amenities FROM `amenities` INNER JOIN seller_property ON amenities.property_id = seller_property.id  WHERE amenities.property_id='$property_id'";
    $result = mysqli_query($conn,$query);
    $Contentdata = array();
    while ($row = mysqli_fetch_array($result)) {
        $Contentdata[] = $row['amenities'];
    }
    echo json_encode($Contentdata);
}

function getImages() {
    $conn = mysqli_connect("localhost","root","","realestate" ) or die ("error" . mysqli_error($conn));
    $property_id = $_POST['dataId'];
    $query = "SELECT id, photos FROM `seller_property_photos` WHERE property_id='$property_id'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)){
        $data = ["success" => true,"seller_property_photos" =>[]];
        while($row=mysqli_fetch_array($result)){
            array_push($data['seller_property_photos'],$row);
        }
        echo json_encode($data);
    }
    else{
        echo json_encode(['success'=>false]);
    }

}

function location() {
    $conn = mysqli_connect("localhost","root","","realestate" ) or die ("error" . mysqli_error($conn));
    $property_id = $_POST['dataId'];
    $query = "SELECT * FROM `seller_property` WHERE id='$property_id'";
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($result)){
        $Contentdata[0]=$row['latitude'];
        $Contentdata[1]=$row['longitude'];

    }
    echo json_encode($Contentdata);

}
function approved() {
    $conn = mysqli_connect("localhost","root","","realestate" ) or die ("error" . mysqli_error($conn));
    $seller_id = $_POST['dataId1'];
    $property_id = $_POST['dataId'];
    $query = "UPDATE `seller_property`
    SET approved = 'Yes' WHERE id='$property_id'";
    $result = mysqli_query($conn,$query);
    if(result){
        echo 'approved';
        $message = "Property Approved";
        $datetime = date('Y-m-d H:i:s');
        $notifquery = "INSERT INTO notifications VALUES ('','','$message','$seller_id','Agent','Posted','$datetime','Unread')";
        $result4 = mysqli_query($conn, $notifquery);
        if (!$result4) {
            echo "Error: " . mysqli_error($con);
          }
    }

}
function disapproved() {
    $conn = mysqli_connect("localhost","root","","realestate" ) or die ("error" . mysqli_error($conn));
    $seller_id = $_POST['dataId'];
    $property_id = $_POST['dataId1'];
    $name = $_POST['dataId2'];
    $query = "UPDATE `seller_property`
    SET approved = 'Disapproved' WHERE id='$property_id'";
    $result = mysqli_query($conn,$query);
    if(result){
        echo 'approved';
        $message = $name . " Disapproved";
        $datetime = date('Y-m-d H:i:s');
        $notifquery = "INSERT INTO notifications VALUES ('','','$message','$seller_id','Agent','Posted','$datetime','Unread')";
        $result4 = mysqli_query($conn, $notifquery);
        if (!$result4) {
            echo "Error: " . mysqli_error($con);
          }
    }

}
?>