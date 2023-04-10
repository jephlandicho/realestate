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
        <h1>Posted Property</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Posted Property</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="table-responsive" id="showPosted">

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
                action: 'fetchPosted'
            },
            success: function(response) {
                $('#showPosted').html(response);
                $("#postedTable").DataTable({
                    order: [0, 'desc'],
                    destroy: true,
                    paging: true,
                });
                $('#postedTable td').css('white-space', 'initial');
            }
        })
    }
})
</script>