<?php

require_once ('../thinkedit.init.php');
require_once (ROOT . '/class/relation.class.php');



$articles = $thinkedit->newRecord('article');
$authors = $thinkedit->newRecord('author');

// get first article
$article = $articles->findFirst();

// get first author
$author = $authors->findFirst();


$relation = new relation();

debug($article);

debug($author);

$relation->relate($article, $author);
//$relation->unRelate($article, $author);

$relations = $relation->getRelations($article);

foreach ($relations as $related_item)
{
  $related_item->load();
  echo $related_item->getTitle();
}

echo $total_queries;

?>
