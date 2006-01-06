<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/table.class.php';
require_once ROOT . '/class/datagrid.class.php';
require_once ROOT . '/class/session.class.php';
require_once ROOT . '/class/pager.class.php';
require_once ROOT . '/class/tree.class.php';

$session = new session();
$page = new page();
$url = new url();



// header
$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');

// breadcrumb
$breadcrumb = new breadcrumb();
$breadcrumb->add(translate('home'), 'homepage.php');
$breadcrumb->add(translate('tree'));

$page->startPanel('breadcrumb', 'breadcrumb');
$page->add($breadcrumb->render());
$page->endPanel('breadcrumb');


if ($url->getParam('message'))
{
	$page->startPanel('title', 'info message');
	$page->add(translate($url->getParam('message')));
	$page->endPanel('title');
}



$tree = new tree($url->getParam('tree'));


if ($url->getParam('node'))
{
	$tree->setNodeId(getParam('node'));
}



//print_r ($tree->getChildren());



// init datagrid
$datagrid = new datagrid();
$datagrid->setId('data_grid_tree_' . $tree->tree);
$datagrid->addColumn('nodeid', 'nodeid', false, true);
$datagrid->addColumn('type', 'type', false, true);
$datagrid->addColumn('name', 'name', false, true);
$datagrid->addColumn('uid', 'uid', false, true);


if ($tree->getChildren())
{
	$trees = $tree->getChildren();
	foreach ($trees as $tree)
	{
		$data['nodeid'] = $tree->getObject();
		$data['nodeid'] = $tree->node_id;
		$data['type'] = $tree->type;
		$data['name'] = $tree->name;
		$data['uid'] = $tree->uid;
		$datagrid->add($data);
	}
	
	$page->startPanel('datagrid');
	$page->add($datagrid->render());
	$page->endPanel('datagrid');
	
	
}


echo $page->render();


?>
