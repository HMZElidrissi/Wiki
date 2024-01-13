<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Wiki™</title>
    <link rel="stylesheet" href="assets/dashboard/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/dashboard/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("../views/backOffice/partials/_sidebar.php"); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../views/backOffice/partials/_navbar.php"); ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-xl-6 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Nombre total des wikis</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?= $stats['nbrOfWikis']; ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fab fa-wikipedia-w fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Nombre total des auteurs</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?= $stats['nbrOfAuthors']; ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-pen fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Nombre total des tags</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?= $stats['nbrOfTags']; ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-tags fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Nombre total des catégories</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?= $stats['nbrOfCategories']; ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-folder fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../views/backOffice/partials/_footer.php"); ?>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/dashboard/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/dashboard/js/chart.min.js"></script>
    <script src="assets/dashboard/js/bs-init.js"></script>
    <script src="assets/dashboard/js/theme.js"></script>
</body>

</html>