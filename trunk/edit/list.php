<?php
/*
Thinkedit by Philippe Jadin and Pierre Lecrenier


List displays a list page for the current $table

todo : validation of the request arguments against the config file to avoid hack

*/

include_once('common.inc.php');

//check_user
check_user();


// -----------------------------
// we need a table if we want to work on it
// -----------------------------
if (!$url->get('table'))
{
		error("Please select a table from the main menu");
}
else
{
		$table = $url->get('table');
		$table_object = $thinkedit->newTable($table);
		$record = $thinkedit->newRecord($table);
}


$out['table'] = $table;


//$title_row = get_table_title_row($table);


if (is_multilingual($table))
{
		$out['multilingual'] = true;
}
else
{
		$out['multilingual'] = false;
}

/*
// check if we have poweredit mode
if ($_REQUEST['enable_power_edit']=='yes')
{
		$_SESSION[$table]['power_edit']['enable'] = true;
}
elseif ($_REQUEST['enable_power_edit']=='no')
{
		$_SESSION[$table]['power_edit']['enable'] = false;
}

$enable_power_edit = $_SESSION[$table]['power_edit']['enable'] or false;
*/


//if ($debug) print_a($_SESSION);

//if ($debug) echo(get_preferred_locale());

/*
if ($config['config']['table'][$table]['use']['buttons']=='false')
{
		$out['buttons'] = 'false';
}
*/
// -----------------------------
//handle SAVE from poweredit mode
// we do this now, so the updated data are shown in the query done bellow
// -----------------------------

/*
if (($enable_power_edit) and ($_REQUEST['input']))
{
		$input = $_REQUEST['input'];
		if ($debug) print_a($input);
		
		foreach ($input as $id=>$fields)
		{
				$query = "UPDATE " . $config['config']['table'][$table]['table']. " set ";
				
				$insert_into='';
				foreach ($fields as $field=>$data)
				{
						$insert_into.=" " . $field . "='" . $db->$data ."',";
				}
				
				
				
				
				// remove last ',' from query string
				$insert_into=rtrim($insert_into, ",");
				$query .= $insert_into;
				$query .= " WHERE id='$id'";;
				
				if ($config['config']['table'][$table]['locale']['type'] == 'multilingual')
				{
						$query .= " and locale='$preferred_locale'";
				}
				
				//echo $query . '<hr>';
				$db->query($query);
				if ($debug) $db->debug();
				//$db->debug();
		}
		
		$out['info'] = translate('items_save_successfully');
}
*/











// -----------------------------
// publish ?
// -----------------------------
/*

<!-- used to publish on / off / wathever an element. Per locale -->
<publish>
<!-- name of the table storing the different states of the status of something -->
<source>status</source>
</publish>

*/
/*
if (isset($config['config']['table'][$table]['publish']['source']))
{
		$enable_publish = true;
		$publish_table = $config['config']['table'][$table]['publish']['source'];
		
		// build a list of available status, with their colors and code :
		$publish_table = $config['config']['table'][$publish_table]['table'];
		
		if (!publish_table) die ('wrong publish table in config.xml file');
		
		$query = "select * from $publish_table";
		
		$publish = $db->get_results($query);
		if ($debug) $db->debug();
		
		if ($publish)
		{
				
				foreach ($publish as $publish_item)
				{
						$out['publish'][$publish_item->id]['title'] = $publish_item->title;
						$out['publish'][$publish_item->id]['color'] = $publish_item->color;
						$out['publish'][$publish_item->id]['code'] = $publish_item->code;
						
				}
				
		}
		
		//print_a($out['status']);
}
*/

//$title_row = $config['config']['table'][$table]['title_row'];
//$locale_field = get_table_locale_field($table);
//$main_locale = get_main_locale();


// special case for file manager : add an image / icon column
/*
if ($config['config']['table'][$table]['type'] == 'filemanager')
{
		$out['enable_thumbnails'] = true;
}
*/



// -----------------------------
// sorting
// -----------------------------

if ($url->get('sort'))
{
		//$sort_field = $db->($_REQUEST['sort']);
		$_SESSION[$table]['sort_field'] = $url->get('sort');
}
/*
else
{
		if (isset($_SESSION[$table]['sort_field']))
		{
				$sort_field = $_SESSION[$table]['sort_field'];
		}
		else
		{
				$sort_field = $title_row;
		}
}
*/



if ($url->get('action') =='add_filter')
{
		$_SESSION['filters'][$table][$filter]['value']=$filter_value;
}


if ($url->get('action')=='remove_filter')
{
		unset ($_SESSION['filters'][$table][$filter]);
}



/*
if ($config['config']['table'][$table]['sorting']['enable']=='true')
{
		$sort_field = $config['config']['table'][$table]['sorting']['field'];
		$out['enable_sort'] = true;
}
*/



// -----------------------------
// generating the items list from the config array
// -----------------------------
foreach($record->field as $field)
{
		
		if ($field->useInView('list'))
		{
				$out['element'][$field->getName()]['title'] = $field->getTitle();;
				$out['element'][$field->getName()]['help'] = $field->getHelp();
				$out['element'][$field->getName()]['type'] = $field->getType();
				
				/*
				if ($element['type'] =='image')
				{
						$out['element'][$key]['path'] = $config['config']['table'][$table]['element'][$key]['source']['path'];
				}
				*/
				
		}
		
		// generating the filter dropdown menus
		
		if ($field->getType() == 'lookup')
		{
				//$out['filters'][$key][];
				
				
				
				/*
				$query = "select * from " . $element['source']['table'] ;
				
				if (is_multilingual($element['source']['table']))
				{
						$filter_locale_field = get_table_locale_field($element['source']['table']);
						$query .=" where $filter_locale_field='$main_locale' ";
				}
				
				
				$filter_title_row = $config['config']['table'][$element['source']['table']]['title_row'];
				
				$query .=" order by $filter_title_row";
				
				//$query = "select * from " . $element['source']['table'] . " order by title";
				$items = $db->get_results($query);
				if ($debug) $db->debug();
				
				//$db->debug();
				
				$out['filters'][$key]['filter_name'] = $element['title'][$interface_locale];
				$i=0;
				foreach ($items as $item)
				{
						$out['filters'][$key]['data'][$i]['value'] = $item->$element['source']['value_field'];
						$out['filters'][$key]['data'][$i]['label'] = $item->$element['source']['label_field'];
						
						if (($item->$element['source']['value_field'] == $_SESSION['filters'][$table][$key]['value']) and (isset($_SESSION['filters'][$table][$key])))
						{
								$out['filters'][$key]['data'][$i]['selected'] = true;
						}
						
						$i++;
				}
			*/	
		}
		
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
				foreach ($_SESSION['filters'][$table] as $the_element=>$filter)
				{
						$i++;
						///$filter_field = $db->($the_element);
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
//$query = "select * from ".	$config['config']['table'][$table]['table'] . $where_clause . " order by '$sort_field'" . $limit_clause;
//$items = $db->get_results($query, ARRAY_A);

$records = $record->find(); 

//if (isset($debug)) $db->debug();

//debug($record);

//$db->debug();
$i=0;

if ($records)
{
		foreach ($records as $item)
		{
				
				
				
				foreach ($item->field as $field )
				{
						$item_locale = 'fr';
						$out['data'][$item->getId()][$field->getName()] = $field->get();
						// $out['data'][$item['id']][$item['locale']][$key] = substr($val, 0, 15);
						/*
						if ($key == 'publish')
						{
								$out['data'][$item['id']][$item_locale]['publish'] = $val or '1';
						}
						
						else
						{
								if (is_multilingual($table))
								{
										// if we use the poweredit, we should not strip anything from the query
										if (!$enable_power_edit)
										{
												$out['data'][$item['id']][$item_locale][$key] = strip_tags(substr ($val, 0, 32));
										}
										else
										{
												$out['data'][$item['id']][$item_locale][$key] = $val;
										}
										
										//fill in missing translations adding some special chars
										//foreach
								}
								else
								{
										if (!$enable_power_edit)
										{
												$out['data'][$item['id']][$item_locale][$key] = strip_tags(substr ($val, 0, 32));
										}
										else
										{
												$out['data'][$item['id']][$item_locale][$key] = $val;
										}
										*/
        }
		}
		$i++;
}




// -----------------------------
//handle poweredit mode
// -----------------------------


if (isset($enable_power_edit))
{
		
		$power_edit_element_count = 0;
		foreach($config['config']['table'][$table]['element'] as $key=>$element)
		{
				
				if ( ($element['use']['power_edit'] == 'true') or ( $config['config']['table'][$table]['title_row'] == $key )  )
				{
						$power_edit_element_count++;
						$out['power_edit']['elements'][$key]['title'] = $element['title'][$interface_locale];
						$out['power_edit']['elements'][$key]['help'] = $element['help'][$interface_locale];
						$out['power_edit']['elements'][$key]['type'] = $element['type'];
						
						if ($element['type'] =='date')
						{
								$out['calendar_needed'] = true;
								$out['interface_locale'] = $interface_locale;
								// blazblabla
						}
						
						if ($element['type'] == 'image') die ('image not supported in power edit, check config.xml');
						if ($element['type'] == 'password') die ('password not supported in power edit for security reasons, check config.xml');
						if ($element['type'] == 'checkbox') die ('checkbox not supported in power edit, check config.xml');
						if ($element['type'] == 'relation') die ('relation not supported in power edit, check config.xml');
						
				}
		}
		
		$out['power_edit']['element_count'] = $power_edit_element_count;
		
		$out['power_edit']['element_html_width'] = (int) (100 / $power_edit_element_count);
		
		
}





// -----------------------------
// generates the breadcrumb data
// -----------------------------
$out['breadcrumb'][1]['title'] = $table_object->getTitle();
$out['breadcrumb'][1]['url'] = 'list.php?table=' . $table_object->getTableName();





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


//print_a ($out);








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

