<?php
require_once '../thinkedit.init.php';
echo '<pre>';

$node = $thinkedit->newNode();

//$node->setId(1);
//$node->save();

$node->loadRootNode();

$children = $node->getChildren();

foreach ($children as $child)
{
		$content = $child->getContent();
		$content->load();
		echo $content->getTitle();
		echo ' (order = ' . $child->getOrder() . ') ';
		echo ' (id = ' . $child->getId() . ') ';
		echo '<hr>';
}


$node = $thinkedit->newNode();
$node->load(45);


echo 'parent : ' . $node->debug();

echo '<hr>';

echo 'parent : ' . $node->get('parent_id');

echo '<hr>';

$node->moveBottom();

$siblings = $node->getSiblings();

foreach ($siblings as $sibling)
{
		$content = $sibling->getContent();
		$content->load();
		echo $content->getTitle();
		echo '<br/>';
}




?>
