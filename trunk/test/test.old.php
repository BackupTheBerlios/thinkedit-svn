<?php

// Various tasks done with the api :
// this could be used to test the system on a blank DB

require_once 'init.inc.php';

// init DB

//$db = $thinkedit->getDb();
//$db->query('delete from folder');
//$db->query('delete from node');


// check if we have a root :
if ($thinkedit->newModuleByNode(0))
{
$root = $thinkedit->newModuleByNode(0);
}
else
{
$root = $thinkedit->newModule('folder');
$root->save();
$root->saveAsRoot();
}

$root->setTitle('Homepage');
$root->save();





// Create first category
$news = $thinkedit->newModule('folder');
$news->setTitle('News');
$news->save();

// append news to root
$root->addChild($news);


// create an article and locate it under news
$article = $thinkedit->newModule('article');
$article->setTitle('An article');
$news->addChild($article);


// what is under this article ?
$childs = $article->getChilds();
if (is_array($childs))
{
  foreach ($childs as $child)
  {
    echo $child->getTitle();
    // add a picture to each article
    $child->addChild($thinkedit->newModule('image'));
  }
}



// what is under node id 0 ?
$mynode = $thinkedit->newModuleByNode(0);
debug($mynode->id);
debug($mynode->type);
$mynode->load();



// post a message to mynode (arbitrary defined)
$post = $thinkedit->newModule('post');
$post->setTitle('Do you agree?');
$post->set('message', 'here we go gentlemens');
$post->save();

$mynode->addChild($post);
// or
$post->addParent($mynode); // will this work ???



// relate this post to the news category
$relation = new relation();
$relation->makeRelation($post, $news);
// or
$post->makeRelation($news);


// Append an image file to the post :
$image = $thinkedit->newModule('image');
// load image data here
$image->setContent($imagedata);
$image->save();
$post->makeRelation($image);
//or
$image->makeRelation($post);


?>