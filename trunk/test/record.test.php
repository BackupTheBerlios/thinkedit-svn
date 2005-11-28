<?php
require_once '../thinkedit.init.php';
//require_once ROOT . '/class/record.class.php';




$article = $thinkedit->newRecord('article');


$article->set('id', 1);



if ($article->load())
{
	echo $article->get('title');
	// or
	echo '<br>';
	echo $article->get('body');
	
	$article->set('title', 'hopekes');
	echo $article->save();
}
else
{
	echo ('Not found, not loaded');
}

$article->set('title', 'This is a test');

echo $article->save();

echo '<pre>';
print_r($article);
?>
