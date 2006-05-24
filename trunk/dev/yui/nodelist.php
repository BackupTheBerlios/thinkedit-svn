<?php
include '../../thinkedit.init.php';


if(isset($_GET['parentId']))
{

		$node = $thinkedit->newNode();
		$node->setId($_GET['parentId']);
		$children = $node->getChildren();
		
		if ($children)
		{
				foreach ($children as $child)
				{
						echo '<li><a href="#">' . $child->getTitle() . '</a>';
						echo '<input type="checkbox"> ';
						if ($child->hasChildren())
						{
								echo '<ul>';
								echo '<li parentId="'. $child->getId() .'"><a href="#">Loading</li>';
								echo '</ul>';
						}
						echo '</li>';
				}
		}
		
}
	

?>
