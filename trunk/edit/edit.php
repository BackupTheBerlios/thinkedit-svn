<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier


Edit displays an edit page for the current $module, $id, $db_locale

todo : validation of the request arguments agains the config file to avoid hack

*/




include_once('common.inc.php');


//check_user
check_user();



// hack to disable locale pulldown in edit screens

$edit_mode = true;

// check module name
//todo : need validation (from config file)!

if (!$_REQUEST['module'])
{
  error("Please choose a module");
}

$module = $_REQUEST['module'];
$out['module'] = $module;


if (is_null($_REQUEST['id']))
{
  error("Please choose an id");
}

$id = $_REQUEST['id'];
$out['id'] = $id;



if ($config['config']['module'][$module]['locale']['type'] == 'multilingual')
{
if ($_REQUEST['db_locale'])
{
$db_locale  = $_REQUEST['db_locale'];
}
else
{
//  error("Please choose a db locale");
$db_locale  = get_preferred_locale();
}
}

$out['db_locale'] = $db_locale;


$out['interface_locale'] = $interface_locale;



if (isset($config['config']['module'][$module]['publish']['source']))
{
  $enable_publish = true;
  $publish_module = $config['config']['module'][$module]['publish']['source'];

  // build a list of available status, with their colors and code :
  $publish_table = $config['config']['module'][$publish_module]['table'];

  if (!$publish_table) die ('publish module not well set in config.xml');

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

  // print_a($out['status']);
}


// handle save situation
if ($_REQUEST['action']=='save')
{
  if ($debug)	print_a ($_REQUEST);
  //print_a ($_REQUEST);


  $query = "UPDATE " . $config['config']['module'][$module]['table']. " set ";


  foreach($config['config']['module'][$module]['element'] as $key=>$element)
  {

    // special case about relations, they are not saved in the element table
    if ($element['type'] <> 'relation')
    {
      if ($element['type']  == 'checkbox')
      {
        //echo $_REQUEST[$key];
        //print_a ($_REQUEST);
        if (isset($_REQUEST[$key]))
        {
          $insert_into.=" " . $key . "='1',";
        }
        else
        {
          $insert_into.=" " . $key . "='0',";
        }

      }
      else
      {
        $insert_into.=" " . $key . "='" . $db->escape($_REQUEST[$key]) ."',";
      }
    }



  }

  if ($enable_publish)
  {
    $insert_into.=" publish='" . $db->escape($_REQUEST['publish']) ."',";
  }
  // remove last ',' from query string
  $insert_into=rtrim($insert_into, ",");

  $query .= $insert_into;
  $query .= " WHERE id='$id'";;

  if ($config['config']['module'][$module]['locale']['type'] == 'multilingual')
  {
    $query .= " and locale='$db_locale'";
  }


  $db->query($query);
  if ($debug) $db->debug();
  //$db->debug();




  //handle shared properties between multiple locales

  if (is_multilingual($module))
  {
    $query = "UPDATE " . $config['config']['module'][$module]['table']. " set ";
    $insert_into='';

    foreach($config['config']['module'][$module]['element'] as $key=>$element)
    {
      if ($element['shared'] == 'true')
      {
        $insert_into.=" " . $key . "='" . $db->escape($_REQUEST[$key]) ."',";
        $need_query = true;
      }
    }


    // after iterating trought the eventual shared elements, if needed, we do the cross locale query

    if ($need_query)
    {
      // remove last ',' from query string
      $insert_into=rtrim($insert_into, ",");

      $query .= $insert_into;
      $query .= " WHERE id='$id'";;

      $db->query($query);

      if ($debug) echo '<h1>' . ($query) . '</h1>';

      if ($debug) $db->debug();
    }
  }


  $out['info'] = translate('item_save_successfully');

}


// generating the items list from the config array

foreach($config['config']['module'][$module]['element'] as $field=>$element)
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

    $source_module = $element['source']['table'];

    if (is_multilingual($source_module))
    {
      $query = "select * from " . $source_module . " where locale='$preferred_locale'";
    }
    else
    {
      $query = "select * from " . $source_module;
    }



    $items = $db->get_results($query);
    if ($debug) $db->debug();


    $out['element'][$field]['manage_list_url'] = "list.php?module=".$element['source']['table'];

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
	$out['element'][$field]['manage_list_url'] = "list.php?module=".$element['source']['table'];
	}
	
	

  //handle image folder :
  if ($element['type']=='image')
  {
    // $out['element'][$field]['path'] = $config['config']['module'][$module]['element'][$field]['source']['path'];
    
		// define source
		$out['element'][$field]['source'] = $config['config']['module'][$module]['element'][$field]['source']['name'];
		
		
		// find base path from media manager instance
		$out['element'][$field]['path'] = $config['config']['module'][$out['element'][$field]['source']]['base_path'];
		
  }



  //handle plugins :
  if ($element['type']=='plugin')
  {
    $out['element'][$field]['plugin_file'] = $config['config']['module'][$module]['element'][$field]['plugin_file'];
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


// querying the db to get the data needed
if ($config['config']['module'][$module]['locale']['type'] == 'multilingual')
{
  $query = "select * from ".	$config['config']['module'][$module]['table'] . " where id = '$id' and locale = '$db_locale'";
}
else
{
  $query = "select * from ".	$config['config']['module'][$module]['table'] . " where id = '$id'";
}

$items = $db->get_row($query, ARRAY_A);
if ($debug) $db->debug();

foreach ($items as $key => $val)
{
  $out['data'][$key] = $val;

}




// generates the breadcrumb data


//$out['breadcrumb'][0]['title'] = translate('home_link');
//$out['breadcrumb'][0]['url'] = 'main.php';

$out['breadcrumb'][1]['title'] = $config['config']['module'][$module]['title'][$interface_locale];
$out['breadcrumb'][1]['url'] = 'list.php?module=' . $module;

$out['breadcrumb'][2]['title'] = translate('editing_link');
$out['breadcrumb'][2]['url'] = '';



// describes the banner :
$out['banner']['needed'] = true;
$out['banner']['title'] = $config['config']['module'][$module]['title'][$interface_locale];
$out['banner']['message'] = $config['config']['module'][$module]['help'][$interface_locale];
$out['banner']['image'] = 'icons/' . $config['config']['module'][$module]['icon'];





if ($debug) print_a ($out);

// print_a ($out);


if ($debug) print_a ($_REQUEST);


if ($_REQUEST['save_and_return_to_list'])
{
  redirect("list.php?module=$module");
}





// include the templates

include('header.template.php');
include('edit.template.php');
include('footer.template.php');



?>

