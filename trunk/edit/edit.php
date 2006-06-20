<?php
/*
See licence.txt for licence
Edit displays an edit page for the current $table, $id, $db_locale
todo : validation of the request arguments agains the config file to avoid hack

input :


- action : edit_node, new_node, edit, new
- object_ : the object to edit


big simplification :

Input is :

- id
- class
- type
-> record edit mode


Input is
- node_id
- (locale)
-> node edit mode

*/

include_once('common.inc.php');


//check_user
check_user();

$url = $thinkedit->newUrl();


if (!$url->getParam('type'))
{
		trigger_error('edit : you must supply a type in the url');
}

if (!$url->getParam('class'))
{
		trigger_error('edit : you must supply a class in the url');
}


if ($url->get('mode') == 'edit_node')
{
		$out['edit_node'] = true;
		$edit_node = true;
		$node_id = $url->get('node_id');
		
		$node = $thinkedit->newNode();
		$node->setId($node_id);
		$node->load();
		
}


if ($url->get('mode') == 'new_node')
{
		$out['edit_node'] = true;
		$node = $thinkedit->newNode();
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
				trigger_error('edit : failed saving record');
		}
}


/****************** Handle Node save ******************/
// we save only if the node already exists
if ($url->get('mode') <> 'new_node')
{
		if ($url->get('action')=='save' && isset($node))
		{
				debug($_REQUEST, '(node) Request');
				foreach ($node->record->field as $field)
				{
						// we take only the posted form data with the node_ prefix
						if (isset($_POST['node_' . $field->getName()]))
						{
								$node->record->set($field->getName(), $_POST['node_' . $field->getName()]);
						}
				}
				
				debug($record, 'Node record before saving');
				if ($node->save())
				{
						$out['info'] = translate('item_save_successfully');
				}
				else
				{
						trigger_error('edit : failed saving node record');
				}
				if ($url->get('mode') == 'edit_node')
				{
						$node->clearContentCache();
				}
		}
}



/************** handle add node *****************/
// if we have saved something, and if we need to add to thge node tree, we redirect with the record ID

$url = $thinkedit->newUrl();

if ($url->get('action')=='save' && $url->get('mode') == 'new_node')
{
		$url->keep('mode');
		$url->keep('node_id');
		// $url->debug();
		
		
		$url->addObject($record, 'object_');
		$url->redirect('structure.php');
		/*
		$redirect = $url->linkTo($record, 'structure.php');
		header('location: ' . $redirect); // todo better url class api
		*/
}

if ($url->get('action')=='save' && $url->get('mode') == 'edit_node')
{
		
		if ($url->get('save_and_return_to_structure'))
		{
				$url->set('info', 'edit_successfull');
				$url->keep('mode');
				$url->keep('node_id');
				$url->redirect('structure.php');
		}
		
		
		/*
		$redirect = $url->linkTo($record, 'structure.php');
		header('location: ' . $redirect); // todo better url class api
		*/
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
		if ($field->isUsedIn('edit'))
		{
				$out['field'][$field->getName()]['ui'] = $field->renderUi();
				if ($field->getType() <> 'id')
				{
						$out['field'][$field->getName()]['title'] = $field->getTitle();
				}
				else
				{
						$out['field'][$field->getName()]['title'] = '';
				}
				$out['field'][$field->getName()]['help'] = $field->getHelp();
		}
}



/****************** Node Form items ******************/

if (isset($node))
{
		foreach ($node->record->field as $field)
		{
				if ($field->isUsedIn('edit'))
				{
						$out['node_field'][$field->getName()]['ui'] = $field->renderUi('node_');
						
						if ($field->getType() <> 'id')
						{
								$out['node_field'][$field->getName()]['title'] = $field->getTitle();
						}
						else
						{
								$out['node_field'][$field->getName()]['title'] = '';
						}
						
						$out['node_field'][$field->getName()]['help'] = $field->getHelp();
				}
		}
}




/****************** Relations ******************/

$url = new url();
$url->addObject($record, 'source_');
$out['relation']['url'] = $url->render('relation.php');

// clean url
$url = new url();


// generates the breadcrumb data


//$out['breadcrumb'][0]['title'] = translate('home_link');
//$out['breadcrumb'][0]['url'] = 'main.php';


// if we are from a node form
if ($url->get('mode') == 'edit_node' or $url->get('mode') == 'new_node')
{
		$out['breadcrumb'][1]['title'] = translate('structure');
		
		if ($parent = $node->getParent())
		{
				$url->set('node_id', $parent->getId());
		}
		else
		{
				$url->set('node_id', $node->getId());
				//	$url->keep('node_id');
		}
		$out['breadcrumb'][1]['url'] = $url->render('structure.php');
}
else
{
		$out['breadcrumb'][1]['title'] = $table_object->getTitle();
		$out['breadcrumb'][1]['url'] = $url->linkTo($table_object, 'list.php');
}

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

