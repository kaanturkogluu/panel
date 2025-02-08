<?php
require_once __DIR__ . '/helper.php';


class Vt
{

    protected  $baglanti;
    function __construct()
    {
        try {
            Helper::loadEnv();

            // Veritabanı bilgilerini çevre değişkenlerinden al
            $host = getenv('DB_HOST');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');
            $dbname = getenv('DB_NAME');

            $this->baglanti = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME') . ";charset=utf8",  getenv('DB_USER'),  getenv('DB_PASS'));
        } catch (PDOException $error) {
            echo $error->getMessage();
            exit();
        }
    }

    public function getConnection()
    {

        return $this->baglanti;
    }

    public function veriGetir($innerjoin = 0, $tablo,  $wherealanlar = "", $wherearraydeger = [])
    {
        try {
            //   $this->baglanti->query("SET CHARACTER SET utf8");

            $sql = ($innerjoin == 1) ? $tablo : "SELECT * FROM " . $tablo;
            if (!empty($wherealanlar)) {
                $sql .= " " . $wherealanlar;
            }
            if (!empty($orderby)) {
                $sql .= " " . $orderby;
            }
            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            $calistir = $this->baglanti->prepare($sql);



            $sonuc = $calistir->execute($wherearraydeger);

            if ($sonuc) {
                $veri = $calistir->fetchAll(PDO::FETCH_ASSOC);
                if ($veri && !empty($veri)) {
                    return $veri;
                }
            }
            return false;
        } catch (PDOException $e) {
            error_log("Veri getirme hatası: " . $e->getMessage()); // Günlüğe hata yaz
            return false;
        }
    }




    public function sorguCalistir($tablosorgu, $alanlar = "", $degerlerarray = [])
    {
        try {

            $this->baglanti->beginTransaction(); // İşlemi başlat

            // $this->baglanti->query("SET CHARACTER SET utf8");
            $sql = $tablosorgu . " " . $alanlar;
            

            if (!empty($degerlerarray)) {
                $calistir = $this->baglanti->prepare($sql);
                $sonuc = $calistir->execute($degerlerarray);
            } else {
                $sonuc = $this->baglanti->exec($sql);
            }

            $this->baglanti->commit(); // İşlemi tamamla
            return true; // Başarılı olursa true döndür

        } catch (PDOException $e) {
            // Hata olursa işlemi geri al ve false döndür
            if ($this->baglanti->inTransaction()) {

                $this->baglanti->rollback();
            }

            echo $e->getMessage();
            error_log("Veritabanı hatası: " . $e->getMessage()); // Günlüğe hata yaz
            return false;
        }
    }
    public function sorguCalistirSonIdAl($tablosorgu, $alanlar = "", $degerlerarray = [])
    {
        try {
            $this->baglanti->beginTransaction(); // İşlemi başlat

            //  $this->baglanti->query("SET CHARACTER SET utf8");
            $sql = $tablosorgu . " " . $alanlar;
            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            if (!empty($degerlerarray)) {
                $calistir = $this->baglanti->prepare($sql);
                $sonuc = $calistir->execute($degerlerarray);
            } else {
                $sonuc = $this->baglanti->exec($sql);
            }

            // Son eklenen ID'yi al
            $lastInsertId = $this->baglanti->lastInsertId();

            $this->baglanti->commit(); // İşlemi tamamla
            return $lastInsertId; // Son eklenen ID'yi döndür

        } catch (PDOException $e) {
            // Hata olursa işlemi geri al ve false döndür
            $this->baglanti->rollback();
            echo $e->getMessage();
            error_log("Veritabanı hatası: " . $e->getMessage()); // Günlüğe hata yaz
            return false;
        }
    }

 
}

