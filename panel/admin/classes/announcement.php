<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "vt.php";

class Announcement extends Vt
{



    public function insert($data)
    {

        return  parent::sorguCalistir(
            "INSERT INTO announcements (title, content, announcement_type, announcement_date, announcement_time)",
            "VALUES (?, ?,? ,?,?  )",
            $data
        );
    }

    public function getAnnouncement()
    {
        return parent::veriGetir(0, "announcements", "", []);
    }
}
