<?php
require_once '../init.inc.php';
require_once '../class/page.class.php';

$page = new page();

$page->startPanel('test', 'This is a test');
$page->endPanel('test');

echo $page->render();

?>