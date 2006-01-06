<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier


Add displays an edit page for the current $module, $id, $db_locale

todo : validation of the request arguments agains the config file to avoid hack

*/

include_once('common.inc.php');
//check_user
check_user();



// check module name
// todo : need validation (from config file)!

if (!$_REQUEST['module'])
{
  error("Please choose a module");
}

$module = $_REQUEST['module'];
$out['module'] = $module;

$id = $_REQUEST['id'];



$db_locale = $_REQUEST['db_locale'];

if (!$_REQUEST['db_locale'] and $config['config']['module'][$module]['locale']['type'] == 'multilingual')
{
  $db_locale = get_preferred_locale();
}


if ($config['config']['module'][$module]['sorting']['enable'] == 'true')
{
  $enable_sort = true;
  $sort_field = $config['config']['module'][$module]['sorting']['field'];
}
else
{
$enable_sort = false;
}


/*
if ($enable_sort)
{
// get bigest order
$latest_order = $db->get_var("SELECT max($sort_field) FROM $store_table where $store_current_field=$id") + 1;

*/

// no id, we need to insert a new row in the db.
if (!$id)
{
  if ($config['config']['module'][$module]['locale']['type'] == 'multilingual')
  {
    if ($enable_sort) // we need to put the item at the end of the list by finding the highest order number (and by adding 1 to it)
    {
      // get bigest order
      //$latest_order = $db->get_var('SELECT max(' . $sort_field . ") FROM $config['config']['module'][$module]['table']");
			$latest_order++;
			
			// find a free id
			$new_id = $db->get_var('SELECT max(id) FROM ' . $config['config']['module'][$module]['table']);
			$new_id++;
			
			
			
			foreach (get_all_locales() as $locale)
			{
      $query = "insert into " . $config['config']['module'][$module]['table'] . "(id, locale, $sort_field) values ($new_id, '$locale', '$latest_order')";
			$db->query($query);
			}
    }
    else
    {
      $query = "insert into " . $config['config']['module'][$module]['table'] . "(id, locale) values ('', '$db_locale')";
			$db->query($query);
    }
  }
  else
  {

    if ($enable_sort)
    {
      // get bigest order
      // $latest_order = $db->get_var("SELECT max($sort_field) FROM $config['config']['module'][$module]['table']") + 1;
      $query = "insert into " . $config['config']['module'][$module]['table'] . "(id, $sort_field) values ('',  '$latest_order')";
			$db->query($query);
    }
    else
    {
      $query = "insert into " . $config['config']['module'][$module]['table'] . "(id) values ('')";
			$db->query($query);
    }
  }

  //$db->query($query);
  if ($debug) $db->debug();

  $id = $db->insert_id;
}
else //we have an id, we need to translate
{
  //query existing content
	$query = "select * from " . $config['config']['module'][$module]['table'] . " where id='$id' limit 0,1";
  $existing_content = $db->get_row($query, ARRAY_A);
  if ($debug) $db->debug();
	//$db->debug();	
	
	//print_a($existing_content);
	
	
	//die();
	
	// create the new row
	$query = "insert into " . $config['config']['module'][$module]['table'] . "(id, locale) values ('$id', '$db_locale')";
  $db->query($query);
  if ($debug) $db->debug();
	
	
	
	
	// todo : insert rows from shared content from existing element with another locale but same id
	
  //handle shared properties between multiple locales

  if (is_multilingual($module) and $existing_content)
  {
    $query = "UPDATE " . $config['config']['module'][$module]['table']. " set ";
    $insert_into='';

    foreach($config['config']['module'][$module]['element'] as $key=>$element)
    {
      if ($element['shared'] == 'true')
      {
        $insert_into.=" " . $key . "='" . $existing_content[$key] ."',";
        $need_query = true;
      }
    }


    // after iterating trought the eventual shared elements, if needed, we do the cross locale query

    if ($need_query)
    {
      // remove last ',' from query string
      $insert_into=rtrim($insert_into, ",");

      $query .= $insert_into;
      $query .= " WHERE id='$id' and locale='$db_locale' ";;

      $db->query($query);

      if ($debug) echo '<h1>' . ($query) . '</h1>';

      if ($debug) $db->debug();
    }
  }
	
	
	
	
}



// redirect to edit page...
header("Location: http://".$_SERVER['HTTP_HOST']
.dirname($_SERVER['PHP_SELF'])
."/". "edit.php?module=$module&db_locale=$db_locale&id=$id");

?>
