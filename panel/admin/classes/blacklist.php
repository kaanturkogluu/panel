<?php
require_once __DIR__ . "/vt.php";

class Blacklist extends Vt
{

    private $userIp;
    private $lastBlockId;


    public function __construct()
    {

        $this->userIp = self::getUserIp();
    }

    public function getUserIP()
    {

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function checkUserDenied($ip = null)
    {

        $vt = new Vt();
        $res = $vt->veriGetir(0, "blacklist", "WHERE type='ip' AND  blockedValue=?", [$this->getip()]);

        if ($res) {
            return false;
        }
        return true;
    }
    public function setlastBlockId($id)
    {
        $this->lastBlockId = $id;
    }

    public function getip()
    {
        return $this->userIp;
    }
    public function getIpInfo()
    {
        $vt = new Vt();
        $details = json_decode(file_get_contents("http://ipinfo.io/{$this->userIp}/json"));
        $ip = $details->ip;
        $hostname = $details->hostname ?? null;
        $city = $details->city ?? null;
        $region = $details->region ?? null;
        $country = $details->country ?? null;
        $loc = $details->loc ?? null;
        $org = $details->org ?? null;
        $postal = $details->postal ?? null;
        $timezone = $details->timezone ?? null;
        $readme = $details->readme ?? null;
        $vt->sorguCalistir(
            "INSERT INTO ip_info (ip_address, hostname, city, region, country, loc, org, postal, timezone, readme,blacklistId) ",
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)",
            [
                $ip,
                $hostname,
                $city,
                $region,
                $country,
                $loc,
                $org,
                $postal,
                $timezone,
                $readme,
                $this->lastBlockId

            ]
        );
    }
    public function blockIP()
    {

        $vt = new Vt();


        $ekleme =  $vt->sorguCalistirSonIdAl(
            "INSERT INTO blacklist(blockedValue,`type`)",
            " VALUES(?,?)",
            [
                $this->userIp,
                'ip'
            ]
        );

        if ($ekleme) {
            $this->setlastBlockId($ekleme);
            $this->getIpInfo();
        }
    }

    public function blockMail() {}
}

 