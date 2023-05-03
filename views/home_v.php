<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include_once('views/template/head.php');
    ?>
</head>

<body>
    <div id="app">
        <?php
        include_once('views/template/header.php');
        ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <img src="<?= URL ?>/public/font-png/menu-24.png" alt="">
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><?php echo $_SESSION['username']; ?></h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><?php echo $_SESSION['rolname']; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#" id="CloseSession">Cerrar Sesión</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Portal reporte de horarios </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            BIENVENIDOS
                        </div>
                    </div>
                </section>
            </div>
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