<?php

require_once '../thinkedit.init.php';


require_once ROOT . '/class/interface_locale.class.php';

$interface_locale = new interface_locale();

$interface_locale->translate('test');


$translation = $thinkedit->newRecord('translation');

$translations = $translation->find();

foreach ($translations as $tr)
{
		echo $tr->get('translation_id');
		echo ' : ';
		echo $tr->get('translation');
		echo "\n";
}



?>
