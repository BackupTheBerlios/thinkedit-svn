<?php

require_once 'menu.base.class.php';

class menu_breadcrumb extends menu_base
{
		
		function menu_breadcrumb($node = false)
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
				$items = $this->getArray();
				for ($i=0; $i < count($items); $i++)
				{
						$item = $items[$i];
						
						if ($i == count($items)-1)
						{
								$out .= $item['title'];
						}
						else
						{
								$out .= '<a href="' . $item['url'] . '">' . $item['title'] . '</a> > ';
						}
				}
				return $out;
		}
		
		function getArray()
		{
				// add current
				$content = $this->node->getContent();
				$content->load();
				$url = new url();
				$url->set('node_id', $this->node->getId());
				$item['title'] = $content->getTitle();
				$item['content'] = $content;
				$item['url'] =  $url->render();
				
				$items[] = $item;
				
				// add parents
				if ($this->node->getParentUntilRoot())
				{
						foreach ($this->node->getParentUntilRoot() as $parent)
						{
								$content = $parent->getContent();
								$content->load();
								$url = new url();
								$url->set('node_id', $parent->getId());
								$item['title'] = $content->getTitle();
								$item['content'] = $content;
								$item['url'] =  $url->render();
								$items[] = $item;
						}
						
				}
				$items = array_reverse($items);
				
				return $items;
		}
		
		
}

?>
