<?php
require_once('../thinkedit.init.php');

$url = $thinkedit->newUrl();

if ($url->get('node_id'))
{
	
	$node = $thinkedit->newNode();
	
	$node->load($url->get('node_id'));
	
	if ($node->hasChildren())
	{
		echo '<ul>';
		foreach ($node->getChildren() as $child)
		{
			//echo '<li>' . $child->getTitle() . '</li>';
			//echo '<li class="node" id="node_'. $child->getId()  .'" onclisck="load_node(' . $child->getId() . ')">' . $child->getTitle() .  '<div class="child"></div></li>';
			echo '<li class="node" id="node_'. $child->getId()  .'">' . $child->getTitle() .  '<div class="child"></div></li>';
		}
		echo '</ul>';
		
		
	}
}
?>
