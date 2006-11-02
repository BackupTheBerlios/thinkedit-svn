<?php
require_once('../thinkedit.init.php');

$url = $thinkedit->newUrl();

$out = '';

if ($url->get('node_id'))
{
	
	$node = $thinkedit->newNode();
	
	$node->load($url->get('node_id'));
	
	if ($node->hasChildren())
	{
		$i=0;
		foreach ($node->getChildren() as  $node_item)
		{
			
			// reset node_info for next loop
			$node_info = false;
			
			/********************* Init *****************/
			
			$url = new url();
			$url->set('node_id', $node_item->getId());
			$content = $node_item->getContent();
			$content->load();
			
			$node_info['id'] = $node_item->getId();
			$node_info['title'] = te_short($node_item->getTitle(), 60); // . ' (' . $node_item->getOrder() . ')';
			$node_info['full_title'] = $node_item->getTitle();
			//$node_info['title'] .= $node_item->getLevel(); // . ' (' . $node_item->getOrder() . ')';
			$node_info['icon'] = $content->getIcon();
			$node_info['url'] = $url->render();
			$node_info['level'] = $node_item->getLevel() + 1;
			
			
			/********************* Visit link *****************/
			// a node can be "visited" only if it is allowed to add something inside it
			// else users could go inside a node and nothing could be done there
			if ($node_item->getAllowedItems())
			{
				$url = new url();
				$url->set('node_id', $node_item->getId());
				$node_info['visit_url'] = $url->render();
			}
			
			
			
			
			/********************* Delete link *****************/
			$url->set('action', 'delete');
			$node_info['delete_url'] = $url->render();
			
			
			/********************* Move links *****************/
			
			$url->set('action', 'moveup');
			$node_info['moveup_url'] = $url->render();
			
			$url->set('action', 'movetop');
			$node_info['movetop_url'] = $url->render();
			
			$url->set('action', 'movedown');
			$node_info['movedown_url'] = $url->render();
			
			$url->set('action', 'movebottom');
			$node_info['movebottom_url'] = $url->render();
			
			/********************* Edit link *****************/
			
			$url = new url();
			$url->set('node_id', $node_item->getId());
			$node_info['edit_url'] = $url->render('edit.php');
			
			/********************* Publish link *****************/
			if ($node_item->isPublished())
			{
				$url = new url();
				$url->set('node_id', $node_item->getId());
				$url->set('action', 'unpublish');
				$node_info['publish_url'] = $url->render();
				$node_info['publish_title'] = translate('unpublish');
				$node_info['published'] = 1;
				
			}
			else
			{
				$url = new url();
				$url->set('node_id', $node_item->getId());
				$url->set('action', 'publish');
				$node_info['publish_url'] = $url->render();
				$node_info['publish_title'] = translate('publish');
				$node_info['published'] = 0;
				
			}
			
			
			/********************* Preview link *****************/
			$url = new url();
			$url->set('node_id', $node_item->getId());
			$node_info['preview_url'] = $url->render('../index.php');
			$node_info['preview_title'] = translate('preview');
			
			
			/********* node is current ? *******/
			/*
			if ($node_item->getId() == $current_node->getId())
			{
				$node_info['is_current'] = true;
			}
			*/
			
			/********* Allowed items *******/
			$allowed_items = $node_item->getAllowedItems();
			if (is_array($allowed_items))
			{
				foreach ($allowed_items as $allowed_item)
				{
					if ($allowed_item['class'] == 'record')
					{
						$table = $thinkedit->newTable($allowed_item['type']);
						$item['title'] = $table->getTitle();
						$url = new url();
						$url->set('mode', 'new_node');
						$url->set('node_id', $node_item->getId());
						$url->addObject($table);
						$item['action'] = $url->render('edit.php');
						$node_info['allowed_items'][] = $item;
					}
				}
				
			}
			
			/******* clipboard links ****/
			/*
			include_once('../class/clipboard.class.php');
			$clipboard = new clipboard();
			*/
			
			$url = new url();
			$url->set('source_node', $node_item->getId());
			$url->set('action', 'cut');
			$node_info['clipboard']['cut_link'] = $url->render('clipboard.php');
			
			$url = new url();
			$url->set('source_node', $node_item->getId());
			$url->set('action', 'copy');
			$node_info['clipboard']['copy_link'] = $url->render('clipboard.php');
			
			
			$url = new url();
			$url->set('target_node', $node_item->getId());
			$url->set('action', 'paste');
			$node_info['clipboard']['paste_link'] = $url->render('clipboard.php');
			
			
			/******* locales links ****/
			if ($content->isMultilingual())
			{
				$locales = $thinkedit->configuration->getLocaleList();
				foreach ($locales as $locale)
				{
					$url = new url();
					$url->set('node_id', $node_item->getId());
					$content->setLocale($locale);
					$url->addObject($content);
					$url->set('mode', 'edit_node');
					$node_info['locale'][$locale]['edit_url'] = $url->render('edit.php');
					$node_info['locale'][$locale]['locale'] = $locale;
				}
			}
			
			
			/******* append this node info to out nodes list ****/
			$out['nodes'][] = $node_info;
			$i++;
			
		}
	}
}

include 'get_tree.template.php';
//print_r ($out);
?>
