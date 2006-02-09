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
				if ($this->node->getChildren())
				{
						foreach ($this->node->getChildren() as $child)
						{
								$content = $child->getContent();
								$content->load();
								$url = new url();
								$url->set('node_id', $child->getId());
								$out .= '<a href="' . $url->render() . '">' . $content->getTitle() . '</a> ';
						}
						return $out;
				}
				else
				{
						return false;
				}
				
		}
		
		
}

?>
