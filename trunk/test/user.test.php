<?php
require_once '../thinkedit.init.php';
//require_once ROOT . '/class/record.class.php';

debug('test', 'test');

$thinkedit->user->login('yourlogin', 'yourpassword');


print_r($user);
?>
