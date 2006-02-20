<?php

/******************* Init *******************/
//user
//thinkedit
require_once('thinkedit.init.php');

require_once ROOT . '/class/url.class.php';


// helpers classes :
//url
$url = new url();


/******************** Cache **************************/
/*
// TODO todo : use thinkedit->cache-> etc...

require_once ROOT . '/lib/pear/cache/Lite/Output.php';
$options = array(
'cacheDir' => ROOT . '/tmp/',
'lifeTime' => 6000,
'pearErrorMode' => CACHE_LITE_ERROR_DIE
);

$cache = new Cache_Lite_Output($options);
*/



$page_id = 'node_' . $url->get('node_id');

//if (!($thinkedit->cache->start($page_id))) 
//{
		
		
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
		require_once ROOT . '/class/menu.breadcrumb.class.php';
		$breadcrumb = new menu_breadcrumb($node);
		
		require_once ROOT . '/class/menu.main.class.php';
		$main_menu = new menu_main();
		
		
		require_once ROOT . '/class/menu.child.class.php';
		$child_menu = new menu_child($node);
		
		require_once ROOT . '/class/menu.sitemap.class.php';
		$sitemap = new menu_sitemap($node);
		
		require_once ROOT . '/class/menu.context.class.php';
		$context_menu = new menu_context($node);
		
		
		/******************* Template helpers (aka "tags") *******************/
		require_once ROOT . '/lib/thinkedit/template.lib.php';
		
		/******************* Choose template *******************/
		// Which design ?
		
		$design = $thinkedit->configuration->getDesign();
		
		// find the right template
		// if  a file called $content->getType .template.php exists, it is used as the template else, we use content.template.php
		
		$template_file = ROOT . '/design/'. $design . '/' . $content->getType() . '.template.php';
		
		if (!file_exists($template_file))
		{
				$template_file = ROOT . '/design/'. $design .'/content.template.php';
		}
		
		
		
		
		/******************* Render *******************/
		
		
		// include header
		include(ROOT . '/design/'. $design .'/header.template.php');
		
		// include template
		include($template_file);
		
		// include footer
		include(ROOT . '/design/'. $design .'/footer.template.php');
    //$thinkedit->cache->end();
//}

echo 'Total Queries : ' . $thinkedit->db->getTotalQueries();

?>
