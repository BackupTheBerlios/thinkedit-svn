<?php
require_once '../init.inc.php';
require_once '../class/auth.class.php';
require_once '../class/user.class.php';

$auth = new auth();
$auth->login('admin', 'secret');


$user = new user();


?>