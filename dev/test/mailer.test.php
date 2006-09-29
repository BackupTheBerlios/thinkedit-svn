<?php
require_once '../thinkedit.init.php';

require_once ROOT . '/class/mailer.class.php';


$mailer = new mailer();

// this is the normal use case 
// (uncomment the following for testing, but change email adresses please :-) ): 
/*
$mailer->setTo('philippe.jadin@gmail.com');
$mailer->setFrom('test@test.com');

$mailer->setSubject('This is a test message');
$mailer->setBody('And you are reading it ?!?');

if ($mailer->send())
{
		echo 'mail sent';
}
else
{
		echo 'failed to send mail';
}
*/


?>
