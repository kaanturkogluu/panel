
<?php
define('classes', __DIR__ . "/panel/admin/classes/");
if (isset($_GET['sayfa']) && !empty($_GET['sayfa'])) {
    $sayfaAdi = rtrim($_GET['sayfa'], '.php');

    $sayfa = __DIR__ . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $sayfaAdi . ".php";

    $session->checkPremission($sayfaAdi);

    if (file_exists($sayfa)) {
        include_once $sayfa;
    } else {
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . "baslangic.php"; // Varsayılan sayfa
    }
} else {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . "baslangic.php"; // Varsayılan sayfa
}

?>