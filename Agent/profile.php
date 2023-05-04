<?php include 'header.php'; 
require_once 'php/connection.php';
global $con;
$user = $_SESSION['ID'];
$userID = implode($user);
$sql = "SELECT * FROM `seller_login` WHERE `id` = '$userID'";
$result = $con->query($sql);

$result3 = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result3);
$name = $row['name'];
$img = $row['image'];
?>

<div class="container">
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>

            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="../uploads/<?php echo $img ?>" alt="Profile" class="rounded-circle">
                            <h2 style="text-align:center;"><?= $name ?></h2>

                        </div>
                    </div>

                </div>
                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <?php
                        if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                        ?>
                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="profile-details row">
                                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row["name"] ?></div>
                                    </div>
                                    <br>
                                    <div class="profile-details row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row["address"] ?></div>
                                    </div>
                                    <br>
                                    <div class="profile-details row">
                                        <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row["contact_num"] ?></div>
                                    </div>
                                    <br>
                                    <div class="profile-details row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>


                                        <div class="col-lg-9 col-md-8"><?php echo $row["email"] ?><?php $verified = $row["verified"]; if($verified == 0){
                                            echo '&nbsp;<a href="verify.php?email='.$row["email"].'">Verify
                                            Now</a>';
                                        }
                                        else{
                                            echo '<span class="text-success">&nbsp;Already Verified</span>';
                                        }
                                        ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control" id="fullName"
                                                    value="<?php echo $row["name"] ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address"
                                                class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address"
                                                    value="<?php echo $row["address"] ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Contact
                                                Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone"
                                                    value="<?php echo $row["contact_num"] ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="<?php echo $row["email"] ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="password" value="<?php echo $row["password"] ?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <?php 
                        }}
                        ?>
                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>

<?php include 'footer.php'; ?>