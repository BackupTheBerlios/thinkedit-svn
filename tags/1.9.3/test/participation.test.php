<?php
require_once '../thinkedit.init.php';

require_once ROOT . '/class/participation.class.php';


$participation = new participation('page');

// overwrite default some participate messages (you shoud use translate() here)
$participation->success_message = 'You did it!';
$participation->title = 'It\'s time to participate';

// send me a mail when soething new is posted
$participation->notification_email = 'test_email@test_email.com';

echo $participation->render();


?>
