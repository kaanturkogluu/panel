<?php
$statu = "admin";
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

                <?php
                if ($statu == "admin") {
                ?>
                    <!-- İçerik Yönetimi -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu"> Yönetici</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?=Helper::goDashboardPage('duyurular/liste')?>" aria-expanded="false">
                            <span><i class="ti ti-file-text"></i></span>
                            <span class="hide-menu">Duyurular</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="index.php?sayfa=sayfalar" aria-expanded="false">
                            <span><i class="ti ti-file-text"></i></span>
                            <span class="hide-menu">Şikayet Listesi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="index.php?sayfa=sayfalar" aria-expanded="false">
                            <span><i class="ti ti-file-text"></i></span>
                            <span class="hide-menu">Personel</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="index.php?sayfa=sayfalar" aria-expanded="false">
                            <span><i class="ti ti-file-text"></i></span>
                            <span class="hide-menu">Ziyaretçi Listesi</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu"> Görevli</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="index.php?sayfa=sayfalar" aria-expanded="false">
                            <span><i class="ti ti-file-text"></i></span>
                            <span class="hide-menu">Personeller</span>
                        </a>
                    </li>
                <?php } ?>
                <?php
                if ($statu == "gorevli") {
                ?>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu"> Görevli</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= Helper::goDashboardPage('ziyaretci/kayit') ?>" aria-expanded="false">
                            <span><i class="ti ti-file-text"></i></span>
                            <span class="hide-menu">Ziyaretçi Kayıt</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= Helper::goDashboardPage('ziyaretci/liste') ?>" aria-expanded="false">
                            <span><i class="ti ti-file-text"></i></span>
                            <span class="hide-menu">Ziyaretçiler</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>