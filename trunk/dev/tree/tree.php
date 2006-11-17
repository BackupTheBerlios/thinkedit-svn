<?php
require_once '../../thinkedit.init.php';

echo '<pre>';

$url = $thinkedit->newUrl();

if ($opened_nodes = $url->get('opened_nodes'))
{
	$opened_nodes = explode(',', $opened_nodes);
	if (!in_array(0, $opened_nodes))
	{
		$opened_nodes[] = 0;
	}
}
else
{
	$opened_nodes = array(0);
}

//print_r($opened_nodes);


$root = $thinkedit->newNode();

$root->loadRootNode();

$nodes = $root->getAllChildren($opened_nodes);

$previous_level = 0;
echo '<ul>';
foreach ($nodes as $node)
{
	
	$level = $node->getLevel();
	
	if ($level > $previous_level)
	{
		echo '<ul>';
	}
	
	if ($level < $previous_level)
	{
		echo '</ul>';
	}
	
	$new_opened_nodes = $opened_nodes;
	
	// if current node is already there, we remove it
	if (in_array($node->getId(), $new_opened_nodes))
	{
		//unset ($new_opened_nodes[$node->getId()]);
		$new_opened_nodes = array_remove($new_opened_nodes, $node->getId());
	}
	else // we add it
	{
	$new_opened_nodes[] = $node->getId();
	}
	
	$url = $thinkedit->newUrl();
	$url->set('opened_nodes', implode(',', $new_opened_nodes));
	
	echo '<li>';
	echo '<a href="' .$url->render() . '">';
	echo $node->getTitle();
	echo '</a>';
	echo '</li>';
	
	$previous_level = $level;
	
}
echo '</ul>';


function array_remove($arr,$value) 
{
   return array_values(array_diff($arr,array($value)));
}

//trigger_error('test');

?>
