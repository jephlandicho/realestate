<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Saved Properties</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Saved Properties</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="container">
            <div class="table-responsive" id="showProperties">
            </div>


        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        fetchPosted();

        function fetchPosted() {
            $.ajax({
                url: 'php/action.php',
                method: 'post',
                data: {
                    action: 'fetchProperties'
                },
                success: function(response) {
                    $('#showProperties').html(response);
                    $("#propertiesTable").DataTable({
                        order: [0, 'desc'],
                        destroy: true,
                        paging: true,
                    });
                    $('#propertiesTable td').css('white-space', 'initial');
                }
            })
        }
    })
    </script>