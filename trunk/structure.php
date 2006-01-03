<?php
require_once 'thinkedit.init.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/page.class.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/node.class.php';
require_once ROOT . '/class/datagrid.class.php';
require_once ROOT . '/class/html_table.class.php';



$page = new page();
$url = new url();
$node = new node();
$datagrid = new datagrid();
$html_table = new html_table();


// header
require_once 'header.php';


// check url. If node_id found load it
if ($url->get('node_id'))
{
  $node->load($url->get('node_id'));
}
else // else load root
{
  if (!$node->loadRootNode())
	{
			trigger_error('structure : cannot load root node. DB Empty ?');
	}
}



// handle actions


// if we have an item to add to curent node because we browsed for it :
if ($url->get('action') == 'browse')
{
		$object = $url->getObject();
		$node->add($object);
		$url->unsetParam('action');
		$url->unsetParam('class');
		$url->unsetParam('type');
		$url->unsetParam('id');
}



// if we have an item to add to curent node because we just created it :
if ($url->get('action') == 'add_to_structure')
{
		$url->unsetParam('action');
		$url->unsetParam('class');
		$url->unsetParam('type');
		$url->unsetParam('id');
}




$breadcrumb = new breadcrumb();

$breadcrumb->add('root');

if ($node->hasParent())
{
  $parents_node = $node->getParentUntilRoot();
  $parents_node = array_reverse($parents_node);
  foreach ($parents_node as $parent)
  {
	$content = $parent->getContent();
	$content->load();
	
	$url = new url();
	$url->set('node_id', $parent->getId());
	$breadcrumb->add($content->getTitle(), $url->render());
  }
}
// add curent
$current = $node->getContent();
$current->load();
$breadcrumb->add($current->getTitle());

$page->startPanel('node_breadcrumb');
$page->add($breadcrumb->render());
$page->endPanel('node_breadcrumb');

if ($node->hasParent())
{
  $parent = $node->getParent();
  $url->set('node_id', $parent->getId());
  $uplink = '<a href="' . $url->render() . '">' . translate('go_up') .  '</a>';
  $page->startPanel('go_up');
  $page->add($uplink);
  $page->endPanel('go_up');
}

if ($node->hasChildren())
{
  $children = $node->getChildren();
  foreach ($children as $child_node)
  {
	$content = $child_node->getContent();
	$content->load();
	$url->set('node_id', $child_node->getId());
	$url->set('return_to', 'structure.php');
	$url->set('return_to_node', $node->getId());
	//$row['icon'] = '<img src="' . ROOT_URL . $content->getIcon() . '"/>';
	$row['title'] = '<a href="' . $url->render() . '">' .$content->getTitle() . '</a>';
	$row['edit_node'] = '<a href="' . $url->linkTo($child_node, 'edit.php') . '">' . translate('edit_node') . '</a>';
	$row['edit'] = '<a href="' . $url->linkTo($content, 'edit.php') . '">' . translate('edit') . '</a>';
	$row['delete'] = '<a href="' . $url->linkTo($child_node, 'delete.php') . '">' . translate('delete') . '</a>';
	$html_table->add($row);
	
  }
}



$page->startPanel('list');
//$page->add('<h1></h1>');
$page->add($html_table->render());
$page->endPanel('list');



$add_existing = '<select OnChange="location.href=this.options[this.selectedIndex].value">';
$add_existing .= '<option>' . translate('add_new') . '</option>';

$config = $thinkedit->newConfig();
$tables = $config->getTableList();
foreach ($tables as $table_id)
{
  $url = new url();
  $table = $thinkedit->newTable($table_id);
  $url->set('class', 'record');
  $url->set('type', $table_id);
	$url->set('action', 'add_to_structure');
	$url->set('node_id', $node->getId());
  $add_existing .= '<option value="'. $url->render('edit.php') .'">' . $table->getTitle() . '</option>';
}  
$add_existing .= '</select>';



$add_new = '<select OnChange="location.href=this.options[this.selectedIndex].value">';
$add_new .= '<option>' . translate('add_existing') . '</option>';

$config = $thinkedit->newConfig();
$tables = $config->getTableList();
foreach ($tables as $table_id)
{
  $url = new url();
  $table = $thinkedit->newTable($table_id);
  $url->set('class', 'record');
  $url->set('type', $table_id);
	$url->set('action', 'browse');
	$url->set('node_id', $node->getId());
	
  $add_new .= '<option value="'. $url->render('list.php') .'">' . $table->getTitle() . '</option>';
}  
$add_new .= '</select>';




$page->startPanel('add');
//$page->add('<h1></h1>');
$page->add($add_existing);
$page->add($add_new);
$page->endPanel('add');



echo $page->render(); 

?>
