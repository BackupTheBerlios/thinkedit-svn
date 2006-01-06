<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier


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



if (!$_REQUEST['db_locale'] and $config['config']['module'][$module]['locale']['type'] == 'multilingual')
{
  error("Please choose a db locale");
}

$db_locale  = $_REQUEST['db_locale'];
$out['db_locale'] = $db_locale;



/* changed : delete all locales at all time */


//depending if the module is multiligual or not, we create a query including locale or not.
/*
if ($config['config']['module'][$module]['locale']['type'] == 'multilingual')
{
$query = "delete from " . $config['config']['module'][$module]['table'] . " where id='$id' and locale='$db_locale'";
}
else
{
$query = "delete from " . $config['config']['module'][$module]['table'] . " where id='$id'";
}

*/

$query = "delete from " . $config['config']['module'][$module]['table'] . " where id='$id'";


$db->query($query);

if ($debug) $db->debug();


redirect("list.php?module=$module&db_locale=$db_locale&id=$id");

// redirect to list page...
header("Location: http://".$_SERVER['HTTP_HOST']
.dirname($_SERVER['PHP_SELF'])
."/". "list.php?module=$module&db_locale=$db_locale&id=$id");

?>
