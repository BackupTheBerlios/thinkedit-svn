<?php
/*
takes as an input :

relation
show : source or relations
action: relate / unrelate
record_id (id of the record to relate / unrelate)

source_id = 5
source_table = author


*/

require_once 'thinkedit.init.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/table.class.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/record.class.php';
require_once ROOT . '/class/form.class.php';
require_once ROOT . '/class/relation.class.php';

echo '<pre>';

$page = new page();
$url = new url();

// check we have a relation profile
if ($url->getParam('relation'))
{
	$relation = new relation($url->getParam('relation'));
}
else
{
	trigger_error('relation : no relation profile found in url');
}


// action to perform ?
if ($url->getParam('action') == 'relate')
{
	
}


if ($url->getParam('action') == 'unrelate')
{
	
}


// init source
$source_table = $url->getParam('source_table');
$source_id = $url->getParam('source_id');
if ($source_table_name && $source_id)
{
	$source = $thinkedit->newRecord($source_table_name);
	$source->field['id']->set($source_id);
}
else
{
	trigger_error('source_table and/or source_id not found in url');
}

// what to show :

if ($url->getParam('show') == 'source')
{
	
	$source_table = $thinkedit->newTable($source_table_name
}

$source = $thinkedit->newRecord('author');
$target = $thinkedit->newRecord('article');

$source->field['id']->set('5');
$target->field['id']->set('16');





//$relation->relate($source, $target);

if ($relation->getRelations($source))
{
	foreach ($relation->getRelations($source) as $article)
	{
	echo '<h1>' . $article->field['title']->get() . '</h1>';
	print_r ($article);
	
	}
	
}
	


?>
