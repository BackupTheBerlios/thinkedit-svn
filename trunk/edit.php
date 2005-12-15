<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/table.class.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/record.class.php';
require_once ROOT . '/class/html_form.class.php';


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


// at this stage we have a $record, ready to use. either empty or filled with existing info


$form = new html_form();

if ($form->isSent())
{
	debug('edit.php : form sent');
  foreach ($record->field as $field)
	{
	  if (isset($_POST[$field->getName()]))
	  {
		$record->set($field->getName(), $_POST[$field->getName()]);
	  }
	}
  
	debug($record, 'Record before saving');
	$record->save();
	
	$url = new url();
	$url->setFileName('list.php');
	$url->keepParam('table');
	$url->setParam('message', 'edit_successfull');
	//header('location: ' . $url->render());
	$url->redirect();
}
elseif ($form->isCancel())
{
	$url = new url();
	$url->setFileName('list.php');
	$url->keepParam('table');
	$url->setParam('message', 'edit_cancelled');
	//header('location: ' . $url->render());
	$url->redirect();
}
else 	// render form
{
	
	
	// build form : 
	
	foreach ($record->field as $field)
	{
		$form->add('<div class="input">');
		$form->add($field->getHelp());
		$form->add(' : ');
		$form->add('<br/>');
		$form->add($field->renderUI());
		$form->add('</div>');
	}
	
// header
require_once 'header.php';
	
	
	// breadcrumb
	$breadcrumb = new breadcrumb();
	$breadcrumb->add(translate('home'), 'homepage.php');
	
	$url = new url();
	$url->setFileName('list.php');
	$url->keepParam('table');
	
	
	$breadcrumb->add(translate('content'), 'content.php');
	$breadcrumb->add($record->getTableName(), $url->render());
	$breadcrumb->add(translate('editing') . ' ' . '"' . $record->getTitle() . '"');
	
	$page->startPanel('breadcrumb', 'breadcrumb');
	$page->add($breadcrumb->render());
	$page->endPanel('breadcrumb');
	
	
	// render form
	$page->startPanel('subtitle', 'subtitle');
	$page->add(translate('edit_title'));
	$page->endPanel('subtitle');
	
	
	$page->startPanel('form');
	$page->add($form->render());
	$page->endPanel('form');
	
	
	// manage relations
	
	$page->startPanel('relations');
	$page->add('test');
	$page->endPanel('relations');
	
	
	
	// footer
	$page->startPanel('footer', 'footer');
	$page->add('&copy; Philippe Jadin');
	$page->endPanel('footer');
	
	
	// = translate('edit_title');
	echo $page->render();
}





?>