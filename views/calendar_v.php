<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once('views/template/head.php');
    ?>
    <script src="<?= URL ?>public/js/moment-with-locales.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.3/index.global.min.js'></script>
    <link rel="stylesheet" href="<?=URL?>public/css/pages/calendar.css">
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
                    <h1 class="mt-4">Registro de Actividades</h1>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title"> Calendario </h4>
                                        <?php if ($_SESSION['rolId'] == 1) { ?>
                                            <button type="button" class="btn btn-primary" id="btnReport">
                                                <i class="far fa-file-lines"></i>
                                                <span>  Generar reporte</span>
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
                                                                    <select class="form-control" id="cliente" name="cliente">
                                                                    </select>
                                                                    <label for="" class="form-label">Cliente</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-floating mb-3">
                                                                    <select class="form-control" id="sitio" name="sitio"></select>
                                                                    <label for="" class="form-label">Sitio</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-floating mb-3">
                                                                    <select class="form-control" id="actividad" name="actividad">
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
    <script>
        var base_url = "<?php echo URL; ?>";
    </script>
    <script src="<?= URL ?>public/js/es.js"></script>
    <script src="<?= URL ?>public/js/pages/calendar.js"></script>

</body>

</html>