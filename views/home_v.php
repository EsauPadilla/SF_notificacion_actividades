<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once('views/template/head.php');
    ?>

</head>

<body class="sb-nav-fixed">

    <?php
    include_once('views/template/navbar.php');
    ?>

    <div id="layoutSidenav">

        <?php
        include_once('views/template/sidenav.php');
        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Inicio</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Solution Factory</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Portal Reporte de Actividades</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    BIENVENIDOS
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php
            include_once('views/template/footer.php');
            ?>

        </div>
    </div>

    <?php
    include_once('views/template/globalScript.php');
    ?>

</body>

</html>