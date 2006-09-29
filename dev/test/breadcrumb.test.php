<?php
require_once '../init.inc.php';
require_once ROOT . '/class/breadcrumb.class.php';

$breadcrumb = new breadcrumb();


$breadcrumb->add('Home', 'home.php');
$breadcrumb->add('Clients', 'clients.php');
$breadcrumb->add('Acme Production', 'clients.php?id=7');
// adding a crumb without url will render it without url
$breadcrumb->add('Acme Production Details');

echo $breadcrumb->render();

?>
