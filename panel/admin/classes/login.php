<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "vt.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "session.php";


class Login extends Vt
{

    public function resetUserSession(){

        $session = new SecureSession();
        $session->destroySession();
    }
    public function  Mylogin($pass, $username)
    {
        $pass = htmlspecialchars($pass);
        $username = htmlspecialchars($username);
        return  parent::veriGetir(0, "users", "WHERE email = ? AND password=?", [$username, $pass]);
    }
    public function getUserPermission($userId)
    {

        return parent::veriGetir(1, "SELECT permissionPage FROM permissions", "WHERE user_id=?", [$userId]);
    }
    public function  customerlogin($pass, $username)
    {
        $pass = htmlspecialchars($pass);
        $username = htmlspecialchars($username);
        return  parent::veriGetir(0, "customers", "WHERE email = ? AND password=?", [$username, $pass]);
    }

}
