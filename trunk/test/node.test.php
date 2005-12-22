<?php
require_once '../thinkedit.init.php';


$node = $thinkedit->newNode();

//$node->setId(1);
//$node->save();

$node->load(1);
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
