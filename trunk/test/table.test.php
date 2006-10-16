<?php
require_once '../thinkedit.init.php';
require_once ROOT . '/class/table.class.php';


$table = new table('article');

if ($table->hasField('publish'))
{
		echo 'the table has the field publish';
}
else
{
		echo 'nope, we don\'t have this field here';
}


$table->createField('test', 'varchar', array('size' => 255) ); 

?>
