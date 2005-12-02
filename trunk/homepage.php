<?php
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
  $table_info['table'] = $table_instance->getTableName();
  $table_info['title'] = $table_instance->getTableName();
  $table_info['help'] = $table_instance->getTableName();
  $out['table'][$table_instance->getTableName()] = $table_info;
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


?>