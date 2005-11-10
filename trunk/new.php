<?php
require_once 'thinkedit.init.php';
require_once 'class/url.class.php';
require_once 'class/breadcrumb.class.php';


// I need a node, a type and an action

if (isset($_REQUEST['node']))
{
$node = $_REQUEST['node'];
}
else
{
// todo if no node, the item is created but not putted in the node hierarchy...
// $node = false;
// curently we default to root
$node = 1;
}

if (isset($_REQUEST['type']))
{
$type = $_REQUEST['type'];
}
else
{
trigger_error('I need a type to work on', E_USER_ERROR);
//$type ='folder';
}


if (isset($_REQUEST['action']))
{
$action = $_REQUEST['action'];
}
else
{
$action = 'form';
}
 



// either we display an input form for the title, either we create and redirect, either we cancel


// first case, we display an input form :

if ($action == 'form')
{
$out['title'] = 'Create a new item';

$url = new url();
$url->setParam('action', 'create');
$out['action_url'] = $url->render();

$breadcrumb = new breadcrumb();

$out['breadcrumb'] = $breadcrumb->render();

// include templates :
require_once 'header.template.php';
require_once 'new.template.php';
require_once 'footer.template.php';
}

// second case, the action is to create the module
if ($action == 'create')
{
  // create the new module
  $module = $thinkedit->newModule($type);
	$module->setTitle($_REQUEST['title']);
	$module->save();
	
	// if we have a node defined, it will be used as a parent
	if ($node)
	{
	$parent = $thinkedit->newModuleByNodeId($node);
	$parent->addChild($module); 
	}
	
	$url = new url();
	$url->setFileName('browser.php');
	header('location: ' . $url->render());
	
}


// third case, the action is to cancel creation
if ($action == 'cancel')
{
  // redirect to browser
}






?>