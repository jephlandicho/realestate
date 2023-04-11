<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form enctype="multipart/form-data" id="signupForm"
                                        class="row g-3 needs-validation">
                                        <div class="col-12 px-2">
                                            <label for="yourName" class="form-label">Name:</label>
                                            <input type="text" name="name" class="form-control" id="yourName" required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <label for="yourAddress" class="form-label">Address:</label>
                                            <input type="text" name="address" class="form-control" id="yourAddress"
                                                required>
                                            <div class="invalid-feedback">Please, enter your address!</div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <label for="yourContact" class="form-label">Contact Number:</label>
                                            <input type="text" name="contact" class="form-control" id="yourContact"
                                                required>
                                            <div class="invalid-feedback">Please, enter your Contact Number!</div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <label for="image" class="form-label">Profile Picture:</label>
                                            <input type="file" name="image" class="form-control" id="image"
                                                accept="image/*" required>
                                            <div class="invalid-feedback">Please, enter your Profile Picture!</div>
                                        </div>
                                        <div class="passError">
                                        </div>
                                        <div class="col-12 px-2">
                                            <label for="yourEmail" class="form-label">Email:</label>

                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                required>


                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>

                                        <div class="col-12 px-2">
                                            <label for="yourUsername" class="form-label">Username:</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12 px-2">
                                            <label for="yourPassword" class="form-label">Password:</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <label for="yourPassword" class="form-label">Confirm Password:</label>
                                            <input type="password" name="password2" class="form-control"
                                                id="yourPassword2" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12 px-2">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox" value=""
                                                    id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept
                                                    the
                                                    <a href="#">terms and conditions</a></label>
                                                <div class="invalid-feedback">You must agree before submitting.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <p style=" margin-top: 15px;">Create Account As:</p>
                                            <center>
                                                <button type="submit" id="sellerbtn"
                                                    class="btn btn-primary">Agent</button>
                                                <button type="submit" id="buyerbtn"
                                                    class="btn btn-secondary">Buyer</button>
                                            </center>
                                        </div>
                                        <div class="col-12 px-2">
                                            <p class="small mb-0">Already have an account? <a href="index.php">Log
                                                    in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

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

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <script>
    $(document).ready(function() {
        $("#sellerbtn").click(function(e) {
            if ($('#signupForm')[0].checkValidity()) {
                e.preventDefault();
                if ($("#yourPassword").val() != $("#yourPassword2").val()) {
                    alert('Password did not matched!')

                } else {
                    var formData = new FormData($('#signupForm')[0]);
                    formData.append('action', 'registerSeller');
                    $.ajax({
                        url: 'php/action.php',
                        method: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response === 'registerSeller') {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Successfully Created an Account',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then(function() {
                                    // this gets run after the OK button is clicked
                                    window.location = '../Agent/'
                                });

                            } else {
                                alert(response);
                            }
                        }
                    });
                }
            }
        });

        $("#buyerbtn").click(function(e) {
            if ($('#signupForm')[0].checkValidity()) {
                e.preventDefault();
                if ($("#yourPassword").val() != $("#yourPassword2").val()) {
                    alert('Password did not matched!')

                } else {
                    var formData = new FormData($('#signupForm')[0]);
                    formData.append('action', 'registerBuyer');
                    $.ajax({
                        url: 'php/action.php',
                        method: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response === 'registerBuyer') {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Successfully Created an Account',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then(function() {
                                    // this gets run after the OK button is clicked
                                    window.location = '../Customer/'
                                });

                            } else {
                                alert(response);
                            }
                        }
                    });
                }
            }
        });
    })
    </script>
</body>

</html>