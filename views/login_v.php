<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SF</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?=URL?>public/css/styles.css">
    <link rel="stylesheet" href="<?=URL?>public/css/pages/auth.css">
    <link rel="icon" href="<?=URL?>public/assets/img/logo/favicon.png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Inicio de Sesion</h1>
                    <form autocomplete="off" id="frmLogin">

                        <div class="form-group has-feedback position-relative has-icon-left mb-4">
                            <i class="fas fa-image-portrait form-control-feedback"></i>
                            <input type="text" class="form-control form-control-xl" placeholder="Correo" id="txtUser">
                        </div>

                        <div class="form-group has-feedback	position-relative has-icon-left mb-4">
                            <i class="fas fa-key form-control-feedback"></i>
                            <input type="password" class="form-control form-control-xl" placeholder="Contraseña"
                                id="txtPass">
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">
                            Iniciar sesión
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <div class= "text-center">
                        <img src="<?=URL?>public/assets/img/bg/bgw.png" class="img-fluid" alt="logo">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    var base_url = "<?php echo URL; ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?=URL?>public/js/jquery-3.6.3.min.js"></script>
    <script src="<?=URL?>public/js/sweetalert2.all.min.js"></script>
    <script src="<?=URL?>public/js/pages/session.js"></script>
</body>

</html>