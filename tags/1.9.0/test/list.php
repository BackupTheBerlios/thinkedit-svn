<?php
require_once 'init.inc.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/modulelist.class.php';
require_once ROOT . '/class/datagrid.class.php';


$page = new page();

$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');




$module_selector = new dropdown();
$module_selector->setId('module_list');

$module_selector->setTitle('Choisissez un type d\'élément à éditer');
$modules = $thinkedit->getModuleList();

$module_selector->persist();

foreach ($modules as $module)
{
	$module_selector->add($module, $module);
}



$page->startPanel('module_list');
$page->add($module_selector->render());
$page->endPanel('module_list');


if ( $module_selector->getSelected() )
{
	$list = new modulelist();
	$list->setType( $module_selector->getSelected() );
	
	$modules = $list->load();
	
	$datagrid = new datagrid();
	$datagrid->addColumn('id', 'Id');
	$datagrid->addColumn('title', 'Title');
	
	foreach ($modules as $module)
	{
		$datagrid->add($module->getArray() );
	}
	
	$page->startPanel('datagrid');
	$page->add($datagrid->render());
	$page->endPanel('datagrid');
	
}



echo $page->render();


?>
