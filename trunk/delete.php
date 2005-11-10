<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/form.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/node.class.php';
require_once ROOT . '/class/page.class.php';


/*



*/


$page = new page();
$url = new url();


// I need a node
if ($url->getParam('table'))
{
	$table = $thinkedit->newTable($url->getParam('table'));
}
else
{
	trigger_error(translate('need_table_to_delete'));
}


// todo : need rework !!!

$record = $thinkedit->newRecord($table->getTable());

$keys = $record->getPrimaryKeys();

//echo '<pre>';
//print_r($keys);

foreach ($keys as $key)
{
		if ($url->getParam($key))
		{
			$record->field[$key]->set($url->getParam($key));
		}
		else
		{
		trigger_error('delete.php : primary key "'. $key . '" not found in url, won\'t delete'); 		
		}
}


$table->delete($record);


$url = new url();
$url->setFileName('list.php');
$url->keepParam('table');
$url->setParam('info', 'Record sucessfully deleted');
header('location: ' . $url->render());

die();


// print_a($_REQUEST);

// various actions, based on submit buttons :

$action = $url->getParam('action');




if (!$action)
{
	$out['title'] = 'Delete an item';
	
	$url = new url();
	$url->setParam('action', 'delete');
	$out['action_url'] = $url->render();
	
	// include templates :
	require_once 'header.template.php';
	require_once 'delete.template.php';
	require_once 'footer.template.php';
}

if ($action == 'delete')
{
	// delete then redirect
	$node = new node($node_id);
	$module = $node->getModule();
	
	
	
	// we need a parent else we won't delete;
	$parent = $node->getParent();
	
	if (!$parent)
	{
		// simply redirect
		$url = new url();
		$url->setFileName('browser.php');
		$url->setParam('info', 'Item deletion aborted : cannot delete root item / item without parent');
		header('location: ' . $url->render());
	}
	
	
	
	if ($node->removeNode())
	{
		$url = new url();
		$url->setFileName('browser.php');
		$url->setParam('info', 'Item sucessfully deleted');
		
		// redirect to parent node 
		$url->setParam('node', $parent->getNodeId());
		header('location: ' . $url->render());
	}
	else
	{
		$url = new url();
		$url->setFileName('browser.php');
		$url->setParam('warning', 'Item could not be deleted');
		header('location: ' . $url->render());
	}
}

if ($action == 'cancel')
{
	// simply redirect
	$url = new url();
	$url->setFileName('browser.php');
	$url->setParam('info', 'Item deletion cancelled');
	header('location: ' . $url->render());
}



?>