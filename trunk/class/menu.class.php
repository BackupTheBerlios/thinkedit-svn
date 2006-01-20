<?php

class menu
{
		
		var 
		
		function setCurrentNode($node_id)
		{
				$this->node_id = $node_id;
		}
		
		
		function getFirstLevelMenu()
		{
		}
		
		/*
		function getFullMenu()
		{
				global $thinkedit;
				
				$node = $thinkedit->newNode();
				$node->loadRootNode();
				
				$out = '';
				
				$out .= '<ul>';
				
				$content = $node->getContent();
				$out .= '<li>';
				$out .= $content->getTitle();
				$out .= '</li>';
				
				$tmp = $node;
				
				while ($tmp->hasChildren())
				{
						$out .= '<ul>';
						$content = $tmp->getContent();
						$out .= '<li>';
						$out .= $content->getTitle();
						$out .= '</li>';
				}
		}
		*/
		
		function displayChildren($node_id, $level = false, $out = false) 
		{
				if (!$level)
				{
						$level = 0;
				}
				global $thinkedit;
				$node = $thinkedit->newNode();
				$node->load($node_id);
				debug($node);
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
								
								if (isset($this->node_id) && $this->node_id == $child->getId())
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
								if ($level > 20)
								{
										trigger_error('menu::displayChildren() level higher than 20, infinite loop ?');
								}
								else
								{
										$out = $this->displayChildren($child->getId(), $level+1, $out);
								}
						}
						$out .= '</div>'; 
						
						//return $out;
				}
				else
				{
						
				}
				
				return $out;
		}
		
		
		function render($start = 0)
		{
				return $this->displayChildren($start);
		}
		
}

?>
