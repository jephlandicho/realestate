<?php
  session_start();
  if(isset($_SESSION['customer_username'])){
    header('location:main.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Customer Login</title>
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
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="../assets/img/favicon.png" alt="">
                                    <span class="d-none d-lg-block"><span style="color: black;">Lupa</span>Bahay</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Welcome Customer!</h5>

                                    </div>

                                    <form class="row g-3 needs-validation" id="login-form">

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" id="LoginBtn"
                                                type="submit">Login</button>
                                        </div>
                                    </form>
                                    <br>
                                    <p class="small mb-0">Doesn't have an account? <a href="../signup.php">Sign up
                                        </a></p>
                                    <p class="small mb-0"> <a href="#" id="forgot-link">Forgot Password?
                                        </a></p>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
    <div class="modal" id="modal-forgotpass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-dark">RESET PASSWORD</h3>
                </div>
                <div class="modal-body">
                    <p id="up-message" class="text-dark"></p>
                    <form id="modal-form">
                        <label style="font-size:12px;"> Email </label>
                        <input type="email" class="form-control my-2" placeholder="Email" id="email" name="email"
                            required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_reset_pass">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS Files -->
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
    <script type="text/javascript">
    $(document).ready(function() {

        // for login
        $("#LoginBtn").click(function(e) {
            if ($("#login-form")[0].checkValidity()) {
                e.preventDefault();
                $(this).val("Please Wait...");
                $.ajax({
                    url: 'php/action.php',
                    method: 'post',
                    data: $('#login-form').serialize() + '&action=customerLogin',
                    success: function(response) {
                        if (response === 'customerLogin') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Welcome',
                                text: 'Successfully Login',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(function() {
                                // this gets run after the OK button is clicked
                                // window.location = 'main.php';
                                window.location = 'survey.php';
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Wrong Credentials!',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(function() {
                                // this gets run after the OK button is clicked
                                window.location = 'index.php';
                            });
                        }
                    }
                });
            }
        });
    });
    // for resetting password
    $(document).on('click', '#forgot-link', function() {
        $('#modal-forgotpass').modal('show');
    })

    $('#btn_reset_pass').click(function(e) {
        if ($("#modal-form")[0].checkValidity()) {
            e.preventDefault();
            $('#btn_reset_pass').val('Please Wait...');

            $.ajax({
                url: 'php/action.php',
                method: 'POST',
                data: $("#modal-form").serialize() + '&action=forgotpass',
                success: function(response) {
                    $("#btn_reset_pass").val('Reset Password');
                    $("#modal-form")[0].reset();
                    $("#up-message").html(response);
                }
            })
        }
    })
    </script>
</body>

</html>