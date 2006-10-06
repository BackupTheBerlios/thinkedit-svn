<style>
div
{
		margin: 3px;
		margin-left: 10px;
		
		border: 1px solid red;
		
}

div > div > div > div
{
			border: 5px solid blue;
}

.current
{
		background-color: gray; 
}

</style>

<?php

require_once '../thinkedit.init.php';





function context_menu($current_node, $node = false, $out=false)
{
		// get parents
		$parents_nodes = $current_node->getParentUntilRoot();
		// create an array of parents id's
		if (is_array($parents_nodes))
		{
				foreach ($parents_nodes as $parent_node)
				{
						$parents[] = $parent_node->getId();
				}
		}
		// if we are on first level, show it with parents
		if (!$node)
		{
				global $thinkedit;
				$node = $thinkedit->newNode();
				$node->loadRootNode();
		}
		
		if ($node->hasChildren())
				{
						$out .= '<div>'; 
						$children = $node->getChildren();
						// display each child
						foreach  ($children as $child)
						{
								$content = $child->getContent();
								$content->load();
								// indent and display the title of this child
								//$out .= str_repeat('  ',$level) . '(' . $child->getId(). ')' . $content->getTitle() ."\n";
								
								if (isset($current_node->node_id) && $current_node->node_id == $child->getId())
								{
										$class = ' class="current"';
								}
								else
								{
										$class = '';
								}
								$out .= '<div' . $class . '>' . '(' . $child->getId(). ')' . $content->getTitle() . '</div>';
								debug($out, 'out');
								// call this function again to display this
								// child's children
								// limit levels
								$out = context_menu($current_node, $child, $out);
								
						}
						$out .= '</div>'; 
						
						//return $out;
				}
				else
				{
						
				}
				
				return $out;
		
}

$node = $thinkedit->newNode();
$node->setId(50);
echo context_menu($node);

?>
