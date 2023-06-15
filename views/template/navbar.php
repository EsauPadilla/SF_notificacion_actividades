<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-2 pe-2" href="<?= URL ?>home/dashboard"><img src="<?= URL ?>public/assets/img/logo/logo.png" class="img-fluid" alt="Logo" srcset=""></a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar nombre de ususario -->
    <div class="ms-auto me-0 me-md-3 my-2 my-md-0 text-white">
        <h4><?php echo $_SESSION['username']; ?></h4>
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= URL ?>perfil/configurar_perfil">configurar perfil</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#!" id="CloseSession">Cerrar Sesión</a></li>
            </ul>
        </li>
    </ul>
</nav>