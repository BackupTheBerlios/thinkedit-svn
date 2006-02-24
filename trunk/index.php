<?php

/******************* Init *******************/
//user
//thinkedit
require_once('thinkedit.init.php');
require_once ROOT . '/class/url.class.php';


// helpers classes :
//url
$url = new url();


$cache_id = 'node_' . $url->get('node_id');

$cache_enabled = true;
//$cache_enabled = false;

if ($url->get('refresh'))
{
		if ($thinkedit->outputcache->get($cache_id))
		{
				$thinkedit->outputcache->remove($cache_id);
		}
}

if ($url->get('clear_cache'))
{
		$thinkedit->outputcache->clean();
}


if ($cache_enabled && $thinkedit->outputcache->start($cache_id))
{
		echo 'Total Queries : ' . $thinkedit->db->getTotalQueries();
		echo '<br/>';
		echo 'Total time : ' . $thinkedit->timer->render();
		
		$url->keep('node_id');
		$url->set('refresh', 1);
		echo '<br/>';
		echo '<a href="' . $url->render() . '">Refresh</a>';
		
		$url = new url();
		$url->keep('node_id');
		$url->set('clear_cache', 1);
		echo '<br/>';
		echo '<a href="' . $url->render() . '">Clear cache</a>';
		
		xdebug_dump_function_profile(3);
		
		exit; 
}
else
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
		
		
		/******************* Relations *******************/
		$relation = $thinkedit->newRelation();
		
		
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
		
		require_once ROOT . '/class/menu.sibling.class.php';
		$sibling_menu = new menu_sibling($node);
		
		
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
    
		
		
		if ($cache_enabled)
		{
				$thinkedit->outputcache->end();
		}
	
}

echo 'Total Queries : ' . $thinkedit->db->getTotalQueries();
echo '<br/>';
echo 'Total time : ' . $thinkedit->timer->render();

xdebug_dump_function_profile(4) 
?>
