<?php
require_once '../thinkedit.init.php';
//require_once ROOT . '/class/record.class.php';




$article = $thinkedit->newRecord('article');


//$article->id = 1;

if ($article->load())
{
	echo $article->title;
	echo '<br>';
	echo $article->body;
	
	$article->title = 'hopekes';
	echo $article->save();
}
else
{
	echo ('Not found, not loaded');
}

$article->title = 'This is a test';

echo $article->save();

echo '<pre>';
print_r($article);
?>
