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
				
				foreach ($items as $item)
				{
						if ($item->isEnd())
						{
								$out .= $item->getTitle();
						}
						else
						{
								$out .= '<a href="' . $item->getUrl() . '">' . $item->getTitle() . '</a> &gt; ';
						}
						
						
				}
				return $out;
		}
		
		/*
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
		*/
		
		
		function getArray()
		{
				require_once 'menuitem.class.php';
				// add current
				$menuitem = new menuitem($this->node);
				$menuitem->is_end = true; // this is in fact the last item of this breadcrumb
				$items[] = $menuitem;
				
				// add parents
				if ($this->node->getParentUntilRoot())
				{
						foreach ($this->node->getParentUntilRoot() as $parent)
						{
								$items[] = new menuitem($parent);
						}
				}
				$items = array_reverse($items);
				
				return $items;
		}
}

?>
