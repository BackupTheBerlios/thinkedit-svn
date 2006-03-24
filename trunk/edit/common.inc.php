<?php
require_once '../thinkedit.init.php';
require_once(ROOT . '/class/url.class.php');
require_once(ROOT . '/class/session.class.php');

//$config = $thinkedit->config;
$url = new url();
$session = new session();

// set locale to 'fr' for testing purposes
$interface_locale = 'fr';

// todo : setup user locale somewhere
require_once ROOT . '/class/interface_locale.class.php';
$interface_locale = new interface_locale(ROOT . '/edit/ressource/locale/fr.php');

$thinkedit->context->set('interface');


/******************* Template helpers (aka "tags") *******************/
require_once ROOT . '/lib/thinkedit/template.lib.php';

?>
