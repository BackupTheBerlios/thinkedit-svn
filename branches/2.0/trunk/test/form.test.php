<?php

require_once '../init.inc.php';
require_once '../class/form.class.php';



$module = $thinkedit->newModule('article', 1);
$module->load();


$form = new form($module);

echo $form->render();


?>