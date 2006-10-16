<?php
require_once '../thinkedit.init.php';
require_once ROOT . '/class/tree.class.php';


echo '<pre>';

$tree = new tree();
// we start at "root"
$tree->setNodeId(1);


$tree->addChild('article', 'table', '5');

foreach ($tree->getChildren() as $node)
{
	print_r ($node);
}




?>
