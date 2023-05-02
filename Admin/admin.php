<?php include 'header.php';  ?>

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
                <li class="breadcrumb-item active">Admin Accounts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <a href="add-admin.php" class="btn btn-primary btn-rounded mb-4">
        <i class="fas fa-plus"></i> Add Admin
    </a>
    <div class="table-responsive" id="showAdmin">

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
                action: 'fetchAdmin'
            },
            success: function(response) {
                $('#showAdmin').html(response);
                $("#adminTable").DataTable({
                    order: [0, 'desc'],
                    destroy: true,
                    paging: true,
                });
                $('#adminTable td').css('white-space', 'initial');
            }
        })
    }
})
</script>