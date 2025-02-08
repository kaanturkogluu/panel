<?php
// require_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR .'classess'. DIRECTORY_SEPARATOR.'session.php';
require_once __DIR__ . '/../classes/session.php';
$session = new SecureSession();
$session->logout();
exit;
