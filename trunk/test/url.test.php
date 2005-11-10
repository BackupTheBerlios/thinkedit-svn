<pre>
<?php

require_once '../class/url.class.php';

$url = new url;

$url->setParam('id', 7);
$url->setParam('action', 'move');
$url->setParam('locale', 'en');

$url->unSetParam('id');

echo $url->render();

echo '<hr>';

echo $url->getParam('test');

?>