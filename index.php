<?php




require_once __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'vt.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'session.php';
$vt = new Vt();


require_once __DIR__ . DIRECTORY_SEPARATOR . 'requires' . DIRECTORY_SEPARATOR . 'head.php';

$session = new SecureSession();
$session->checkSession();

$token = $_SESSION['csrf_token'];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'requires' . DIRECTORY_SEPARATOR . 'sidebar.php'; ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'requires' . DIRECTORY_SEPARATOR . 'navbar.php'; ?>
      <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'requires' . DIRECTORY_SEPARATOR . 'notification.php'; ?>
      <!--  Header End -->

      <div class="container-fluid">
        <?php



        if (isset($_GET['sayfa']) && !empty($_GET['sayfa'])) {
          $sayfaAdi = rtrim($_GET['sayfa'], '.php');

          $sayfa = __DIR__ . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $sayfaAdi . ".php";

          $session->checkPremission($sayfaAdi);

          if (file_exists($sayfa)) {
            include_once $sayfa;
          }else {
            include_once __DIR__ . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . "baslangic.php"; // Varsayılan sayfa
          }
        } else {
          include_once __DIR__ . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . "baslangic.php"; // Varsayılan sayfa
        }


        ?>
      </div>

    </div>
  </div>
  <script src="<?= Helper::base_panel_url('') ?>assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?= Helper::base_panel_url('') ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= Helper::base_panel_url('') ?>assets/js/sidebarmenu.js"></script>
  <script src="<?= Helper::base_panel_url('') ?>assets/js/app.min.js"></script>
  <script src="<?= Helper::base_panel_url('') ?>assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="<?= Helper::base_panel_url('') ?>assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="<?= Helper::base_panel_url('') ?>assets/js/dashboard.js"></script>
</body>

</html>