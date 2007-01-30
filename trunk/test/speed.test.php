<?php

require_once '../thinkedit.init.php';



$thinkedit->timer->marker('1000 fields generation starts');

for ($i=0; $i<1000; $i++)
{
$field = $thinkedit->newField('page', 'id');
}

$thinkedit->timer->marker('field generation stops');



$thinkedit->timer->marker('1000 records generation starts');

for ($i=0; $i<1000; $i++)
{
$record = $thinkedit->newRecord('page');
$record->getTitle();
}

$thinkedit->timer->marker('record generation stops');

echo $thinkedit->timer->render();


if (function_exists('xdebug_dump_function_profile') && !$thinkedit->isInProduction())
{
		xdebug_dump_function_profile(4);
}

?>
