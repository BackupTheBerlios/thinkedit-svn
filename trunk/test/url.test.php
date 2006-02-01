<?php

require_once '../class/url.class.php';
require_once '../class/record.class.php';
require_once '../thinkedit.init.php';

$url = new url;

$url->setParam('id', 7);
$url->setParam('action', 'move');
$url->setParam('locale', 'en');

$url->unSetParam('id');

echo '<pre>';

echo $url->render();


// try it with ./url.test.php?test_class=record&test_type=article&test_id=5
// and with url.test.php?test_class=record&test_type=article

echo $url->getParam('test');

$record = new record('article');
$record->set('id', 5);

$url->addObject($record, 'my_');
echo '<hr>';
echo $url->render();

$object = $url->getObject('test_');
$object->load();
echo '<hr>';
print_r($object);


?>