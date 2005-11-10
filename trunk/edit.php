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


if ($url->getParam('table'))
{
    $table = $thinkedit->newTable($url->getParam('table'));
}
else
{
    trigger_error('edit : you must supply a table name in the url');
}



// either we a new instance, either we  edit an existing one :

if ($url->getParam('action') == 'add')
{ 
	// we edit a new one
    $record = new record($url->getParam('table')); 
	$edit_mode = 'insert';
}
else
{ 
	// we update an existing one
	// build a list of primary keys
	$record = $thinkedit->newRecord($table->getTableName());
	$keys = $record->getPrimaryKeys();
	
	
	// test if we have all those keys in the url
	$unique_record = true; // assume it will work
	foreach ($keys as $key)
	{
		if ($url->getParam($key))
		{
			$table->filter($key, '=', $url->getParam($key));
		}
		else
		{
			// trigger_error('edit : ' . $key . ' not found in url, won\'t be able to select unique item');
			$unique_record = false;
		}
	}
	
	
	// if yes : we count, we need one record, and we can edit
	if ($unique_record)
	{
		if ($table->count() == 1)
		{
			$results = $table->select();
			$record = $results[0];
			$edit_mode = 'update'; // ugly
		}
		else
		{
			trigger_error('edit : all primary keys found in url, but a query reported something strange, will not edit');
		}
	}
}

// at this stage we have a $record, ready to use. either empty or filled with existing info


$form = new html_form();

if ($form->isSent())
{
    if ($edit_mode == 'update')
    {
		$table->update($_POST);
    }
    elseif ($edit_mode == 'insert')
    {
		$table->insert($_POST);
    }
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
    $page->startPanel('title', 'title');
    $page->add('Thinkedit 2.0');
    $page->endPanel('title');
	
	
    // breadcrumb
    $breadcrumb = new breadcrumb();
    $breadcrumb->add(translate('home'), 'homepage.php');
	
    $url = new url();
    $url->setFileName('list.php');
    $url->keepParam('table');
	
    $breadcrumb->add(translate('list'), $url->render());
    $breadcrumb->add(translate('editing'));
	
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