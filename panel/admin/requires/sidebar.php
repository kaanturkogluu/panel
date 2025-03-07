<?php

$menuItems = $vt->veriGetir(1, "SELECT m.*,p.link FROM menu m RIGHT JOIN pages p ON m.pageId=p.id ", "WHERE m.active=1", []);

$pages = $vt->veriGetir(0, "pages");

// $mesajlar = $vt->veriGetir(1, "SELECT Count(*) as 'sayi' FROM customerMessage", "WHERE isRead=?", [0])[0];
$settings = $vt->veriGetir(0, "settings");

?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index.php" class="text-nowrap logo-img">
                <img src="<?= Helper::base_panel_url('') ?>/images/logo.jpeg" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- Dashboard -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Ana Panel</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index.php" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Anasayfa</span>
                    </a>
                </li>


                <!-- İçerik Yönetimi -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu Paneli </span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= Helper::goDashboardPage('menu/menu') ?>" aria-expanded="false">
                        <span><i class="ti ti-file-text"></i></span>
                        <span class="hide-menu">Ana Menu</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>