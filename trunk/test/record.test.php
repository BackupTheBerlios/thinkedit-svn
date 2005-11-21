<?php
require_once '../thinkedit.init.php';
require_once ROOT . '/class/record.class.php';


$article = new record('article');


$article->id = 1;

if ($article->load())
{
	echo $article->title;
	echo '<br>';
	echo $article->body;
}
else
{
	echo ('not loaded');
}

?>
