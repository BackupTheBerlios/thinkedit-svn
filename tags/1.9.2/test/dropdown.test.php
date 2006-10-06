<?php
require_once '../init.inc.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/session.class.php';

$session = new session();

$dropdown = new dropdown();
$dropdown->setId('test');

$session->persist($dropdown);

$dropdown->add('1', 'Option 1');
$dropdown->add('2', 'Option 2');
$dropdown->add('3', 'Option 3');


$dropdown->setTitle('Please choose one option');


if ( $dropdown->getSelected() )
{
	echo 'you\'ve selected the item : ' . $dropdown->getSelected() . '<p>';
}
else
{
	echo 'you have\'nt selected any item<p>';
}

echo $dropdown->render();

print_r($_SESSION);


?>
