<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/html_form.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/node.class.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/breadcrumb.class.php';


/*
*/


$page = new page();
$url = new url();


// will delete anything related to Uid passed to url

// first see if we have some parameter passed in url
$page = new page();
$url = new url();


if (!$url->getParam('type'))
{
  trigger_error('edit : you must supply a type in the url');
}

if (!$url->getParam('class'))
{
  trigger_error('edit : you must supply a class in the url');
}

// instantiate record

$record = new record($url->getParam('type')); 

$keys = $record->getPrimaryKeys();

foreach ($keys as $key)
{
  if ($url->getParam($key))
  {
	$record->set($key, $url->getParam($key));
  }
}

$record->load();


// instantiate form
$form = new html_form();


// is form sent?
if ($form->isSent())
{
  // if yes, and action confirmed we delete
  debug('delete.php : form sent');
  
  $record->delete();
}
elseif ($form->isCancel())
{
  // if yes and action cancelled, we redirect to previous page
  $url = new url();
  $url->setFileName('list.php');
  $url->keepParam('table');
  $url->setParam('message', 'delete_cancelled');
  //header('location: ' . $url->render());
  $url->redirect();
}
else
{
  // if form not sent, we build form
  
  // breadcrumb
  $breadcrumb = new breadcrumb();
  $breadcrumb->add(translate('home'), 'homepage.php');
  
  $url = new url();
  $url->setFileName('list.php');
  $url->keepParam('table');
  
  
  $breadcrumb->add(translate('content'), 'content.php');
  $breadcrumb->add($record->getTableName(), $url->render());
  $breadcrumb->add(translate('deleting') . ' ' . '"' . $record->getTitle() . '"');
  
  $page->startPanel('breadcrumb', 'breadcrumb');
  $page->add($breadcrumb->render());
  $page->endPanel('breadcrumb');
  
  
  $page->startPanel('form');
  $page->add($form->render());
  $page->endPanel('form');
  
  
  
  
  // footer
  $page->startPanel('footer', 'footer');
  $page->add('&copy; Philippe Jadin');
  $page->endPanel('footer');
  
  
  // = translate('edit_title');
  echo $page->render();
  
}






?>