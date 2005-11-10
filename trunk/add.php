<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/form.class.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/node.class.php';
require_once ROOT . '/class/page.class.php';


//this is a test

$page = new page();
$url = new url();


if ($url->getParam('node_id'))
{
  $id = (int) $url->getParam('node_id');
}
else
{
  echo translate('need_node_to_add');
}

if ($url->getParam('module_type'))
{
$module_type = $url->getParam('module_type');
}
else
{
  echo translate('need_module_type_to_add');
}


$node = new node($node_id);


$module = $thinkedit->newModule($module_type);

// instantiate form
$form = new form($module);

if ($form->validate())
{
  // save module and redirect
  $form->module->save();
	
	// add module to current node :
	$node->addChild($form->module);
  
  $url = new url();
  $url->setFileName('browser.php');

  // redirect to parent if possible
  if ($node->hasParent())
  {
    $parent = $node->getParent();
    $url->setParam('node_id', $parent->getId());
  }

  header('location: ' . $url->render());
}
else
{
  // render form
  $page->startPanel('title', 'title');
  $page->add(translate('edit_title'));
  $page->endPanel('title');

  $page->startPanel('breadcrumb', 'breadcrumb');
  $page->add('Breadcrumb here');
  $page->endPanel('breadcrumb');

  $page->startPanel('actions', 'actions');
  $page->add('This is the actions menu');
  $page->endPanel('actions');


  $page->startPanel('form');
  $page->add($form->render());
  $page->endPanel('form');

  $page->startPanel('footer', 'footer');
  $page->add('&copy; Philippe Jadin');
  $page->endPanel('footer');

  echo $page->render();


}



?>
