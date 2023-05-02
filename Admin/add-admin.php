<?php include 'header.php';  ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<style>
.text-wrap {
    white-space: normal;
}

.width-200 {
    width: 200px;
}
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Admin Accounts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin Accounts</li>
                <li class="breadcrumb-item active">Add Admin Accounts</li>
            </ol>
        </nav>

        <form enctype="multipart/form-data" id="signupForm" class="row g-3 needs-validation">
            <div class="col-6 px-2">
                <label for="yourName" class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" id="yourName" required>
                <div class="invalid-feedback">Please, enter your name!</div>
            </div>
            <div class="col-6 px-2">
                <label for="yourContact" class="form-label">Contact Number:</label>
                <input type="text" name="contact" class="form-control" id="yourContact" required>
                <div class="invalid-feedback">Please, enter your Contact Number!</div>
            </div>
            <div class="col-6 px-2">
                <label for="image" class="form-label">Profile Picture:</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
                <div class="invalid-feedback">Please, enter your Profile Picture!</div>
            </div>
            <div class="col-6 px-2">
                <label for="yourEmail" class="form-label">Email:</label>

                <input type="email" name="email" class="form-control" id="yourEmail" required>


                <div class="invalid-feedback">Please enter a valid Email adddress!</div>
            </div>

            <div class="col-6 px-2">
                <label for="yourUsername" class="form-label">Username:</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" name="username" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Please choose a username.</div>
                </div>
            </div>

            <div class="col-6 px-2">
                <label for="yourPassword" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" id="yourPassword" required>
                <div class="invalid-feedback">Please enter the password!</div>
            </div>
            <div class="col-12 px-2">

                <button style="float:right; width: 150px;" type="submit" id="adminBtn" class="btn btn-primary"><i
                        class="fas fa-plus"></i> Add Admin</button>

            </div>
        </form>
    </div><!-- End Page Title -->
</main>

<?php include 'footer.php'; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<script src="../assets/js/main.js"></script>

<script>
$(document).ready(function() {
    $("#adminBtn").click(function(e) {
        if ($('#signupForm')[0].checkValidity()) {
            e.preventDefault();
            var formData = new FormData($('#signupForm')[0]);
            formData.append('action', 'registerAdmin');
            $.ajax({
                url: 'php/action.php',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response === 'registerAdmin') {
                        Swal.fire({
                            icon: 'success',
                            text: 'Successfully Created an Account',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(function() {
                            // this gets run after the OK button is clicked
                            window.location = 'admin.php'
                        });

                    } else {
                        alert(response);
                    }
                }
            });

        }
    });
})
</script>