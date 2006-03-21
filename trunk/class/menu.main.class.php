<?php

require_once 'menu.base.class.php';

class menu_main extends menu_base
{
		
		function menu_main($node = false)
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
				if ($this->getArray())
				{
						foreach ($this->getArray() as $item)
						{
								//$content = $child'node']->getContent();
								//$content->load();
								//$url = new url();
								//$url->set('node_id', $child['node']->getId());
								$out .= '<a href="' . $item->getUrl() . '">' . $item->getTitle() . '</a> ';
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
				$out = '';
				if ($this->node->getChildren(true))
				{
						require_once 'menuitem.class.php';
						foreach ($this->node->getChildren(true) as $child)
						{
								if ($child->useInNavigation())
								{
										$menuitem = new menuitem($child);
										$result[] = $menuitem;
								}
						}
						return $result;
				}
				else
				{
						return false;
				}
				
		}
		
		
}

?>
