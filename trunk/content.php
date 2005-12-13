<?php

require_once 'thinkedit.init.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/datagrid.class.php';
require_once ROOT . '/class/session.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/config.class.php';
require_once ROOT . '/class/page.class.php';


$url = new url();
$config = new config();
$page = new page();

// header
require_once 'header.php';

//message
if ($url->getParam('message'))
{
$page->startPanel('title', 'info message');
$page->add(translate($url->getParam('message')));
$page->endPanel('title');
}


// breadcrumb
$breadcrumb = new breadcrumb();
$breadcrumb->add(translate('home'), 'homepage.php');
$breadcrumb->add(translate('content'));

$page->startPanel('breadcrumb', 'breadcrumb');
$page->add($breadcrumb->render());
$page->endPanel('breadcrumb');





$table_list = $config->getTableList();

$datagrid = new datagrid();

foreach ($table_list as $table)
{
  $tables[] = $thinkedit->newTable($table);
}

foreach ($tables as $table)
{
  $datagrid->addObject($table);
}

$datagrid->addLocalAction('list', 'list.php', 'Liste');


$page->startPanel('list');
$page->add('<h1>Tables:</h1>');
//$page->add($datagrid->render('icon'));
$page->add($datagrid->render());
$page->endPanel('list');





echo $page->render();



/*
require_once 'thinkedit.init.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/datagrid.class.php';
require_once ROOT . '/class/session.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/config.class.php';


$url = new url();
$config = new config();


// message
if ($url->getParam('message'))
{
  $out['message'] = translate($url->getParam('message'));
}


// breadcrumb
$breadcrumb = new breadcrumb();
$breadcrumb->add(translate('home'));

$out['breadcrumb'] = $breadcrumb->render();


$tables = $config->getTableList();


foreach ($tables as $table)
{
 
  $table_instance = $thinkedit->newTable($table);
  
   $url->setArray($table_instance->getUid());
  
  $table_info['table'] = $table_instance->getTableName();
  $table_info['title'] = $table_instance->getTableName();
  $table_info['help'] = $table_instance->getTableName();
  $out['table'][$table_instance->getTableName()] = $table_info;
  $out['table'][$table_instance->getTableName()]['list_link'] = $url->render('list.php');
  $out['table'][$table_instance->getTableName()]['add_link'] = $url->render('edit.php');
}


$trees = $thinkedit->getTreeList();

if ($trees)
{
  
  foreach ($trees as $tree)
  {
	$tree_instance = $thinkedit->newTree($tree);
	$tree_info['tree'] = $tree_instance->tree;
	$out['tree'][$tree_instance->tree] = $tree_info;
  }
  
  
  
  
}




include_once(ROOT . '/template/header.template.php');
include_once(ROOT . '/template/left.template.php');
include_once(ROOT . '/template/right.template.php');
include_once(ROOT . '/template/homepage.template.php');
include_once(ROOT . '/template/footer.template.php');
*/

?>
