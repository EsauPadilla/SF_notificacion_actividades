<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once('views/template/head.php');
    ?>
    <link rel="stylesheet" href="<?= URL ?>public/css/pages/perfil.css">
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
                    <h1 class="mt-4">Configuracion de perfil</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Solution Factory</li>
                    </ol>

                    <div class="row">
                        <form id="formulario" autocomplete="off" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <div class="profile-image" id="profile-image">
                                                    <img src=<?php echo $_SESSION['profile_image'] ?> alt="Imagen de perfil" id="profile-image-preview">>
                                                    <div class="overlay">
                                                        <p>Cambiar imagen</p>
                                                        <input type="file" id="profile-image-input" name="profile-image-input">
                                                    </div>
                                                </div>


                                                <div class="mt-4">
                                                    <h4>
                                                        <?php echo $_SESSION['name'] ?>
                                                    </h4>
                                                    <p class="text-secondary mb-1"><?php echo $_SESSION['rolname'] ?></p>
                                                    <p class="text-secondary mb-1"><?php echo $_SESSION['description'] ?></p>
                                                    <p class="text-muted font-size-sm"><?php echo $_SESSION['adress'] ?></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Nombre Completo</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" id="name" value="<?php echo $_SESSION['name'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Correo</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" id="user" value="<?php echo $_SESSION['username'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Telefono</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" id="phone" value="<?php echo $_SESSION['phone'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Direccion</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" id="adress" value="<?php echo $_SESSION['adress'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Descripcion</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" id="desc" value="<?php echo $_SESSION['description'] ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <button type="submit" class="btn btn-primary" id="btnAccion">Guardar Cambios</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script src="<?= URL ?>public/js/pages/perfil.js"></script>
</body>

</html>