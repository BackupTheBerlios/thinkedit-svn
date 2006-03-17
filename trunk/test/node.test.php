<?php
require_once '../thinkedit.init.php';

$thinkedit->timer->marker('hop');

$node = $thinkedit->newNode();

//$node->setId(1);
//$node->save();

//$node->loadRootNode();
$node->setId(48);

//$node->rebuild();

$nodes = $node->getAllChildren();


foreach ($nodes as $node)
{
		echo $node->getTitle() . '<br/>';
		echo $node->getLevel() . '<br/>';
}


echo $thinkedit->timer->render();

die();

/*
$article = $thinkedit->newRecord('article');

$a_article = $article->findFirst();

$node->add($a_article);
*/

$children = $node->getChildren();

debug ($children, 'Childrens of this node');

foreach ($children as $child)
{
  $content = $child->getContent();
  $content->load();
  echo $content->getTitle();
  echo '<hr>';
}


?>
