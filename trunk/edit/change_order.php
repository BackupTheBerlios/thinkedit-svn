<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier


Change order is used to change the order of a table element depending of it's sort field, curent position.
It gives the possiblity to arbitraly move an element up and down into a list.


input needed :
$action= move_up / move_down / move_bottom / move_top
$module = one of the module
$id = element id into this module


// added group by to the sql query to have only the differents order by's with multi locale for example. 

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


if (is_null($_REQUEST['id']))
{
  error("Please choose an id");
}

$id = $_REQUEST['id'];
$out['id'] = $id;

$action = $_REQUEST['action'];


$sort_field = $config['config']['module'][$module]['sorting']['field'];
$table = $config['config']['module'][$module]['table'];

// get the order of the current element
$current_order = $db->get_var("select $sort_field from $table where id=$id");



if ($action=='move_up') //if we move up, we need to decrease the order field between previous and current
{
  // we need to determine the order of previous element of the current one
  $previous_order = $db->get_var("select $sort_field from $table where $sort_field < $current_order group by '$sort_field' order by '$sort_field' desc limit 0,1");
  
	if ($debug) $db->debug();
	
	debug2($previous_order, 'previous order');
	
	$pre_previous_order = $db->get_var("select $sort_field from $table where $sort_field < $current_order group by '$sort_field' order by '$sort_field' desc limit 1,1");

	debug2($pre_previous_order, 'pre-previous order');
	
	if ($debug) $db->debug();
	
  if ($previous_order) // only if we have something lower than the current position we need to move
  {
    if ($pre_previous_order == '') $pre_previous_order = $previous_order - 1;
    $new_order = $pre_previous_order + (($previous_order - $pre_previous_order) / 2);
  }

}

if ($action=='move_down')
{
  // we need to determine the order of the next element of the current one
  $next_order = $db->get_var("select $sort_field from $table where $sort_field > $current_order group by '$sort_field' order by '$sort_field' asc  limit 0,1");
	
  debug2($next_order, 'next order');
	
	if ($debug) $db->debug();
	
  $next_next_order = $db->get_var("select $sort_field from $table where $sort_field > $current_order group by '$sort_field' order by '$sort_field' asc limit 1,1");

	if ($debug) $db->debug();
	
  if ($next_order) // only if we have something lower than the current position we need to move
  {
    if (!$next_next_order) $next_next_order = $next_order + 1;
    $new_order = $next_order + (($next_next_order - $next_order) / 2);
  }
}


if ($action=='move_bottom')
{
  // we need to determine the order of the next element of the current one
  $new_order = $db->get_var("select max($sort_field) from $table") + 1;
  // $new_order = $current_order + (($next_order - $current_order) / 2);
  if ($debug)  echo ($new_order);
  if ($debug)  $db->debug();
}


if ($action=='move_top')
{
  // we need to determine the order of the next element of the current one
  $new_order = $db->get_var("select min($sort_field) from $table") - 1;
  // $new_order = $current_order + (($next_order - $current_order) / 2);
  // echo ($new_order);
  if ($debug) $db->debug();
}


if ($debug) echo('new order : ' . $new_order . '<hr>');
if ($debug) echo('action : ' . $action . '<hr>');

if (isset($action) and isset($new_order))
{
  $set_order_query = "update $table set $sort_field = '$new_order' where id = '$id'";
  // echo $set_order_query;

  $db->query($set_order_query);
  if ($debug) $db->debug();
}


// redirect to list page...
header("Location: http://".$_SERVER['HTTP_HOST']
.dirname($_SERVER['PHP_SELF'])
."/". "list.php?module=$module&db_locale=$db_locale&id=$id");


?>
