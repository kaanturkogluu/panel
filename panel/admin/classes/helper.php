<?php
class Helper
{
    // XSS saldırılarına karşı veriyi güvenli hale getirir
    public static function cleaner($data)
    {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    // POST isteği içinden veriyi alır ve temizler
    public static function post($key)
    {
        return isset($_POST[$key]) ? self::cleaner(trim($_POST[$key])) : null;
    }

    public static function redirectMainPage()
    {
        echo '<meta http-equiv="refresh" content="0;url=' . self::base_panel_url() . '">';
    } public static function redirect($page)
    {
        echo '<meta http-equiv="refresh" content="0;url=' . self::base_site_url($page) . '">';
    }
    // Site panel URL'sini döner
    public static function base_panel_url($url = '')
    {
        self::loadEnv();
        return getenv('BASE_URL') . 'panel/admin/' . $url;
    }

    // Site ana URL'sini döner
    public static function base_site_url($url = '')
    {
        self::loadEnv();
        return getenv('BASE_URL') . $url;
    }

    public static function base_customer_panel_url($link=""){

        return Helper::base_site_url('panel/customers/'.$link);
    }
    public static function createQuillEditor($name, $height = 200, $edit = false)
{
    $editorId = "editor_" . $name;
    $hiddenFieldId = "hiddenContent_" . $name;

    // CDN'leri sadece bir kez yüklemek için kontrol
    static $quillLoaded = false;
    if (!$quillLoaded) {
        echo '<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">';
        echo '<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>';
        $quillLoaded = true; // Bir kez yüklendikten sonra tekrar yüklenmez
    }

    // Editör Alanı ve Gizli Alan
    echo '<div id="' . $editorId . '" style="height: ' . $height . 'px; border: 1px solid #ccc;"></div>';
    echo '<textarea name="' . $name . '" id="' . $hiddenFieldId . '" style="display:none;"></textarea>';

    // Editör Başlatma Scripti
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const quill = new Quill("#' . $editorId . '", {
                theme: "snow"
            });

            // Eğer düzenleme modundaysa içeriği yükle
            ' . ($edit ? 'quill.root.innerHTML = "' . addslashes($edit) . '";' : '') . '

            // Text değiştiğinde içerik gizli alana yazılır
            quill.on("text-change", function() {
                document.getElementById("' . $hiddenFieldId . '").value = quill.root.innerHTML;
            });
        });
    </script>';
}


    public static function generateToken($length = 16)
    {

        return bin2hex(random_bytes(16));;
    }


    // .env dosyasını yükler
    public static function loadEnv($path = __DIR__ . '/../.env')
{
    if (!file_exists($path)) {
        throw new Exception('.env dosyası bulunamadı.');
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        // Yorum satırlarını atla
        if (strpos(trim($line), '#') === 0 || !strpos($line, '=')) {
            continue;
        }

        list($name, $value) = array_pad(explode('=', $line, 2), 2, '');

        // Boş olan değişkenleri de putenv() ile ekleyelim
        putenv(sprintf('%s=%s', trim($name), trim($value)));
    }
}


    // Yönlendirici dosya yolu oluşturur
    public static function routers($routerName)
    {
        return self::base_panel_url('routers/' . $routerName . '.php');
    }



    public static  function getUserIpAdr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // Check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Check ip from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // This is the IP address from the remote address
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    // Yönlendirme fonksiyonu
    public static function conditionalCustomerRedirect($url, $message, $isSuccess = true)
    {
        // Mesajı URL'ye uygun bir şekilde kodla
        $encodedMessage = urlencode($message);
        // Başarı durumuna göre mesajın anahtarını belirle
        $messageKey = $isSuccess ? 'success' : 'error';
        // URL'yi, mesajı ve durumu birleştirerek tam bir URL oluştur
        $redirectUrl = Helper::base_customer_panel_url('index.php?sayfa=' . $url) . '&' . $messageKey . '&mesaj=' . "$message";
        // Header ile yönlendir
        header("Location: $redirectUrl");
        // Kodun devamını engelle
        exit();
    }
    public static function conditionalRedirect($url, $message, $isSuccess = true)
    {
        // Mesajı URL'ye uygun bir şekilde kodla
        $encodedMessage = urlencode($message);
        // Başarı durumuna göre mesajın anahtarını belirle
        $messageKey = $isSuccess ? 'success' : 'error';
        // URL'yi, mesajı ve durumu birleştirerek tam bir URL oluştur
        $redirectUrl = Helper::base_panel_url('index.php?sayfa=' . $url) . '&' . $messageKey . '&mesaj=' . "$message";
        // Header ile yönlendir
        header("Location: $redirectUrl");
        // Kodun devamını engelle
        exit();
    }


    public static function goPage($page)
    {
        return self::base_site_url('index.php?sayfa=' . $page);
    }

    public static function searchPage($page, $paramname, $param)
    {
        $param = self::cleaner($param);
        $paramname = self::cleaner($paramname);
        $page = self::cleaner($page); // Eğer page de temizlenmeli ise
        return self::base_site_url('index.php?sayfa=' . urlencode($page) . '&' . urlencode($paramname) . '=' . urlencode($param));
    }
    public static function dashboardSearchPage($page, $paramname, $param)
    {
        $param = self::cleaner($param);
        $paramname = self::cleaner($paramname);
        $page = self::cleaner($page); // Eğer page de temizlenmeli ise
        return self::base_panel_url('index.php?sayfa=' . urlencode($page) . '&' . urlencode($paramname) . '=' . urlencode($param));
    }

    // Dashboard sayfasına yönlendirme
    public static function goDashboardPage($page)
    {
        return self::base_site_url('panel/admin/index.php?sayfa=' . $page);
    }
    public static function goCustomerDashboardPage($page)
    {
        return self::base_site_url('panel/customers/index.php?sayfa=' . $page);
    }



    // SEO için diziyi düzenler
    public static function seo($s)
    {
        $tr = ['ş', 'Ş', 'ı', 'I', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç', '(', ')', '/', ':', ',', '?', '_'];
        $eng = ['s', 's', 'i', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c', '', '', '-', '-', '', '', '-'];
        $s = str_replace($tr, $eng, $s);
        return strtolower(trim(preg_replace('/[-]+/', '-', preg_replace('/\s+/', '-', str_replace('.', '', $s))), '-'));
    }

    // URL'yi doğrular
    public static function validateUrl($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    // Dosya yükleme fonksiyonu
    const DEFAULT_ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/gif'];
    const DEFAULT_MAX_SIZE = 10 * 1024 * 1024; // 10 MB

    public static function uploadPhoto($file, $uploadDir, $maxSize = self::DEFAULT_MAX_SIZE, $allowedTypes = self::DEFAULT_ALLOWED_TYPES)
    {
        // Adresleme images klasörü base adres sayılıp yapılacak
        $uploadDir = __DIR__ . '/../../../images/' . $uploadDir;


        // Hata kontrolü
        if ($file['error'] !== UPLOAD_ERR_OK || !in_array($file['type'], $allowedTypes) || $file['size'] > $maxSize) {
            return false;
        }

        $unique_name = uniqid('', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        return move_uploaded_file($file['tmp_name'], $uploadDir . $unique_name) ? $unique_name : false;
    }
    const DEFAULT_MAX_SIZE_DUMP = 5 * 1024 * 1024; // 5 MB
    const DEFAULT_ALLOWED_TYPES_DUMP = ['application/octet-stream', 'text/plain'];

    public static function uploadSqlDump($file, $uploadDir, $maxSize = self::DEFAULT_MAX_SIZE_DUMP, $allowedTypes = self::DEFAULT_ALLOWED_TYPES_DUMP)
    {
        // Hedef dizin
        $uploadDir = __DIR__ . '/../dumps/' . $uploadDir;

        // Hedef dizin yoksa oluştur
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                return false; // Dizin oluşturulamadı
            }
        }

        // Hata kontrolü
        if (
            $file['error'] !== UPLOAD_ERR_OK || // Dosya yükleme hatası
            $file['size'] > $maxSize || // Dosya boyutu sınırı
            !in_array($file['type'], $allowedTypes) || // Dosya tipi kontrolü
            pathinfo($file['name'], PATHINFO_EXTENSION) !== 'sql' // Uzantı kontrolü
        ) {
            return false; // Geçersiz dosya
        }

        // Benzersiz bir dosya adı oluştur
        $unique_name = uniqid('dump_', true) . '.sql';

        // Dosyayı taşı ve sonuç döndür
        return move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $unique_name) ? $unique_name : false;
    }
}
