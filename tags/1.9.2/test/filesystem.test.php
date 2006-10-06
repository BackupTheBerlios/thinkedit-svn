<?php
require_once '../thinkedit.init.php';

echo '<pre>';

$filesystem = $thinkedit->newFilesystem();

debug($filesystem->getPath(), 'getPath');
debug($filesystem->getRealPath(), 'getRealPath');



print_r($filesystem);

$childrens = $filesystem->getChildren();


foreach ($childrens as $children)
{
  echo '<h2>' . $children->getFilename() .'</h2>';
  echo 'Title : ' . $children->getTitle();
	echo '<br/>';
	echo 'Real Path : ' . $children->getRealPath();
	echo '<br/>';
	echo 'Url : ' . $children->getUrl();
	echo '<br/>';
	echo 'Icon : ' . $children->getIcon();
	
	
  echo '<br>';
  //echo $children->getContent();
  echo '<hr>';
}


echo '<h1>List of paths found :</h1>';

$paths = $filesystem->getFolderListRecursive();

foreach ($paths as $path)
{
  echo '<h2>' . $path->getFilename() .'</h2>';
  echo $path->getTitle();
  echo '<br>';
  //echo $children->getContent();
  echo '<hr>';
}



//print_r($childrens);




?>
