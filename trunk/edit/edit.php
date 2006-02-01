<?php
/*
See licence.txt for licence
Edit displays an edit page for the current $table, $id, $db_locale
todo : validation of the request arguments agains the config file to avoid hack
*/

include_once('common.inc.php');


//check_user
check_user();

if (!$url->getParam('type'))
{
		trigger_error('edit : you must supply a type in the url');
}

if (!$url->getParam('class'))
{
		trigger_error('edit : you must supply a class in the url');
}


if ($url->get('mode') == 'new_node')
{
		$out['mode'] = 'new_node';
		$new_node = true;
}
else
{
		$new_node = false;
}



$table = $url->get('type');
$out['table'] = $table;

$record = $thinkedit->newRecord($url->getParam('type'));
$table_object = $thinkedit->newTable($url->getParam('type'));

$keys = $record->getPrimaryKeys();

foreach ($keys as $key)
{
		if ($url->getParam($key))
		{
				$record->set($key, $url->getParam($key));
		}
}

$record->load();

/****************** Handle save ******************/
if ($url->get('action')=='save')
{
		debug($_REQUEST, 'Request');
		foreach ($record->field as $field)
		{
				if (isset($_POST[$field->getName()]))
				{
						$record->set($field->getName(), $_POST[$field->getName()]);
				}
		}
		
		debug($record, 'Record before saving');
		if ($record->save())
		{
				$out['info'] = translate('item_save_successfully');
		}
		else
		{
				error('failed saving record');
		}
}


/************** handle add node *****************/
// if we have saved something, and if we need to add to thge node tree, we redirect with the record ID

if ($url->get('action')=='save' && $url->get('mode') == 'new_node')
{
		$url->keep('mode');
		$url->keep('node_id');
		$redirect = $url->linkTo($record, 'structure.php');
		header('location: ' . $redirect); // todo better url class api
}





// generating the items list from the config array
/****************** Form items ******************/

$url->set('action', 'save');
$url->keepParam('type');
$url->keepParam('class');
$url->keepParam('mode');
$url->keep('node_id');
$out['save_url'] = $url->render();

foreach ($record->field as $field)
{
		$out['field'][$field->getName()]['ui'] = $field->renderUi();
		$out['field'][$field->getName()]['title'] = $field->getTitle();
		$out['field'][$field->getName()]['help'] = $field->getHelp();
}



/****************** Relations ******************/

$url = new url();
$url->addObject($record, 'source_');

$out['relation']['enable'] = true;
$out['relation']['url'] = $url->render('relation.php');

// clean url
$url = new url();

/*
foreach($config['config']['table'][$table]['element'] as $field=>$element)
{
		$out['element'][$field]['title'] = $element['title'][$interface_locale];
		$out['element'][$field]['help'] = $element['help'][$interface_locale];
		$out['element'][$field]['type'] = $element['type'];
		$out['element'][$field]['field'] = $field;
		
		
		
		//handle linked tables :
		// one_to_many is deprecated
		if ($element['type']=='one_to_many' or $element['type']=='list') //one to many is deprecated
		{
				//debug ('<h1>list</h1>');
				
				$source_table = $element['source']['table'];
				
				if (is_multilingual($source_table))
				{
						$query = "select * from " . $source_table . " where locale='$preferred_locale'";
				}
				else
				{
						$query = "select * from " . $source_table;
				}
				
				
				
				$items = $db->get_results($query);
				if ($debug) $db->debug();
				
				
				$out['element'][$field]['manage_list_url'] = "list.php?table=".$element['source']['table'];
				
				$i=0;
				if ($items)
				{
						foreach ($items as $item)
						{
								$out['element'][$field]['combo'][$i]['value'] = $item->$element['source']['value_field'];
								$out['element'][$field]['combo'][$i]['label'] = $item->$element['source']['label_field'];
								$i++;
						}
				}
				
		}
		
		
		
		// is this needed in the interface ?
		if ($element['type']=='relation')
		{
				$out['element'][$field]['manage_list_url'] = "list.php?table=".$element['source']['table'];
		}
		
		
		
		//handle image folder :
		if ($element['type']=='image')
		{
				// $out['element'][$field]['path'] = $config['config']['table'][$table]['element'][$field]['source']['path'];
				
				// define source
				$out['element'][$field]['source'] = $config['config']['table'][$table]['element'][$field]['source']['name'];
				
				
				// find base path from media manager instance
				$out['element'][$field]['path'] = $config['config']['table'][$out['element'][$field]['source']]['base_path'];
				
		}
		
		
		
		//handle plugins :
		if ($element['type']=='plugin')
		{
				$out['element'][$field]['plugin_file'] = $config['config']['table'][$table]['element'][$field]['plugin_file'];
		}
		
		
		if ($element['type']=='date')
		{
				$out['calendar_needed'] = true;
				
		}
		
		
		// if we need one or more html editor (html_editor is then true),
		// we populate a list of the field requiring html editor support, which is html_fields
		if ($element['wysiwyg']['enable']=='true')
		{
				$out['wysiwyg_editor_needed'] = true;
				$out['element'][$field]['wysiwyg'] = true;
		}
		
		
}
*/

/*
// querying the db to get the data needed
if ($config['config']['table'][$table]['locale']['type'] == 'multilingual')
{
		$query = "select * from ".	$config['config']['table'][$table]['table'] . " where id = '$id' and locale = '$db_locale'";
}
else
{
		$query = "select * from ".	$config['config']['table'][$table]['table'] . " where id = '$id'";
}

//$items = $db->get_row($query, ARRAY_A);
if ($debug) $db->debug();

foreach ($items as $key => $val)
{
		$out['data'][$key] = $val;
		
}
*/




// generates the breadcrumb data


//$out['breadcrumb'][0]['title'] = translate('home_link');
//$out['breadcrumb'][0]['url'] = 'main.php';

$out['breadcrumb'][1]['title'] = $table_object->getTitle();
$out['breadcrumb'][1]['url'] = $url->linkTo($table_object, 'list.php');

$out['breadcrumb'][2]['title'] = translate('editing_link');
$out['breadcrumb'][2]['url'] = '';



// describes the banner :
$out['banner']['needed'] = true;
$out['banner']['title'] = $table_object->getTitle();
$out['banner']['message'] = $table_object->getHelp();
$out['banner']['image'] = $table_object->getIcon();





debug($out, 'OUT');
debug($_REQUEST, 'Request');


if ($url->get('save_and_return_to_list'))
{
		$url->set('info', 'edit_successfull');
		$url->set('action', 'save');
		$url->keepParam('type');
		$url->keepParam('class');
		$url->redirect('list.php');
}


// include the templates

include('header.template.php');
include('edit.template.php');
include('footer.template.php');



?>

