<?php

/******************* Init *******************/
//user
//thinkedit
require_once('thinkedit.init.php');

require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/menu.class.php';

// helpers classes :
//url
$url = new url();

/******************* Node *******************/

$node = $thinkedit->newNode();
if ($url->get('node_id'))
{
		$node->setId($url->get('node_id'));
		if (!$node->load())
		{
				//include(ROOT . '/design/default/header.template.php');
				include(ROOT . '/design/default/404.template.php');
				//include(ROOT . '/design/default/footer.template.php');
				die();
		}
}
else
{
		$node->loadRootNode();
}

/******************* Content *******************/

$content = $node->getContent();
$content->load();


/******************* Menu *******************/
$menu = new menu($node);



/******************* Choose template *******************/
// find the right template
// todo : how ?



/******************* Render *******************/
// include header
include(ROOT . '/design/default/header.template.php');

// include template
include(ROOT . '/design/default/content.template.php');

// include footer
include(ROOT . '/design/default/footer.template.php');


?>
