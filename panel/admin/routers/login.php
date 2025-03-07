<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "session.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "login.php";

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . "helper.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {



    $login  = new Login();


    // Kullanıcı giriş bilgilerini alıyoruz
    $userData = $login->Mylogin(Helper::post("password"), Helper::post("username"));


    // Giriş başarılıysa, admin  verilerini oturuma ekliyoruz
    if ($userData !== false && count($userData) > 0) {
        $session = new SecureSession();
        $sessionData = array(
            'username' => $userData[0]["email"],
            'session' => true,
            'userid' => $userData[0]['id'],
            'sessionType' => 'admin'
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
