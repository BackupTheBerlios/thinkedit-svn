<?php
// Db syncer, will create database tables and field corresponding to the xml config files


// How UI works :
// display a list of tables
// foreach table display a list of fields

// each item has a label [ok] or [create]
// if user click on [create], the corresponding field is created



// init
require_once ('../thinkedit.init.php');
require_once (ROOT . '/class/config.class.php');
require_once (ROOT . '/class/page.class.php');
require_once (ROOT . '/class/url.class.php');


$db = $thinkedit->getDb();

// Action !
$url = new url();


// create table is asked
if ($url->get('action') == 'create_table')
{
  $db->createTable($url->get('table'));
}


// create field if asked
if ($url->get('action') == 'create_field')
{
  $table = $thinkedit->newTable($url->get('table'));
  $table->createField($url->get('field'));
}


$page = new page();

// loop each config table
$config = new config();
$table_list = $config->getTableList();


$page->startPanel('table_list');


// display table list
foreach ($table_list as $table_id)
{
  $table = $thinkedit->newTable($table_id);
  $page->add('<blockquote>');
  $page->add($table->getTitle());
  if ($db->hasTable($table->getTableName()))
  {
	$page->add('[OK]');
	// handle fields
	$field_list = $config->getAllFields($table->getTableName());
	foreach ($field_list as $field_id)
	{
	  $page->add('<blockquote>');
	  $page->add($field_id);
	  if ($table->hasField($field_id))
	  {
		$page->add('[OK]');
	  }
	  else
	  {
		$url = new url();
		$url->set('table', $table->getTableName());
		$url->set('field', $field_id);
		$url->set('action', 'create_field');
		$page->link($url->render(), '[create]');
	  }
	  $page->add('</blockquote>');
	}
	
	
  }
  else
  {
	$url = new url();
	$url->set('table', $table->getTableName());
	$url->set('action', 'create_table');
	$page->link($url->render(), '[create]');
  }
  
  
  
  
  
  $page->add('</blockquote>');
  
}
$page->endPanel('table_list');





echo $page->render();

// if table not there, create it with simple id field

// if table exists, 
// loop over fields
// if field not there, create it with right type

// handle field change type ?
// this may be a risky job

// end





?>
