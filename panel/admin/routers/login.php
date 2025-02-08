<?php
require_once dirname(__DIR__) . '/classes/session.php';
require_once dirname(__DIR__) . '/classes/login.php';
require_once dirname(__DIR__) . '/classes/Helper.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {


    $login  = new Login();

    // Kullanıcı giriş bilgilerini alıyoruz
    $userData = $login->login(Helper::post("password"), Helper::post("username"));


    // Giriş başarılıysa, kullanıcı verilerini oturuma ekliyoruz
    if ($userData !== false && count($userData) > 0) {
        $session = new SecureSession();
        $sessionData = array(
            'username' => $userData[0]["email"],
            'session' => true,
            'userid' => $userData[0]['id']
        );

        $permission = $login->getUserPermission($userData[0]['id']);



        $session->setUserPermissions($permission);




        // Oturum verilerini oluştur
        $session->createSession($sessionData);



        // Başarılı oturum sonrası çıktıyı ekrana yazdır
        header('Location:' . Helper::goDashboardPage('baslangic'));
        exit;
    } else {
        // Giriş başarısızsa kullanıcıyı bilgilendir
        $session = new SecureSession();
        $session->setSessionMessage("Geçersiz Kullanıcı Adı Veya Şifre", "error");
        $session->redirectLogin();
    }
}
