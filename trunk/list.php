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



// header
$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');

// breadcrumb
$breadcrumb = new breadcrumb();
$breadcrumb->add(translate('home'), 'homepage.php');
$breadcrumb->add(translate('list'));

$page->startPanel('breadcrumb', 'breadcrumb');
$page->add($breadcrumb->render());
$page->endPanel('breadcrumb');


if ($url->getParam('message'))
{
	$page->startPanel('title', 'info message');
	$page->add(translate($url->getParam('message')));
	$page->endPanel('title');
}


/*
//table selector
$table_selector = new dropdown();
$table_selector->setId('table_list');

$table_selector->setTitle('Choisissez une table à afficher');
$tables = $thinkedit->getTableList();
*/

/*

foreach ($tables as $table)
{
	$table_selector->add($table, $table);
}
*/

//print_r($table_selector->getSettings());

// we preselect if ?type is found in the url, this would mean we are from the home page for instance
/*
if ($url->getParam('table'))
{
	$table_selector->setSelected($url->getParam('table'));
}


$session->persist($table_selector);


$page->startPanel('table_list');
$page->add($table_selector->render());
$page->endPanel('table_list');
*/



if ($url->getParam('table'))
{
	
	$table_name = $url->getParam('table');
	
	if ($config->tableExists($table_name))
	{
		
		$table = new table(	$table_name);
		
		
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
		
		/*	
		debug ($pager->getCurrent(), 'pager current');
		debug ($pager->getCurrentPage(), 'pager current page');
		debug ($pager->getPageSize(), 'pager page size');
		*/	
		$table->limit($pager->getCurrent(), $pager->getPageSize());
		
		
		$records = $table->select();
		
		if (is_array($records))
		{
			foreach ($records as $record)
			{
				$data = $record->getNiceArray();
				$data['table'] = 'test'; //$table->getTableName();
				$datagrid->add($data);
			}
		}
		
		
		
		
		$page->startPanel('datagrid');
		$page->add($pager->render());
		$page->add($datagrid->render());
		$page->endPanel('datagrid');
	}
	else
	{
		$page->add(translate('table_not_found'));
	}
	
	
}
else
{
	$page->add(translate('no_table_choosen'));
}



echo $page->render();


?>
