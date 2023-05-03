<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><img src="<?= URL ?>/public/font-png/menu-24.png" alt=""></a>
                </div>
            </div>
            <div class="justify-content">
                <div class="logo">
                    <a href="<?= URL ?>home/dashboard"><img src="<?= URL ?>public/assets/images/logo/logo.png" class="img w-100 h-100" alt="Logo" srcset=""></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  ">
                    <a href="<?= URL ?>home/dashboard" class='sidebar-link'>
                        <img src="<?= URL ?>/public/font-png/home-24.png" alt="">
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="<?= URL ?>calendar/calendar_v" class='sidebar-link'>
                        <img src="<?= URL ?>/public/font-png/calendar-24.png" alt="">
                        <span>Reportar horas</span>
                    </a>
                </li>
                <?php if ($_SESSION['rolId'] == 1) {?>
                    <li class="sidebar-item  ">
                        <a href="<?= URL ?>users/users_V" class='sidebar-link'>
                            <img src="<?= URL ?>/public/font-png/adduser-24.png" alt="">
                            <span>Administrar Usuarios</span>
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>