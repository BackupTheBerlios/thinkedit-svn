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
				
				global $thinkedit;
				$this->root = $thinkedit->newNode();
				$this->root->loadRootNode();
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
		
		/*
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
		*/
		
		function render()
		{
				// handle special case : if the current node is the "root" of the current section, 
				// display siblings
				
				if ($this->node->getLevel() == 1)
				{
						$nodes = $this->node->getChildren();
				}
				else
				{
						// get all parents, including current node
						$this->parents[] = $this->node->getId();			
						if ($this->node->getLevel() == 2)
						{
								$level_node = $this->node;
						}
						
						
						$parents = $this->node->getParentUntilRoot();
						if (is_array($parents))
						{
								foreach ($parents as $parent)
								{
										$this->parents[] = $parent->getId();
										if ($parent->getLevel() == 2)
										{
												$level_node = $parent;
										}
								}
						}
						$nodes = $this->root->getAllNodes();
				}
				foreach ($nodes as $entry)
				{
						// two things to check :
						// 1. is the node a parent of the current node
						// or
						// 2. is the parent of the node the same as the $level_node
						
						$show = false;
						if (isset($this->parents) && in_array($entry->getId(), $this->parents))
						{
								$show = true;
						}
						if (isset($level_node) && $entry->isSiblingOf($level_node))
						{
								$show = true;
						}
						
						// also include childs of this node
						if ($entry->isChildOf($this->node))
						{
								$show = true;
						}
						
						if ($entry->getLevel() < 2)
						{
								$show = false;
						}
						
						if ($show)
						{
								$nodes_list[] = $entry;
						}
				}
				
				
				// now render this stuff
				if (isset($nodes_list) && is_array($nodes_list))
				{
						$out = '<ul>';
						foreach ($nodes_list as $entry)
						{
								$content = $entry->getContent();
								$content->load();
								$out .= '<li>';
								for ($i=0; $i < $entry->getLevel(); $i++)
								{
										$out.= '--';
								}
								
								if ($entry->getId() == $this->node->getId())
								{
										$out .=  $content->getTitle();
								}
								else
								{
										$url = new url();
										$url->set('node_id', $entry->getId());
										$out .= '<a href="' . $url->render() . '">' . $content->getTitle() . '</a>';
								}
								
								
								$out .= '</li>';
						}
						$out .= '</ul>';
						return $out;
				}
				else
				{
						return false;
				}
		}
}

?>
