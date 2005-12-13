<?php
require_once '../thinkedit.init.php';

echo '<pre>';

$filesystem = $thinkedit->newFilesystem();
print_r($filesystem);

$childrens = $filesystem->getChildren();


foreach ($childrens as $children)
{
  echo '<h1>' . $children->getFilename() .'</h1>';
  echo $children->getTitle();
  echo '<br>';
  echo $children->getContent();
  echo '<hr>';
}

print_r($childrens);


?>
