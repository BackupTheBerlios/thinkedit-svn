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
$breadcrumb->add(translate('files'));

$page->startPanel('breadcrumb', 'breadcrumb');
$page->add($breadcrumb->render());
$page->endPanel('breadcrumb');


$datagrid = new datagrid();


// init filesystem object
$filesystem = $thinkedit->newFilesystem();

// if path found in url, load filesystem
if ($url->get('id'))
{
  $filesystem->setPath($url->get('id'));
}

if ($filesystem->getChildren())
{
  $items = $filesystem->getChildren();
  foreach ($items as $item)
  {
	$datagrid->addObject($item);
  }
}

$page->startPanel('list', 'list');
$page->add($datagrid->render());
$page->endPanel('list');

// create a datagrid of filesystem



echo $page->render();
?>
