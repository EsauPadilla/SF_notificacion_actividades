<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SF</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=URL?>public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?=URL?>public/assets/css/app.css">
    <link rel="stylesheet" href="<?=URL?>public/assets/css/pages/auth.css">
    <link rel="icon" href="<?=URL?>public/assets/images/favicon.png">
</head>
<body>
	<div id="auth">
        
		<div class="row h-100">
		    <div class="col-lg-5 col-12">
		        <div id="auth-left">
		            <h1 class="auth-title">Inicio de Sesion</h1>
		            <form autocomplete="off" id="frmLogin">
		                <div class="form-group position-relative has-icon-left mb-4">
		                    <input type="text" class="form-control form-control-xl" placeholder="Correo" id="txtUser">
							<div class="form-control-icon">
								<img src="<?=URL?>/public/font-png/contactos-24.png" alt="">
							</div>
		                </div>
		                <div class="form-group position-relative has-icon-left mb-4">
		                    <input type="password" class="form-control form-control-xl" placeholder="Contraseña" id="txtPass">
		                	<div class="form-control-icon">
								<img src="<?=URL?>/public/font-png/llave-24.png" alt="">
							</div>
						</div>
		                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
		                Iniciar sesión
		            	</button>
		            </form>
		        </div>
		    </div>
		    <div class="col-lg-7 d-none d-lg-block">
		        <div id="auth-right">

		        </div>
		    </div>
		</div>

    </div>
    <script>
    	var base_url = "<?php echo URL; ?>";
    </script>
	<script src="<?=URL?>public/assets/js/jquery-3.6.3.min.js"></script>
	<script src="<?=URL?>public/Assets/js/sweetalert2.all.min.js"></script>
	<script src="<?=URL?>public/js/session.js"></script>
</body>
</html>