<?php

require_once __DIR__ . "/helper.php";

class SecureSession
{
    const SESSION_TIMEOUT = 30000; // 5 dakika (300 saniye)
    const SESSION_NAME = 'secure_session'; // Oturum adı

    public function __construct()
    {
        $this->secureSession();

        // Oturum başlatılmadıysa başlatıyoruz
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token']) || $_SESSION['csrf_token'] == null) {

            $_SESSION['csrf_token'] = $this->generateToken();
        }

        // Güvenlik önlemleri:
        // Oturum süresi kontrolü (5 dakika geçtiyse, oturumu kapat)
        if (isset($_SESSION['start_time']) && (time() - $_SESSION['start_time']) > self::SESSION_TIMEOUT) {
            $this->destroySession();
            self::redirectLogin();
        }

        // Eğer oturum başlatıldıysa, zaman damgasını kaydediyoruz
        if (!isset($_SESSION['start_time'])) {
            $_SESSION['start_time'] = time(); // Oturum başlama zamanını kaydet
        }
    }

    

    // CSRF Token Kontrolü
    public function validateCsrfToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $token) {
            // Token eşleşmiyorsa hata ver
            self::setSessionMessage("Geçersiz CSRF Token", "error");
            self::logout();
        }
    }



    public function generateToken($length = 16)
    {

        return bin2hex(random_bytes(16));;
    }
    // Oturum başlatırken güvenlik önlemleri
    private function secureSession()
    {

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }

        // Güvenli oturum çerezi ayarları
        session_set_cookie_params([
            'lifetime' => 0, // Çerez ömrü (sonlandırma değil)
            'path' => '/', // Çerezin geçerli olduğu yol
            'domain' => '', // Alan adı (belirli bir alan adıyla sınırlı)
            'secure' => true, // HTTPS üzerinden geçmesini sağlamak
            'httponly' => true, // JavaScript ile erişilememe (XSS koruması)
            'samesite' => 'Strict' // CSRF saldırılarına karşı koruma
        ]);
    }

    public function setUserPermissions($permissionArray)
    {

        foreach ($permissionArray as $key => $value) {
            // İzin sayfası değerini doğrudan ekleyin
            $_SESSION['permission'][] = $value['permissionPage'];  // [0] => 'duyurular/ekle', [1] => 'duyurular/liste' şeklinde ekler
        }
    }
    public function checkPremission($page)
    {
        $hasPermission = false;

        // $_SESSION['permission']'ı kontrol et
        if (isset($_SESSION['permission']) && is_array($_SESSION['permission'])) {
            foreach ($_SESSION['permission'] as $permission) {

                if (trim(strtolower($permission)) == "fullpermission") {
                    $hasPermission = true;
                    break;
                }
                if ($permission == $page) {
                    $hasPermission = true;
                    break;
                }
            }
        }


        if (!$hasPermission) {
            self::setSessionMessage("Yetkisiz Erişim Denemesi .  Zorunlu Çıkış Yaptırıldınız", "error");
            self::logout();
        }
    }

    // Session verilerini oluşturma fonksiyonu
    public function createSession($param): bool
    {
        foreach ($param as $key => $value) {
            if (is_string($value)) {
                // Sadece string veriler için htmlspecialchars uygulayın
                $_SESSION[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            } else {
                $_SESSION[$key] = $value;  // Diğer türlerde herhangi bir değişiklik yapma
            }

            // Eğer $_SESSION'da veri eklenemediyse, hata fırlatıyoruz
            if (!isset($_SESSION[$key]) || $_SESSION[$key] !== $value) {
                throw new Exception("Session verisi eklenemedi: $key");
            }
        }
        return true;  // Başarılı bir şekilde veri eklendi
    }

    // Oturumu kapatma fonksiyonu
    public function destroySession()
    {
        $_SESSION = array();
        session_unset();  // Oturum verilerini temizle
        session_destroy();  // Oturumu sonlandır
    }

    // Oturumun aktif olup olmadığını kontrol etme fonksiyonu
    public function isSessionActive(): bool
    {
        if (empty($_SESSION['userid'])) {
            return false;
        }
        // Eğer start_time mevcut ve zaman aşımı süresi geçmemişse oturum aktif sayılır
        if (isset($_SESSION['start_time']) && (time() - $_SESSION['start_time']) <= self::SESSION_TIMEOUT) {
            return true;
        }

        return false;
    }

    // Hata mesajı ayarlamak
    public function setSessionMessage($message, $statu = "success")
    {
        $_SESSION[$statu] = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        return;
    }
    public function checkSession()
    {
        if (!$this->isSessionActive()) {
            // Oturum aktif değilse kullanıcıyı login sayfasına yönlendir
            self::redirectLogin();
        }
    }
    // Çıkış yaparken oturumu kapatma
    public function logout()
    {
        $this->destroySession();
        // Kullanıcıyı login sayfasına yönlendirebilirsiniz
        if (!empty(isset($_SESSION['error']) || !empty(isset($_SESSION['success'])))) {

            self::setSessionMessage("Güvenli Çıkış Yapıldı", "success");
        }
        self::redirectLogin();
    }
    public function redirectLogin()
    {
        echo '<meta http-equiv="refresh" content="0;url=' . Helper::base_site_url('panel/login.php') . '">';
        exit();
    }
}
