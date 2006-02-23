<?php

require_once 'menu.base.class.php';

class menu_sibling extends menu_base
{
		
		function menu_child($node = false)
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
		
		
		function render()
		{
				$out = '';
				if ($siblings = $this->node->getSibling())
				{
						foreach ($siblings as $child)
						{
								$content = $child->getContent();
								$content->load();
								$url = new url();
								$url->set('node_id', $child->getId());
								$out .= '<a href="' . $url->render() . '">' . $content->getTitle() . '</a> <br/>';
						}
						return $out;
				}
				else
				{
						return false;
				}
				
		}
		
		function getArray()
		{
				if ($siblings = $this->node->getSiblings())
				{
						foreach ($siblings as $entry)
						{
								
								$menuitem = new menuitem($entry);
								if ($entry->getId() == $this->node->getId())
								{
										$menuitem->is_current = true;
								}
								$menuitems[] = $menuitem;
						}
						
						return $menuitems;
				}
				else
				{
						return false;
				}
				
		}
		



}

?>
