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
	  foreach ($records as $record)
	  {
		$out['data'][$record->getUid()]['id'] = $record->getUid();
		$out['data'][$record->getUid()]['title'] = $record->getTitle();
	  }
	  
	  
	}
	
	
	
	
  }
  else
  {
	//$page->add(translate('table_not_found'));
  }
  
}


include_once(ROOT . '/template/header.template.php');
include_once(ROOT . '/template/left.template.php');
include_once(ROOT . '/template/right.template.php');
include_once(ROOT . '/template/list.template.php');
include_once(ROOT . '/template/footer.template.php');
?>
