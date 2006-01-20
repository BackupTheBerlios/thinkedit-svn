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

$i = 2;
if ($node_object->hasParent())
{
		$parents = $node_object->getParentUntilRoot();
		$parents = array_reverse($parents);
		
		foreach ($parents as $parent)
		{
				$content = $parent->getContent();
				$content->load();
				
				$out['breadcrumb'][$i]['title'] = $content->getTitle();
				
				$url = new url();
				$url->set('node_id', $parent->getId());
				$out['breadcrumb'][$i]['url'] = $url->render();
				$i++;
				
		}
		
}

// add current
$content = $node_object->getContent();
$content->load();

$out['breadcrumb'][$i]['title'] = $content->getTitle();

$url = new url();
$url->set('node_id', $node_object->getId());
$out['breadcrumb'][$i]['url'] = $url->render();


$allowed_items = $node_object->getAllowedItems();

foreach ($allowed_items as $item)
{
		if ($item['type'] == 'record')
		{
				$url->set('class', 'record')
				$url->set('type', $)
				$url->render
}
$out['allowed_items'] = $node_object->getAllowedItems();


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

//print_a($out);

// include template :
include('header.template.php');
include('structure.template.php');
include('footer.template.php');
?>
