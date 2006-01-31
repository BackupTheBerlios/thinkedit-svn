<?php
/*
See licence.txt for licence

Structure manages any thinkedit (or other) class in a node tree
You can add existing / add new / delete nodes
For this, you have a popup browser


input : 
node_id=(int)
action=delete
action=add


object_class
object_type
object_id
^^^^ those three if we want to add a new node

^

*/

include_once('common.inc.php');

//check_user
check_user();

$node_object = $thinkedit->newNode();

// Are we in root or not ?
if ($url->get('node_id'))
{
		$node_id = $url->get('node_id');
		$node_object->setId($node_id);
}
else // we are in root
{
		$node_object->loadRootNode();
		
}

// handle adding new node from existing record
// handle adding new node from new record
// handle deleting node



// build a list of folders (excluding cache and thumbnails folders / files)
// we use a new instance of filesystem to have all folders form root allways
/*				
$url->set('path', $folder->getPath());

$folder_out['path'] = $folder->getPath();
$folder_out['url'] = $url->render();
if ($folder->getPath() == $filesystem->getPath())
{
		$folder_out['current'] = true;
}


$out['folders'][] = $folder_out;
*/




// build a list of nodes within the current node :



// if we are in root
if (!$url->get('node_id'))
{
		$content = $node_object->getContent();
		$content->load();
		
		$node['title'] = $content->getTitle();
		$node['icon'] = $content->getIcon();
		
		$url = new url();
		$url->set('node_id', $node_object->getId());
		$node['url'] = $url->render();
		
		$url->set('action', 'delete');
		$node['delete_url'] = $url->render();
		
		$url->set('action', 'edit_node');
		$node['edit_url'] = $url->render('edit.php');
		
		
		$out['nodes'][] = $node;
}
else
{
	
		if ($node_object->hasChildren())
		{
				$children = $node_object->getChildren();
				foreach ($children as $child)
				{
						$content = $child->getContent();
						$content->load();
						
						$node['title'] = $content->getTitle();
						$node['icon'] = $content->getIcon();
						
						$url = new url();
						$url->set('node_id', $child->getId());
						$node['url'] = $url->render();
						
						$url->set('action', 'delete');
						$node['delete_url'] = $url->render();
						
						$url->set('action', 'edit_node');
						$node['edit_url'] = $url->render('edit.php');
						
						
						$out['nodes'][] = $node;
				}
		}
}



// build a breadcrumb of parent items

// add breadcrumb
$url = new url();
$out['breadcrumb'][1]['title'] = translate('structure_title');
$out['breadcrumb'][1]['url'] = $url->render();


$i = 0;
if ($node_object->hasParent())
{
		$parents = $node_object->getParentUntilRoot();
		$parents = array_reverse($parents);
		
		foreach ($parents as $parent)
		{
				$content = $parent->getContent();
				$content->load();
				
				$out['structure_breadcrumb'][$i]['title'] = $content->getTitle();
				
				$url = new url();
				$url->set('node_id', $parent->getId());
				$out['structure_breadcrumb'][$i]['url'] = $url->render();
				$i++;
				
		}
		
}

// add current
$content = $node_object->getContent();
$content->load();
$out['structure_breadcrumb'][$i]['title'] = $content->getTitle();
$url = new url();
$url->set('node_id', $node_object->getId());
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
		$url->set('node_id', $node_object->getId());
		
		$item['action'] = $url->linkTo($table, 'edit.php');
		$out['allowed_items'][] = $item;
}




// define action buttons urls
$url = new url();
$url->keep('node_id');
$url->set('action', 'add_new_node');
$out['add_new_node_url'] = $url->render();


$url = new url();
$url->keep('node_id');
$url->set('action', 'add_existing_node');
$out['add_existing_node_url'] = $url->render();



debug($out, 'OUT');


// include template :
include('header.template.php');
include('structure.template.php');
include('footer.template.php');
?>
