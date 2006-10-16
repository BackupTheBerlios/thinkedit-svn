<?php
require_once ('../thinkedit.init.php');
require_once (ROOT . '/class/array2xml.class.php');

$array2xml = new array2xml();
$config = $thinkedit->config;



echo '<h1>Config xml</h1>';
echo '<code>';
echo '<pre>';
print_r($array2xml->convert($config));
echo '</pre>';

echo '<hr>';

echo '<h1>Config array</h1>';
echo '<pre>';
print_r($config);
echo '</pre>';

?>
