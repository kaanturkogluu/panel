<?php
require_once __DIR__ . '/helper.php';

class Vt
{
    protected $baglanti;

    // Varsayılan olarak `.env` dosyasındaki değerleri kullan
    function __construct($host = null, $user = null, $pass = null, $dbname = null)
    {
        try {
            Helper::loadEnv();

            // Parametreler boşsa `.env` dosyasından al
            $host = $host ?? getenv('DB_HOST');
            $user = $user ?? getenv('DB_USER');
            $pass = $pass ?? getenv('DB_PASS');
            $dbname = $dbname ?? getenv('DB_NAME');

            // PDO bağlantısını oluştur
            $this->baglanti = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Hata modunu aktif et
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Varsayılan veri çekme modunu dizi yap
            ]);

        } catch (PDOException $error) {
            die("Veritabanı bağlantı hatası: " . $error->getMessage());
        }
    }

    // 🔹 **Dinamik olarak farklı bir veritabanına geçiş yap**
    public function setDatabase($host, $user, $pass, $dbname)
    {
        try {
            $this->baglanti = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function getConnection()
    {
        return $this->baglanti;
    }

    public function veriGetir($innerjoin = 0, $tablo,  $wherealanlar = "", $wherearraydeger = [])
    {
        try {
            $sql = ($innerjoin == 1) ? $tablo : "SELECT * FROM " . $tablo;
            if (!empty($wherealanlar)) {
                $sql .= " " . $wherealanlar;
            }

            $calistir = $this->baglanti->prepare($sql);
            $sonuc = $calistir->execute($wherearraydeger);

            return $sonuc ? $calistir->fetchAll() : false;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function sorguCalistir($tablosorgu, $alanlar = "", $degerlerarray = [])
    {
        try {
            $this->baglanti->beginTransaction();
            $sql = $tablosorgu . " " . $alanlar;

            if (!empty($degerlerarray)) {
                $calistir = $this->baglanti->prepare($sql);
                $sonuc = $calistir->execute($degerlerarray);
            } else {
                $sonuc = $this->baglanti->exec($sql);
            }

            $this->baglanti->commit();
            return true;
        } catch (PDOException $e) {
            $this->baglanti->rollback();
            return false;
        }
    }

    public function sorguCalistirSonIdAl($tablosorgu, $alanlar = "", $degerlerarray = [])
    {
        try {
            $this->baglanti->beginTransaction();
            $sql = $tablosorgu . " " . $alanlar;

            if (!empty($degerlerarray)) {
                $calistir = $this->baglanti->prepare($sql);
                $sonuc = $calistir->execute($degerlerarray);
            } else {
                $sonuc = $this->baglanti->exec($sql);
            }

            $lastInsertId = $this->baglanti->lastInsertId();
            $this->baglanti->commit();
            return $lastInsertId;

        } catch (PDOException $e) {
            $this->baglanti->rollback();
            return false;
        }
    }
}

