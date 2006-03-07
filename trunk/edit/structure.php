<?php
/*
See licence.txt for licence

Structure manages any thinkedit (or other) class in a node tree
You can add existing / add new / delete nodes
For this, you have a popup browser

INPUT :
- node_id : id of the current node
- object_ : object on which to do an action
- action : add, delete, moveup, movedown, movetop, movebottom

*/

include_once('common.inc.php');

//check_user
check_user();

if ($url->get('info'))
{
		$out['info'] = translate($url->get('info'));
}


if ($url->get('error'))
{
		$out['error'] = translate($url->get('error'));
}


$current_node = $thinkedit->newNode();
if ($url->get('node_id'))
{
		$node_id = $url->get('node_id');
		$current_node->setId($node_id);
		
		if (!$current_node->load())
		{
				trigger_error('structure : node not found', E_USER_WARNING);
		}
		
		$we_are_root = false;
		$parent_node = $current_node->getParent();
}
else // we are in root
{
		$parent_node = false;
		$current_node->loadRootNode();
		$we_are_root = true;
}

debug($current_node, 'Current node init');



/********************* Edit action **********************/

// handle editing node thus we need to go to the parent
if ($url->get('mode') == 'edit_node')
{
		if ($parent_node)
		{
				$current_node = $parent_node;
		}
}



// handle adding new node from new record
if ($url->get('mode') == 'new_node')
{
		// todo : url loading of objects, universal object instancifier
		// done ??
		$object = $url->getObject('object_');
		$current_node->add($object);
		$url->keep('node_id');
		$url->redirect();
		
}


// handle adding new node from existing record
// it's the same

/********************* Delete action **********************/
// handle deleting node
if ($url->get('action') == 'delete')
{
		$node_to_delete = $current_node;
		
		if ($node_to_delete->getParent())
		{
				$current_node = $node_to_delete->getParent();
				if ($node_to_delete->delete())
				{
						$url->set('node_id', $current_node->getId());
						$url->set('info', 'node_deleted_successfully');
						$url->redirect();
						//$out['info'] = translate('node_deleted_successfully');
				}
				else
				{
						$url->keep('node_id');
						$url->set('error', 'node_not_deleted');
						$url->redirect();
						// $out['error'] = translate('node_not_deleted');
				}
		}
		else
		{
				$out['error'] = translate('cannot_delete_root_node');
		}
		
}

/********************* Publish action **********************/

if ($url->get('action') == 'publish')
{
		if ($current_node->publish())
		{
				
				$url->set('node_id', $parent_node->getId());
				$url->set('info', 'node_published_successfully');
				$url->redirect();
		}
		else
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('error', 'node_not_published');
				$url->redirect();
		}
		
}


if ($url->get('action') == 'unpublish')
{
		if ($current_node->unPublish())
		{
				
				$url->set('node_id', $parent_node->getId());
				$url->set('info', 'node_unpublished_successfully');
				$url->redirect();
		}
		else
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('error', 'node_not_unpublished');
				$url->redirect();
		}
		
}


/********************* Move action **********************/
if ($url->get('action') == 'moveup')
{
		//$node_to_move = $current_node;
		
		if ($current_node->moveUp())
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('info', 'node_moved_successfully');
				$url->redirect();
				//$out['info'] = translate('node_moved_successfully');
		}
		else
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('error', 'node_not_moved');
				$url->redirect();
				//$out['error'] = translate('node_not_moved');
		}
		
		// use parent node as current node, so we'll still show the right node bellow
		if (isset($parent_node))
		{
				$current_node = $parent_node;
		}
}


if ($url->get('action') == 'movedown')
{
		//$node_to_move = $current_node;
		
		if ($current_node->moveDown())
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('info', 'node_moved_successfully');
				$url->redirect();
		}
		else
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('error', 'node_not_moved');
				$url->redirect();
		}
		
		// use parent node as current node, so we'll still show the right node bellow
		if ($parent_node)
		{
				$current_node = $parent_node;
		}
}


if ($url->get('action') == 'movetop')
{
		//$node_to_move = $current_node;
		
		if ($current_node->moveTop())
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('info', 'node_moved_successfully');
				$url->redirect();
		}
		else
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('error', 'node_not_moved');
				$url->redirect();
		}
		
		// use parent node as current node, so we'll still show the right node bellow
		if ($parent_node)
		{
				$current_node = $parent_node;
		}
}

if ($url->get('action') == 'movebottom')
{
		//$node_to_move = $current_node;
		
		if ($current_node->moveBottom())
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('info', 'node_moved_successfully');
				$url->redirect();
		}
		else
		{
				$url->set('node_id', $parent_node->getId());
				$url->set('error', 'node_not_moved');
				$url->redirect();
		}
		
		// use parent node as current node, so we'll still shwo the right node bellow
		if ($parent_node)
		{
				$current_node = $parent_node;
		}
}


/*
$url = new url();
$url->set('node_id', $node_object->getId());
*/


//if ($thinkedit->outputcache->get('interface_node_' . $current_node->getId()))
//{
//}
//else
//{
		
		/********************** LIST *********************/
		
		// append the parents to the list :
		if ($current_node->hasParent())
		{
				$parents = $current_node->getParentUntilRoot();
				$parents = array_reverse($parents);
				
				foreach ($parents as $parent)
				{
						$nodes[] = $parent;
				}
				
		}
		
		// build a list of nodes within the current node :
		
		// if we are in root
		//debug($current_node, 'Current node before list');
		//if ($we_are_root)
		//{
				
				// root is now allways shown
				$nodes[] = $current_node;
		//}
		
		//else we are not in root, show childrens 
		//else
		//{
				if ($current_node->hasChildren())
				{
						$children = $current_node->getChildren();
						foreach ($children as $child)
						{
								$nodes[] = $child;
						}
						//$nodes[] = $current_node->getChildren();
				}
		//}
		
		if (isset($nodes) && is_array($nodes))
		{
				$i = 0;
				foreach ($nodes as $node_item)
				{
						
						$node_info = false;
						
						/********************* Visit link *****************/
						$url = new url();
						$url->set('node_id', $node_item->getId());
						$content = $node_item->getContent();
						$content->load();
						$node_info['title'] = substr($node_item->getTitle(), 0, 32); // . ' (' . $node_item->getOrder() . ')';
						//$node_info['title'] .= $node_item->getLevel(); // . ' (' . $node_item->getOrder() . ')';
						$node_info['icon'] = $content->getIcon();
						$node_info['url'] = $url->render();
						$node_info['level'] = $node_item->getLevel() + 1;
						
						if ($node_item->hasChildren())
						{
								if ($node_item->getLevel() > $current_node->getLevel())
								{
										$node_info['helper_icon'] = 'ressource/image/icon/small/plus.gif';
								}
								else
								{
										$node_info['helper_icon'] = 'ressource/image/icon/small/minus.gif';
								}
								if ($node_info['level'] > 0)
								{
										$node_info['level'] = $node_info['level'] -1 ;
								}
						}
						
						
						
						
						/********************* Delete link *****************/
						$url->set('action', 'delete');
						$node_info['delete_url'] = $url->render();
						
						//if ($node_item->getLevel() > $current_node->getLevel())
						//{
								/********************* Move links *****************/
								//if ($i <> 0)
								//{
										$url->set('action', 'moveup');
										$node_info['moveup_url'] = $url->render();
										
										$url->set('action', 'movetop');
										$node_info['movetop_url'] = $url->render();
								//}
								
								//if ($i <> count($nodes))
								//{
										$url->set('action', 'movedown');
										$node_info['movedown_url'] = $url->render();
										
										$url->set('action', 'movebottom');
										$node_info['movebottom_url'] = $url->render();
								//}
						//}
						
						/********************* Edit link *****************/
						$url = new url();
						$url->set('node_id', $node_item->getId());
						$url->addObject($content);
						$url->set('mode', 'edit_node');
						$node_info['edit_url'] = $url->render('edit.php');
						
						/********************* Publish link *****************/
						if ($node_item->isPublished())
						{
								$url = new url();
								$url->set('node_id', $node_item->getId());
								$url->set('action', 'unpublish');
								$node_info['publish_url'] = $url->render();
								$node_info['publish_title'] = translate('unpublish');
								
						}
						else
						{
								$url = new url();
								$url->set('node_id', $node_item->getId());
								$url->set('action', 'publish');
								$node_info['publish_url'] = $url->render();
								$node_info['publish_title'] = translate('publish');
								
						}
						
						
						/********************* Preview link *****************/
						$url = new url();
						$url->set('node_id', $node_item->getId());
						$node_info['preview_url'] = $url->render('../index.php');
						$node_info['preview_title'] = translate('preview');
						
						$out['nodes'][] = $node_info;
						$i++;
				}
		//}
}
/*
echo '<pre> after list';
print_r($db_cache);
echo '</pre>';
*/

// build a breadcrumb of parent items
// add breadcrumb
$url = new url();
$out['breadcrumb'][1]['title'] = translate('structure_title');
$out['breadcrumb'][1]['url'] = $url->render();


$i = 0;
if ($current_node->hasParent())
{
		$parents = $current_node->getParentUntilRoot();
		$parents = array_reverse($parents);
		
		foreach ($parents as $parent)
		{
				$content = $parent->getContent();
				$content->load();
				
				$out['structure_breadcrumb'][$i]['title'] = $content->getTitle();
				
				$url = new url();
				$url->set('node_id', $parent->getId());
				//$url->addObject($parent, 'current_');
				$out['structure_breadcrumb'][$i]['url'] = $url->render();
				$i++;
				
		}
		
}

// add current
$content = $current_node->getContent();
$content->load();
$out['structure_breadcrumb'][$i]['title'] = $content->getTitle();
$url = new url();
$url->set('node_id', $current_node->getId());
//$url->addObject($current_node, 'current_');
$out['structure_breadcrumb'][$i]['url'] = $url->render();



/************************ Allowed items ************************/
/*
$allowed_items = $node_object->getAllowedItems();
foreach ($allowed_items as $allowed_item)
{
		if ($allowed_item['class'] == 'record')
		{
				$url->set('class', 'record');
				$url->set('type', $allowed_item['class']);
				$url->render('edit.php');
		}
}
*/

// first allow anything :

$config_tool = $thinkedit->newConfig();
$tables = $config_tool->getTableList();

// generating the table list from the config array
foreach($tables as $table_id)
{
		$table = $thinkedit->newTable($table_id);
		$item['title'] = $table->getTitle();
		//$item['help'] = $table->getHelp();
		//$item['icon'] = $table->getIcon();
		$url = new url();
		$url->set('mode', 'new_node');
		$url->set('node_id', $current_node->getId());
		//$url->addObject($current_node, 'node_');
		
		$url->addObject($table);
		
		$item['action'] = $url->render('edit.php');
		$out['allowed_items'][] = $item;
}



/*
// define action buttons urls
$url = new url();
$url->addObject($node_object, 'node_');
$url->keep('node_id');
$url->set('action', 'add_new_node');
$out['add_new_node_url'] = $url->render();


$url = new url();
$url->keep('node_id');
$url->addObject($node_object, 'node_');
$url->set('action', 'add_existing_node');
$out['add_existing_node_url'] = $url->render();
*/


debug($out, 'OUT');


// include template :
include('header.template.php');
include('structure.template.php');
include('footer.template.php');
?>
