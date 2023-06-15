<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">MENU</div>
                <a class="nav-link" href="<?= URL ?>home/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                    Inicio
                </a>
                <a class="nav-link" href="<?= URL ?>calendar/registrar_act">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                    Reportar horas
                </a>
                <?php if ($_SESSION['rolId'] == 1) {?>
                <a class="nav-link" href="<?= URL ?>users/administrar_usuarios">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                    Administrar Usuarios
                </a>
                <?php }?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Sesion de:</div>
            <?php echo $_SESSION['username']; ?>
        </div>
    </nav>
</div>