<?php
require_once '../thinkedit.init.php';
//require_once ROOT . '/class/record.class.php';




$article = $thinkedit->newRecord('article');


//$article->set('id', 1);
//$article->set('locale', 'fr');



if ($article->load())
{
	echo $article->get('title');
	// or
	echo '<hr>';
	echo $article->get('body');
	echo '<hr>';
	$article->set('title', 'hopekes');
	echo $article->save();
	echo '<hr>';
}
else
{
	echo ('Not found or not loaded');
}

$article->set('title', 'This is a t svsv v sdest');
echo '<hr>';
echo $article->save();
echo '<hr>';

echo '<pre>';
print_r($article);
?>
