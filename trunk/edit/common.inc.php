<?php
// common include file for thinkedit
require_once('xml_parser.inc.php');
require_once('debuglib.inc.php');
require_once('debug.inc.php');
require_once('ez_sql.inc.php');
require_once('timer.inc.php');
require_once('error.inc.php');
require_once('locale.inc.php');
require_once('file.inc.php');
require_once('tools.inc.php');
require_once('user.inc.php');


// start the session machinery
session_start();

// debug ? : uncomment to enable debugging
// $debug = true;


// read config and parse
$xml_parser = &new xml_parser;
$config = $xml_parser->parse_file('config.xml');

$config['config']['interface']['image_extension']['1']='jpg';


// set locale to 'fr' for testing purposes
$interface_locale = 'fr';
// debug(' Interface Locale is '. $interface_locale);


// initialize DB class
$db = new db($config['config']['site']['database']['main']['user'], $config['config']['site']['database']['main']['password'], $config['config']['site']['database']['main']['db'], $config['config']['site']['database']['main']['host']);



// initialize DB class for interface translations
$locale_db = new db($config['config']['site']['database']['locale']['user'], $config['config']['site']['database']['locale']['password'], $config['config']['site']['database']['locale']['db'], $config['config']['site']['database']['locale']['host']);




// include api
require_once('api.inc.php');


// choose preferred_locale

if (isset($_SESSION['preferred_locale']))
{
$preferred_locale = $_SESSION['preferred_locale'];
}
else
{
$preferred_locale = get_main_locale();
}




?>
