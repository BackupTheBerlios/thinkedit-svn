<?php


class menuitem
{
		
		function menuitem($node)
		{
				$this->node = $node;
				$this->content = $node->getContent();
				
		}
		
		
		function getUrl()
		{
				require_once 'url.class.php';
				$url = new url();
				$url->set('node_id', $this->node->getId());
				return $url->render();
		}
		
		function getTitle()
		{
				$this->content->load();
				return $this->content->getTitle(); // . ' | ' . $this->node->getLevel();
		}
		
		
		function isEnd()
		{
				if (isset($this->is_end))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		function isStart()
		{
				if (isset($this->is_start))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		function isCurrent()
		{
				if (isset($this->is_current))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		
		function getLevel()
		{
				return $this->node->getLevel();
		}
		
		
		/*
		function isStart()
		{
		}
		
		function isStop()
		{
		}
		
		function isCurent()
		{
		}
		
		function getLevel()
		{
		}
		*/
}

?>
