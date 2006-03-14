<?php

die();
// xdebug_start_profiling();
require_once '../thinkedit.init.php';


$node_record = $thinkedit->newRecord('node');

$nodes_id = $node_record->find();

foreach ($nodes_id as $node_id)
{
		$node = $thinkedit->newNode();
		$node->setId($node_id->getId());
		$node->load();
		echo $node->updatePath();
}


?>
