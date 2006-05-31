<?php
require_once '../thinkedit.init.php';


$root = $thinkedit->newNode();

$root->loadRootNode();



function show($node)
{
		if ($node->hasChildren())
		{
				$children = $node->getChildren();
				// display each child
				foreach  ($children as $child)
				{
						//$content = $child->getContent();
						//$content->load();
						//echo $content->getTitle();
						echo $child->getId();
						echo '<br>';
						
							show($child);
						/*
						if ($level > 20)
						{
								trigger_error('menu::displayChildren() level higher than 20, infinite loop ?');
						}
						else
						{
							
						}
						*/
				}
		}
		
}

show($root);



?>
