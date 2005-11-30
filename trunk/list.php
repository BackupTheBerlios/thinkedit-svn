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
require_once ROOT . '/class/config.class.php';

$session = new session();
$page = new page();
$url = new url();
$config = new config();



// message
if ($url->getParam('message'))
{
  $out['message'] = translate($url->getParam('message'));
}


// breadcrumb
$breadcrumb = new breadcrumb();
$breadcrumb->add(translate('home'), 'homepage.php');
$breadcrumb->add(translate('list'));

$out['breadcrumb'] = $breadcrumb->render();




if ($url->getParam('table'))
{
  
  $table_name = $url->getParam('table');
  
  if ($config->tableExists($table_name))
  {
	
	$record = $thinkedit->newRecord($table_name);
	
	/*
	// init datagrid
	$datagrid = new datagrid();
	$datagrid->setId('data_grid_for_' . $table_name );
	
	$record = $thinkedit->newRecord($table->getTableName());
	
	// add all fields
	foreach ($record->field as $field)
	{
	  $datagrid->addColumn($field->getId(), $field->getTitle(), $field->isSortable(), $field->isPrimary());
	}	
	
	// $datagrid->addColumn('title', 'Title', true, false);
	$datagrid->addColumn('table', 'Table', true, true);
	
	
	$datagrid->addLocalAction('edit', 'edit.php', translate('edit'));
	$datagrid->addLocalAction('delete', 'delete.php', translate('delete'));
	
	
	$url = new url();
	$url->setParam('table', $table->getId());
	$url->setParam('action', 'add');
	$url->setFileName('edit.php');
	$datagrid->addGlobalAction('add', $url->render(), translate('add'));
	
	
	// init pagination
	$pager = new pager('pager_for_' . $table_name );
	$pager->enablePaginationDropDown();	
	$pager->setTotal($table->count());
	$session->persist($pager);
	
	
	$table->limit($pager->getCurrent(), $pager->page_size);
	
	
	$records = $table->select();
	
	if (is_array($records))
	{
	  debug($records, 'Records');
	  foreach ($records as $record)
	  {
		$record['table'] = $table_name;
		$datagrid->add($record);
	  }
	  
	  
	  //$datagrid->addMany($records);
	  */
  }
  
  
  
  
}
else
{
  //$page->add(translate('table_not_found'));
}



include_once(ROOT . '/template/header.php');
include_once(ROOT . '/template/menu.php');
include_once(ROOT . '/template/list.php');
include_once(ROOT . '/template/footer.php');
?>
