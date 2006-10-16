<?php
require_once '../thinkedit.init.php';

$node = $thinkedit->newNode();
$node->loadRootNode();


$page = $thinkedit->newRecord('page');

$title = 'testing ' . rand(1, 100);
echo "title is $title";

$page->setTitle($title);

$page->save();

$new_node = $node->add($page);

debug($db_cache, 'db cache before');

$new_node->publish();

debug($db_cache, 'db cache after');

$nodes = $node->getChildren();
echo '<h1>all children</h1>';
foreach ($nodes as $node)
{
		echo $node->getTitle() . '<br/>';
}


?>
