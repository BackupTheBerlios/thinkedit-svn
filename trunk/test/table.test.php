<?php
require_once '../init.inc.php';
require_once ROOT . '/class/table.class.php';


$table = new table('article');
//$table->limit(0,1);
$table->filter('title', 'like', '%bi%');



echo '<pre>';

echo $table->count();

print_r ($table->select());

?>
