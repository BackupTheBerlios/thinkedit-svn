<?php

require_once 'menu.base.class.php';

class menu_context extends menu_base
{
		
		function menu_context($node = false)
		{
				if ($node)
				{
						$this->node = $node;
				}
				else
				{
						global $thinkedit;
						$this->node = $thinkedit->newNode();
						$this->node->loadRootNode();
				}
		}
		
		
	
		
		
		
		function displayChildren($node_id, $iterations = false, $out = false) 
		{
				if (!$iterations)
				{
						$iterations = 0;
				}
				global $thinkedit;
				$node = $thinkedit->newNode();
				$node->load($node_id);
				debug($node);
				
				if ($node->hasChildren())
				{
						$children = $node->getChildren();
						// display each child
						foreach  ($children as $child)
						{
								$content = $child->getContent();
								$content->load();
								
								
								// show all nodes which are parents of current node
								if (in_array($child->getId(), $this->parents) || $child->getLevel() == 2)
								{
										$this->entries[] = $child;
								}
								
								/*
								if (in_array($child->getId(), $this->parents) && $child->getLevel() == 1)
								{
										$this->entries[] = $child;
								}
								*/
								
								
								
								
								if ($iterations > 10)
								{
										trigger_error('menu::displayChildren() iterations higher than 10, infinite loop ?');
								}
								else
								{
										$out = $this->displayChildren($child->getId(), $iterations+1, $out);
								}
								
								
						}
						
				}
				else
				{
						
				}
		}
		
		
		function render($start=47)
		{
				// get all parents, including current node
				$this->parents[] = $this->node->getId();
				
				$parents = $this->node->getParentUntilRoot();
				if (is_array($parents))
				{
						foreach ($parents as $parent)
						{
								$this->parents[] = $parent->getId();
						}
				}
				
				$this->displayChildren($start);
				
				foreach ($this->entries as $entry)
				{
						$content = $entry->getContent();
						$content->load();
						echo '<li>';
						for ($i=0; $i < $entry->getLevel(); $i++)
						{
								echo '--';
						}
						echo  $content->getTitle();
						echo '</li>';
				}
				
				print_r ($this->parents);
				
				
		}
		
}

?>
