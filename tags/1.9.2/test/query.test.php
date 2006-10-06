<?php

require_once '../thinkedit.init.php';
require_once '../class/query.class.php';

$query = new query();

$query->addTable('roles');
$query->addWhere('id', '=', 5);

echo $query->getSelectQuery();
echo '<hr>';


$query->addValue("id", "5 and the like's");
$query->addValue("role", "john");
echo $query->getInsertQuery();


?>