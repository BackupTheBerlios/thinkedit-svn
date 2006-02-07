<?php
/*
See licence.txt for licence info
List displays a list page for the current $table
todo : validation of the request arguments against the config file to avoid hack
*/

include_once('common.inc.php');

//check_user
check_user();


// -----------------------------
// we need a table if we want to work on it
// -----------------------------
if (!$url->get('type'))
{
		error("Please select a type from the main menu");
}
else
{
		$table = $url->get('type');
		$table_object = $thinkedit->newTable($table);
		$record = $thinkedit->newRecord($table);
}


$out['table'] = $table;

// -----------------------------
// Handle icons
// -----------------------------
$out['enable_thumbnails'] = true;



/********** handle relation mode *********/
if ($session->get('action') == 'relate')
{
		$out['mode'] = 'relation';
}


// -----------------------------
// sorting
// -----------------------------

if ($url->get('sort'))
{
		$sort_field = $url->get('sort');
		$out['sort_field'] = $sort_field;
}

/*
if ($config['config']['table'][$table]['sorting']['enable']=='true')
{
		$sort_field = $config['config']['table'][$table]['sorting']['field'];
		$out['enable_sort'] = true;
}
*/




// -----------------------------
// Filters
// -----------------------------


if ($url->get('action') =='add_filter')
{
		$_SESSION['filters'][$table][$filter]['value']=$filter_value;
}


if ($url->get('action')=='remove_filter')
{
		unset ($_SESSION['filters'][$table][$filter]);
}






// -----------------------------
// generating the items list from the config array
// -----------------------------
foreach($record->field as $field)
{
		
		if ($field->useInView('list'))
		{
				$out['field'][$field->getName()]['title'] = $field->getTitle();;
				$out['field'][$field->getName()]['help'] = $field->getHelp();
				$out['field'][$field->getName()]['type'] = $field->getType();
				
				if ($field->isSortable())
				{
				$out['field'][$field->getName()]['sortable'] = true;
				$url = new url();
				$url->keep('type');
				$url->keep('class');
				$url->set('sort', $field->getName());
				$out['field'][$field->getName()]['sort_url'] = $url->render();
				}
		}
		
		// generating the filter dropdown menus
		
		if ($field->getType() == 'lookup')
		{
				//$out['filters'][$key][];
				
				
				
				/*
				$query = "select * from " . $field['source']['table'] ;
				
				if (is_multilingual($field['source']['table']))
				{
						$filter_locale_field = get_table_locale_field($field['source']['table']);
						$query .=" where $filter_locale_field='$main_locale' ";
				}
				
				
				$filter_title_row = $config['config']['table'][$field['source']['table']]['title_row'];
				
				$query .=" order by $filter_title_row";
				
				//$query = "select * from " . $field['source']['table'] . " order by title";
				$items = $db->get_results($query);
				if ($debug) $db->debug();
				
				//$db->debug();
				
				$out['filters'][$key]['filter_name'] = $field['title'][$interface_locale];
				$i=0;
				foreach ($items as $item)
				{
						$out['filters'][$key]['data'][$i]['value'] = $item->$field['source']['value_field'];
						$out['filters'][$key]['data'][$i]['label'] = $item->$field['source']['label_field'];
						
						if (($item->$field['source']['value_field'] == $_SESSION['filters'][$table][$key]['value']) and (isset($_SESSION['filters'][$table][$key])))
						{
								$out['filters'][$key]['data'][$i]['selected'] = true;
						}
						
						$i++;
				}
			*/	
		}
		
}

if (empty($out['field']))
{
		error('no title fields for this table');
}



// -----------------------------
// test if we need to filter content :
// -----------------------------
if (isset($_SESSION['filters'][$table]))
{
		$num_filters = count($_SESSION['filters'][$table]);
		if ($num_filters > 0)
		{
				$i=0;
				$where_clause .= ' where ';
				foreach ($_SESSION['filters'][$table] as $the_field=>$filter)
				{
						$i++;
						///$filter_field = $db->($the_field);
						///$filter_value = $db->($filter['value']);
						$where_clause .= " $filter_field=$filter_value ";
						if ($i < $num_filters) $where_clause .= ' and ';
						
				}
		}
}





// -----------------------------
// handle alphabatch if needed :
// -----------------------------
if (isset($config['config']['table'][$table]['alphabatch']['enable']))
{
		
		
		$alpha_query = "select lower(left($title_row,1)) as alphabet from $table group by alphabet order by alphabet";
		
		$alpha = $db->get_results($alpha_query, ARRAY_A);
		//$db->debug();
		
		if ($db->num_rows > 0)
		{
				$out['alpha']['enable'] = true;
				foreach ($alpha as $letter)
				{
						$out['alpha']['data'][] = strtoupper($letter['alphabet']);
				}
				// print_a ($out['alpha']);
		}
		
		if (isset ($_REQUEST['letter']))
		{
				$letter = $_REQUEST['letter'];
				$_SESSION[$table]['alpha']['letter'] = $letter;
		}
		
		elseif (isset($_SESSION[$table]['alpha']['letter']))
		{
				$letter = $_SESSION[$table]['alpha']['letter'];
		}
		
		else
		{
				$letter = false;
		}
		
		
		
		if ($letter)
		{
				$out['alpha']['letter'] = $letter;
				if ($where_clause)
				{
						$where_clause .= " and $title_row LIKE \"$letter%\" ";
				}
				else
				{
						$where_clause .= " where $title_row LIKE \"$letter%\" ";
				}
		}
		
		//print_a ($out['alpha']);
}




// -----------------------------
// handle paged result sets (batch) from the <batch> tag in config at the table level :
// -----------------------------
/*
if (get_table_batch_size($table) > 0)
{
		if (isset ($_REQUEST['page']))
		{
				$page = $_REQUEST['page'];
				$_SESSION[$table]['batch']['page'] = $page;
		}
		
		elseif (isset($_SESSION[$table]['batch']['page']))
		{
				$page = $_SESSION[$table]['batch']['page'];
		}
		
		else
		{
				$page = 0;
		}
		
		//reset batch if we have a filter
		
		if ($_REQUEST['action'] == 'add_filter')
		{
				$page=0;
		}
		
		if ($_REQUEST['letter'])
		{
				$page=0;
		}
		
		//   update session machinery when final judgement on the good value for page has been made;
		
		$_SESSION[$table]['batch']['page'] = $page;
		
		//print_a($_REQUEST);
		//print_a($_SESSION);
		//echo $page;
		$batch_size = get_table_batch_size ($table);
		$start = $page * $batch_size;
		
		$limit_clause = " limit $start, $batch_size ";
		
		
		// not needed as far as I can see, as we use a global where clause $where_clause
		// attention please ! : if we are using alpha tabs (cfr <alphabatch> tag in config), we need to count only those present in the alphabatch
		if ($out['alpha']['enable'])
		//{
		//}
		//
		
		
		
		
		// handle number of pages if batch mode :
		$query = "select count(*) from ".	$config['config']['table'][$table]['table'] . $where_clause;
		$num_rows = $db->get_var($query);
		if ($debug) $db->debug();
		//$db->debug();
		
		
		$num_of_pages = ceil($num_rows / (float)$batch_size);
		$out['batch']['num_of_pages'] = $num_of_pages;
		
		$out['batch']['current_page'] = $page;
		
		if  ($num_of_pages > 1)
		{
				$out['batch']['enable'] = true;
		}
		
		
		
		
}
*/

//print_a($out['batch']);


// -----------------------------
// Handle file manager case : we don't want to show empty folders (with empty file names)
// -----------------------------
/*
if ($config['config']['table'][$table]['type'] == 'filemanager')
{
    if ($where_clause)
    {
				$where_clause .= " and filename <> '' ";
    }
    else
    {
				$where_clause .= " where filename <> '' ";
    }
}
*/

// -----------------------------
// query items to show content on the table page
// -----------------------------


// sorting


if (isset($sort_field))
{
$sort_query = array($sort_field => 'asc');

}
else
{
		$sort_query = false;
}

$records = $record->find(false, $sort_query); 



$i=0;

if ($records)
{
		foreach ($records as $item)
		{
				$out['data'][$item->getId()]['icon'] = $item->getIcon();
				$out['data'][$item->getId()]['uid'] = $item->getUid();
				
				$url = new url();
				$out['data'][$item->getId()]['edit_url'] = $url->linkTo($item, 'edit.php');
				$out['data'][$item->getId()]['delete_url'] = $url->linkTo($item, 'delete.php');
				
				if ($session->get('action') == 'relate')
				{
						$url->set('action', 'relate');
						$out['data'][$item->getId()]['relate_url'] = $url->linkTo($item, 'relate.php');
				}
				//$out['data'][$item->getId()]['plugin_url'] = $url->linkTo($record, '');
				// todo plugin urls
				
				foreach ($item->field as $field )
				{
						$out['data'][$item->getId()]['field'][$field->getName()] = $field->get();
						// $out['data'][$item['id']][$item['locale']][$key] = substr($val, 0, 15);
        }
		}
		$i++;
}




// -----------------------------
//handle poweredit mode
// -----------------------------



// -----------------------------
//handle global actions
// -----------------------------

// add
$url = new url();
$add_action['title'] = translate('add');
$add_action['url'] = $url->linkTo($table_object, 'edit.php');
$out['global_action'][] = $add_action;



// -----------------------------
// generates the breadcrumb data
// -----------------------------
$out['breadcrumb'][1]['title'] = $table_object->getTitle();
$out['breadcrumb'][1]['url'] = $url->linkTo($table_object, 'list.php');





// -----------------------------
// describes the banner :
// -----------------------------
$out['banner']['needed'] = true;
$out['banner']['title'] = $table_object->getTitle();
$out['banner']['message'] = $table_object->getHelp();
$out['banner']['image'] = $table_object->getIcon();




// -----------------------------
// handle plugins :
// -----------------------------
if (isset($config['config']['table'][$table]['plugin']))
{
		foreach($config['config']['table'][$table]['plugin'] as $key=>$plugin)
		{
				$out['plugins'][$key] = $plugin;
		}
		//print_a ($config['config']['table'][$table]['plugin']);
		//print_a ($out);
}


debug($out, 'OUT');


if ($url->get('info'))
{
		$out['info'] = translate($url->get('info')); // todo security check in translate and in record
}


// -----------------------------
// include the templates
// -----------------------------
include('header.template.php');

if (isset($error)) // deprecated; must check if still used
{
		include('error.template.php');
}
else
{
		include('list.template.php');
}



include('footer.template.php');



?>

