<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
	include 'header.php';
    $user = $_SESSION['ID'];
    $userID = implode($user);
    require_once 'php/connection.php';
    global $con;
    $query = "SELECT id FROM buyer_survey order by id desc";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['id'];

    $query2 = "SELECT * FROM buyer_survey";
    $result2 = mysqli_query($con,$query2);
    $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    $customer_ids = array_column($row2, 'customer');
    if (in_array($userID, $customer_ids)) {
        echo "<script> 
        window.location = 'main.php';
        </script>";
    }
    if(empty($lastid)){
        $number = "SRVY-01";
    }
    else
    {
        $idd = str_replace('SRVY-','',$lastid);
        $id = str_pad($idd + 1, 2, 0, STR_PAD_LEFT);
        $number = 'SRVY-'.$id;
    
    }

    

	if(isset($_POST['add'])){
		$type = $_POST['type'];
		$price = $_POST['price'];
        $price = str_replace(",", "", $price);

		$sql = " INSERT INTO `buyer_survey`(`id`, `type`, `price`, `customer`) VALUES ('$number','$type','$price','$userID')";
		
		if(mysqli_query($con, $sql)){
			echo "<script>
            Swal.fire({
                icon: 'success',
                text: 'Thank you for your cooperation',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then(function() {
                window.location = 'main.php';
             
            });

            	</script>";
		}
	}

    
    
 ?>

<style>
body {
    background-color: #f6f9ff;

}


form {

    margin: 50px auto;
    padding: 30px 30px;

}
</style>


<body>
    <section class="section-property section-t8">


        <div class="container col-md-6" style="background: white;">


            <!-- Create Form -->
            <form id="form" method="post">
                <div class="form-group">
                    <label for="role" id="question1" class="form-label">
                        What kind of property do you prefer?
                    </label>

                    <!-- Dropdown options -->
                    <select name="type" id="type" class="form-control">
                        <option value="House">House</option>
                        <option value="House and Lot">House and Lot</option>
                        <option value="Lot">Lot</option>
                        <option value="All">All</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <label for="price" class="form-label">
                        Specify the Price that you prefer. <em>(maximum price)</em>
                    </label>

                    <!-- multi-line text input control -->
                    <input name="price" id="price" pattern="[0-9,.]*" onkeyup="formatPrice(this)" class="form-control">
                    </input>
                </div>
                <br>
                <input class="btn btn-primary" type="submit" value="Submit" name="add" id='add' style="width: 100%;">
                </input>

        </div>

        <!-- Multi-line Text Input Control -->

        </form>

        </div>

    </section>
</body>

</html>
<script>
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