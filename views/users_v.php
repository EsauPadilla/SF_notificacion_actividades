<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once('views/template/head.php');
    ?>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= URL ?>public/css/pages/user.css">
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
                    <h1 class="mt-4">Administracion de Usuarios</h1>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Lista de Usuarios</h4>
                                        <button type="button" class="btn btn-lg btn-primary" id="btnSignup">
                                            <i class="fas fa-user-plus "></i>
                                            <span>   Agregar Usuario</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="tablaUsuarios">
                                        <thead>
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
                                                    <h5 class="modal-title text-white" id="titulo">Registro de Usuario
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" aria-label="Cerrar" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div id="auth-left">
                                                    <form id="formulario" autocomplete="off">
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="form-floating form-group has-feedback mb-3">
                                                                    <input type="hidden" id="id" name="id">
                                                                    <i class="fas fa-image-portrait form-control-feedback"></i>
                                                                    <input class="form-control" id="name" type="text" name="Nombre">
                                                                    <label for="" class="form-label">Nombre</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-floating form-group has-feedback mb-3">
                                                                    <i class="fas fa-envelope form-control-feedback"></i>
                                                                    <input class="form-control" id="user" type="text" name="Usuario">
                                                                    <label for="" class="form-label">Correo</label>
                                                                </div>
                                                            </div>

                                                            <div id="changePass" class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-floating form-group has-feedback mb-3">
                                                                        <i class="fas fa-key form-control-feedback"></i>
                                                                        <input class="form-control" id="pass" type="password" name="Contraseña">
                                                                        <label for="" class="form-label">Contraseña</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-floating form-group has-feedback mb-3">
                                                                        <i class="fas fa-shield form-control-feedback"></i>
                                                                        <input class="form-control" id="repass" type="password" name="ConfirmarContraseña">
                                                                        <label for="" class="form-label">Confirmar Contraseña</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-link" id="btnChangePass">Cambiar Contraseña</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
        window.base_url = "<?= URL ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?= URL ?>public/js/pages/user.js"></script>

</body>

</html>