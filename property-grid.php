<?php include 'header.php';
require_once 'php/connection.php';
global $con;

// Get the total number of records from our table "students".

$total_pages = $con->query("SELECT * FROM `seller_property` WHERE approved = 'Yes' AND status = 'For Sale'")->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 6;

if ($stmt = $con->prepare("SELECT * FROM seller_property WHERE approved = 'Yes' AND status = 'For Sale' ORDER BY id LIMIT ?,?")) {
    // Calculate the page to get the results we need from our table.
    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute(); 
    // Get the results...
    $result = $stmt->get_result();
?>

<style>
.pagination-container {
    width: 100%;
    text-align: center;
}

.pagination {
    list-style-type: none;
    padding: 10px 0;
    display: inline-flex;
    justify-content: space-between;
    box-sizing: border-box;
}

.pagination li {
    box-sizing: border-box;
    padding-right: 10px;
}

.pagination li a {
    box-sizing: border-box;
    background-color: #e2e6e6;
    padding: 8px;
    text-decoration: none;
    font-size: 12px;
    font-weight: bold;
    color: #616872;
    border-radius: 4px;
}

.pagination li a:hover {
    background-color: #d4dada;
}

.pagination .next a,
.pagination .prev a {
    text-transform: uppercase;
    font-size: 12px;
}

.pagination .currentpage a {
    background-color: #518acb;
    color: #fff;
}

.pagination .currentpage a:hover {
    background-color: #518acb;
}
</style>

<body>
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single">Our Amazing Properties</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-curbuy="page">
                                    Properties
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section><!-- End Intro Single-->

        <!-- ======= Property Grid ======= -->



        <section class="property-grid grid">
            <div class="container">
                <div class="row">
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card-box-a card-shadow">
                            <div class="img-box-a">
                                <?php echo '<img src="uploads/'.$row["image"].'" alt="" class="img-a img-fluid">'; ?>

                            </div>
                            <div class="card-overlay">
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="#"> <?php echo $row['title']; ?></a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            <span class="price-a">buy | ₱ <?php echo $row['price']; ?></span>
                                        </div>
                                        <?php
                                            echo '<a href="property-single.php?id='.$row["id"].'" class="link-a">Click here
                                            to view
                                            <span class="bi bi-chevron-right"></span>
                                        </a>';
                                            ?>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">Area</h4>
                                                <span><?php echo $row['sqm']; ?>m
                                                    <sup>2</sup>
                                                </span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Beds</h4>
                                                <span>2</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Baths</h4>
                                                <span>4</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Garages</h4>
                                                <span>1</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </section>
        <br><br>
        <div class="pagination-container">
            <?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
            <ul class="pagination">
                <?php if ($page > 1): ?>
                <li class="prev"><a href="property-grid.php?page=<?php echo $page-1 ?>">Prev</a></li>
                <?php endif; ?>

                <?php if ($page > 3): ?>
                <li class="start"><a href="property-grid.php?page=1">1</a></li>
                <li class="dots">...</li>
                <?php endif; ?>

                <?php if ($page-2 > 0): ?><li class="page"><a
                        href="property-grid.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li>
                <?php endif; ?>
                <?php if ($page-1 > 0): ?><li class="page"><a
                        href="property-grid.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li>
                <?php endif; ?>

                <li class="currentpage"><a href="property-grid.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                </li>

                <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a
                        href="property-grid.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li>
                <?php endif; ?>
                <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a
                        href="property-grid.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li>
                <?php endif; ?>

                <?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
                <li class="dots">...</li>
                <li class="end"><a
                        href="property-grid.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a>
                </li>
                <?php endif; ?>

                <?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
                <li class="next"><a href="property-grid.php?page=<?php echo $page+1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
        </div>


    </main><!-- End #main -->

    <?php include 'footer.php'; ?>

</body>

</html>

<?php
    $stmt->close();
}
?>