<?php
require_once 'init.inc.php';
require_once 'class/module.class.php';
PEAR::setErrorHandling(PEAR_ERROR_PRINT);

$id = $_REQUEST['id'];
$type = $_REQUEST['type'];

if (!$id) $id = 1;
if (!$type) $type = 'folder';

//$node = new node(2, 'article');
$module = new module($id, $type);


echo '<h1>' . $module->getTitle() . '</h1>';


$parents = $module->getParent();

if ($parents)
{
  foreach ($parents as $parent)
  {
    echo '<li>..<a href="module.test.php?id=' . $parent->getId() . '&type=' . $parent->getType() . '">' . $parent->getTitle() . '</a>';
  }
}




$childs = $module->getChild();

if ($childs)
{
  foreach ($childs as $child)
  {
    echo '<li><a href="module.test.php?id=' . $child->getId() . '&type=' . $child->getType() . '">' . $child->getTitle() . '</a> ';
		if ($child->get('locale'))
		{
		echo '(locale : ' . $child->get('locale') . ')';
		}
  }
}


echo ($module->debug());

Var_Dump::display($_REQUEST); 

//$test_module = new module(5, 'folder');
//$module->addParent($test_module);

?>