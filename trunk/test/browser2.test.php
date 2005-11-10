<?php
require_once 'init.inc.php';
require_once 'class/module.class.php';
require_once 'class/browser.class.php';
require_once 'class/page.class.php';
require_once 'class/url.class.php';

$browser = new browser();
$page = new page();
$url = new url();

if ($url->getParam('node'))
{
  $node = $url->getParam('node');
}
else
{
  $node = 1;
}


$module = new module($node);


$page->startPanel('test');
$page->add($module->view());
$page->endPanel('test');



$page->startPanel('title');
$page->add('<h1>Welcome to Thinkedit 3.0</h1>');
$page->endPanel('title');

$page->addSeparator();

$page->startPanel('help');
$page->add('Navigate using icons bellow, use "up" to go up in the hierarchy');
$page->endPanel('help');

$page->addSeparator();

$page->startPanel('breadcrumb');
$parent = $module->getParent();
if ($parent)
{
  $parent_link = new url;
	$parent_link->setParam('node', $parent->getNode());
  $page->add('<a href="' . $parent_link->render() . '">Up</a> ');
}
else
{
$page->add('You are at the root of this site');
}

$page->endPanel('breadcrumb');

$page->addSeparator();


$browser->addAction('delete', 'effacer');
$browser->setGlobalAction('browse');



$childs = $module->getChild();

if ($childs)
{
  foreach ($childs as $child)
  {
  $browser->addFolder($child);
  }
}


$page->startPanel('browser');
$page->add($browser->render());
$page->endPanel('browser');

$page->addSeparator();

$page->startPanel('copy');
$page->add('&copy; Philippe Jadin');
$page->endPanel('copy');

echo $page->render();

?>