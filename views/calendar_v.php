<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include_once('views/template/head.php');
    ?>

    <script src="<?= URL ?>public/Assets/js/moment-with-locales.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.3/index.global.min.js'></script>
    <link rel="stylesheet" href="<?= URL ?>public/assets/css/pages/calendar.css">
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
                                    <li class="breadcrumb-item active" aria-current="page"><a href="" id="CloseSession">Cerrar Sesión</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title"> Calendario de horas </h4>
                                <?php if ($_SESSION['rolId'] == 1) {?>
                                <button type="button" class="btn btn-lg btn-primary" id="btnReport">
                                    <img src="<?= URL ?>/public/font-png/adduser-24.png" alt="">
                                    <span>Generar reporte</span>
                                </button>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="card-body">
                            <div id='calendar'></div>
                            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="Label" aria-hidden="true" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white" id="titulo">Registro de horario</h5>
                                            <button type="button" class="btn-close btn-close-white" aria-label="Cerrar" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form id="formulario" autocomplete="off">
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="hidden" id="id" name="id">
                                                            <input type="hidden" id="dateend" type="time" name="dateend">
                                                            
                                                            <input id="title" type="text" class="form-control" name="title">
                                                            <label for="title">Titulo de Actividad</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="datestart" type="date" name="datestart" value="">
                                                            <label for="" class="form-label">Fecha</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="timestart" type="time" name="timestart" autocomplete="off">
                                                            <label for="" class="form-label">Hora inicio</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="timeend" type="time" name="timeend" autocomplete="off">
                                                            <label for="" class="form-label">Hora fin</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="ticket" type="text" name="ticket">
                                                            <label for="" class="form-label">Ticket</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <select class="form-control" id="client" name="client">
                                                            </select>
                                                            <label for="" class="form-label">Cliente</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-floating mb-3">
                                                            <select class="form-control" id="site" name="site"></select>
                                                            <label for="" class="form-label">Sitio</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-floating mb-3">
                                                            <select class="form-control" id="typeact" name="typeact">
                                                            </select>
                                                            <label for="" class="form-label">Tipo de actividad</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" id="description" name="description" row="3"></textarea>
                                                            <label for="" class="form-label">Decripcion de actividad</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                                                <button type="submit" class="btn btn-primary" id="btnAccion">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
    <script>
        var base_url = "<?php echo URL; ?>";
    </script>
    <script src="<?= URL ?>public/Assets/js/es.js"></script>
    <script src="<?= URL ?>public/js/calendar.js"></script>
</body>


</html>