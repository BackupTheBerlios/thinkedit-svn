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


/******************** Cache **************************/

require_once ROOT . '/lib/pear/cache/Lite/Output.php';
$options = array(
'cacheDir' => ROOT . '/tmp/',
'lifeTime' => 7200,
'pearErrorMode' => CACHE_LITE_ERROR_DIE
);
$cache = new Cache_Lite_Output($options);




$page_id = 'node_' . $url->get('node_id');

if (!($cache->start($page_id))) 
{
		
		
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
    $cache->end();
}

$db = $thinkedit->getDb();
echo 'Total Queries : ' . $db->getTotalQueries();

?>
