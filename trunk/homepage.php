<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/datagrid.class.php';
require_once ROOT . '/class/session.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/config.class.php';


$page = new page();
$url = new url();
$config = new config();



// header
$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');

//message
if ($url->getParam('message'))
{
$page->startPanel('title', 'info message');
$page->add(translate($url->getParam('message')));
$page->endPanel('title');
}


// breadcrumb
$breadcrumb = new breadcrumb();
$breadcrumb->add(translate('home'));

$page->startPanel('breadcrumb', 'breadcrumb');
$page->add($breadcrumb->render());
$page->endPanel('breadcrumb');


$tables = $config->getTableList();


$datagrid = new datagrid();
$datagrid->addColumn('table', 'Table', false, true);
$datagrid->addLocalAction('list', 'list.php', 'Liste');


foreach ($tables as $table)
{
	$table_instance = $thinkedit->newTable($table);
	$table_info['table'] = $table_instance->getTableName();
	$table_info['title'] = $table_instance->getTableName();
	$table_info['help'] = $table_instance->getTableName();
	$datagrid->add($table_info);
}



$page->startPanel('list');
$page->add('<h1>Tables:</h1>');
//$page->add($datagrid->render('icon'));
$page->add($datagrid->render());
$page->endPanel('list');





$trees = $thinkedit->getTreeList();

if ($trees)
{
$datagrid_tree = new datagrid();

$datagrid_tree->addColumn('tree', 'Tree', false, true);
$datagrid_tree->addLocalAction('tree', 'tree.php', 'Arbre');


foreach ($trees as $tree)
{
	$tree_instance = $thinkedit->newTree($tree);
	$tree_info['tree'] = $tree_instance->tree;
	$datagrid_tree->add($tree_info);
}



$page->startPanel('list_tree');
$page->add('<h1>Arborescences:</h1>');
$page->add($datagrid_tree->render());
$page->endPanel('list_tree');
}





echo $page->render();


?>