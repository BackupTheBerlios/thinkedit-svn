<?php
require_once '../init.inc.php';
require_once '../class/browser.class.php';
require_once '../class/url.class.php';
require_once '../class/node.class.php';
require_once '../class/root.class.php';




$root = new root();

$browser = new browser($root);

echo $browser->render();

?>