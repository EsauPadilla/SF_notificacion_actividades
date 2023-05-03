<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include_once('views/template/head.php');
    ?>
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
                                    <li class="breadcrumb-item"><a
                                            href="index.html"><?php echo $_SESSION['rolname']; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                            id="CloseSession">Cerrar Sesión</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title"> Lista de Usuarios </h4>
                                <button type="button" class="btn btn-lg btn-primary" id="btnSignup">
                                    <img src="<?= URL ?>/public/font-png/adduser-24.png" alt="">
                                    <span>Agregar Usuario</span>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped" id="tablaUsuarios">

                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="Label" aria-hidden="true" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white" id="titulo">Registro de Usuario</h5>
                                            <button type="button" class="btn-close btn-close-white" aria-label="Cerrar"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div id="auth-left">
                                            <form id="formulario" autocomplete="off">
                                                <div class="modal-body">
                                                    <div class="form-group position-relative has-icon-left mb-4">
                                                        <input type="hidden" id="id" name="id">
                                                        <input type="text" class="form-control form-control-xl"
                                                            placeholder="Nombre" id="name">
                                                        <div class="form-control-icon">
                                                            <img src="<?=URL?>/public/font-png/contactos-24.png" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group position-relative has-icon-left mb-4">
                                                        <input type="text" class="form-control form-control-xl"
                                                            placeholder="Correo" id="user">
                                                        <div class="form-control-icon">
                                                            <img src="<?=URL?>/public/font-png/contactos-24.png" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group position-relative has-icon-left mb-4">
                                                        <input type="password" class="form-control form-control-xl"
                                                            placeholder="Contraseña" id="pass">
                                                        <div class="form-control-icon">
                                                            <img src="<?=URL?>/public/font-png/llave-24.png" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group position-relative has-icon-left mb-4">
                                                        <input type="password" class="form-control form-control-xl"
                                                            placeholder="Confirmar Contraseña" id="repass">
                                                        <div class="form-control-icon">
                                                            <img src="<?=URL?>/public/font-png/llave-24.png" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        id="btnAccion">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
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
    <script src="<?= URL ?>public/js/user.js"></script>
    <script src="<?=URL?>public/Assets/js/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</body>

</html>