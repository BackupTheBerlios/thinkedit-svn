<?php
require_once '../thinkedit.init.php';

echo '<pre>';

$filesystem = $thinkedit->newFilesystem();


print_r($filesystem);

$childrens = $filesystem->getChildren();


foreach ($childrens as $children)
{
  echo '<h2>' . $children->getFilename() .'</h2>';
  echo $children->getTitle();
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
