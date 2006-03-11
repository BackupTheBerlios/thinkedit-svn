<?php

require_once '../thinkedit.init.php';

//**** old tools :
// common include file for thinkedit
//require_once('xml_parser.inc.php');
//require_once('debuglib.inc.php');
//require_once('debug.inc.php');
//require_once('ez_sql.inc.php');
//require_once('error.inc.php');
//require_once('locale.inc.php');
//require_once('file.inc.php');
//require_once('tools.inc.php');
require_once('user.inc.php');

//***** new tools
//require_once(ROOT . '/lib/timer/timer.inc.php');
require_once(ROOT . '/class/url.class.php');
require_once(ROOT . '/class/user.class.php');
require_once(ROOT . '/class/session.class.php');

//$config = $thinkedit->config;
$url = new url();
//$user = new user();
$session = new session();

// set locale to 'fr' for testing purposes
$interface_locale = 'fr';
// debug(' Interface Locale is '. $interface_locale);

// todo : setup user locale somewhere
require_once ROOT . '/class/interface_locale.class.php';
$interface_locale = new interface_locale(ROOT . '/edit/ressource/locale/fr.php');


// initialize DB class
//$db = $thinkedit->getDb();



// initialize DB class for interface translations
//$locale_db = $thinkedit->getDb();


// include api
// require_once('api.inc.php');


// choose preferred_locale
/*
if (isset($_SESSION['preferred_locale']))
{
		$preferred_locale = $_SESSION['preferred_locale'];
}
else
{
		$preferred_locale = get_main_locale();
}
*/


?>
