<?php
require_once '../thinkedit.init.php';
require_once(ROOT . '/class/url.class.php');
require_once(ROOT . '/class/session.class.php');



$thinkedit->context->set('interface');


/******************* Template helpers (aka "tags") *******************/
require_once ROOT . '/lib/thinkedit/template.lib.php';


$url = new url();

?>
