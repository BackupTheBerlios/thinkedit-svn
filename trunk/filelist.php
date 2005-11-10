<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/dropdown.class.php';
require_once ROOT . '/class/filelist.class.php';
require_once ROOT . '/class/datagrid.class.php';
require_once ROOT . '/class/session.class.php';

$session = new session();
$page = new page();

$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');




$list = new filelist();


$datagrid = new datagrid();
$datagrid->setId('datagrid_for_files' );
$datagrid->bind($list);

$datagrid->enablePagination();

$datagrid->addLocalAction('edit', 'edit.php', translate ('edit'));
$datagrid->addLocalAction('delete', 'delete.php', translate ('delete'));


$page->startPanel('datagrid');
$page->add($datagrid->render());
$page->endPanel('datagrid');




echo $page->render();


?>
