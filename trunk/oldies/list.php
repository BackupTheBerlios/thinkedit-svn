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
require_once 'header.php';


if ($url->getParam('action') == 'browse')
{
		echo 'browse mode';	
}


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
$breadcrumb->add(translate('content'), 'content.php');
$breadcrumb->add($url->getParam('type'));



$page->startPanel('breadcrumb', 'breadcrumb');
$page->add($breadcrumb->render());
$page->endPanel('breadcrumb');


// check if we have everything in url
if ($url->get('class') && $url->get('type'))
{
		if ($url->get('class') == 'table' or $url->get('class') == 'record')
		{
				
				$table_name = $url->getParam('type');
				
				if ($config->tableExists($table_name))
				{
						$my_record = $thinkedit->newRecord($table_name);
						
						$records = $my_record->find();
						$datagrid = new datagrid();
						
						if (is_array($records))
						{
								
								
								foreach ($records as $record)
								{
										$datagrid->addObject($record);  
								}	 
								
						}
						
						if ($url->getParam('action') == 'browse')
						{
								$datagrid->addLocalAction('select', 'structure.php', translate('select'));
						}
						else
						{
								$datagrid->addLocalAction('edit', 'edit.php', translate('edit'));
								$datagrid->addLocalAction('delete', 'delete.php', translate('delete'));
								
								$datagrid->addGlobalAction('add', 'edit.php', translate('add'));
								$datagrid->enableCheckBox();
						}
						
						$page->startPanel('list');
						//$page->add('<h1></h1>');
						$page->add($datagrid->render());
						$page->endPanel('list');
				}
		}
}





echo $page->render();

/*
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
				$my_record = $thinkedit->newRecord($table_name);
				
				$records = $my_record->find();
				
				if (is_array($records))
				{
						debug($records, "Records found");
						foreach ($records as $record)
						{
								$url->setArray($record->getUid());
								$out['data'][$record->getId()]['uid'] = $record->getUid();
								$out['data'][$record->getId()]['title'] = $record->getTitle();
								$out['data'][$record->getId()]['edit_link'] = $url->render('edit.php');
								$out['data'][$record->getId()]['delete_link'] = $url->render('delete.php');
						}	 
				}
		}
		
}


include_once(ROOT . '/template/header.template.php');
include_once(ROOT . '/template/left.template.php');
include_once(ROOT . '/template/right.template.php');
include_once(ROOT . '/template/list.template.php');
include_once(ROOT . '/template/footer.template.php');

*/
?>