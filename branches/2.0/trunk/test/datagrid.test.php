<?php
require_once '../thinkedit.init.php';
require_once '../class/datagrid.class.php';
require_once '../class/page.class.php';


$page = new page();

$datagrid = new datagrid();
$datagrid->addColumn('firstname', 'First name', true, true);
$datagrid->addColumn('lastname', 'Last name', true, true);
$datagrid->addColumn('title', 'Last name', true, true);

for ($i=1; $i<1000; $i++)
{
	$data['firstname'] = rand(1, 100);
	$data['lastname'] = rand(1, 100);
	$data['title'] = rand(1, 100);
	$datagrid->add($data);
}

$page->startPanel('test');
$page->add( $datagrid->render('icon'));
$page->endPanel('test');


echo $page->render();







?>
