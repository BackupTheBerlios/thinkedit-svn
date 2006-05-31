<?php

require_once '../init.inc.php';
require_once '../class/form.class.php';
/*
$module = $thinkedit->newModule('folder');
$module->setTitle('Bonjour les amis');
$module->save();

debug($module->getId());
*/

$module = $thinkedit->newModule('folder', 1);
$module->load();

$form = new form($module);

//$form->module->element->title->set('Hello guys ' . rand(1,100));

foreach ($form->module->element as $key => $element)
{
  if ($form->module->element->$key->getName() == 'title')
  {
    $form->module->element->$key->set('Hello guys ' . rand(1,100));
    print_r($element);
  }
}

// $form->validate();

// $form->module->save();
$module->save();

echo $module->debug();

?>