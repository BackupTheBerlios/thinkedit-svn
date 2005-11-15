<?php

class pager
{
	function pager($id)
	{
		$this->setId($id);
	}
	
	
	function setId($id)
	{
		$this->id = $id;
	}
	
	function getId()
	{
		if (isset($this->id))
		{
			return $this->id;
		}
		else
		{
			trigger_error('pager::getId() id not set');
			return false;
		}
	}
	
	function setPageSize($size)
	{
		if ($size < 1)
		{
			$size = 1;
		}
		$this->page_size = $size;
	}
	
	function getPageSize()
	{
		if (isset($this->page_size))
		{
			return $this->page_size;
		}
		else
		{
			return 10;
		}
	}
	
	
	function getSettings()
	{
		if ($this->getCurrentPage())
		{
			$settings['current_page'] = $this->getCurrentPage();
			return $settings;
		}
		return false;
	}
	
	function setSettings($settings)
	{
		if (isset($settings['current_page']))
		$this->current_page = $settings['current_page'];
	}
	
	
	function getCurrentPage()
	{
		require_once ROOT . '/class/url.class.php';
		$url = new url();
		
		if ( !is_null($url->getParam($this->getId()) ) )
		{
			$this->current_page = $url->getParam($this->getId());
		}
		if (isset($this->current_page))
		{
			return $this->current_page;
		}
		else
		{
			return 0;
		}
	}
	
	function getCurrent()
	{
		return ($this->getCurrentPage() * $this->getPageSize());
	}
	
	
	function setTotal($total)
	{
		$this->total = $total;
	}
	
	function setWindowSize($size)
	{
		$this->window_size = $size;
	}
	
	function enablePaginationDropDown()
	{
		
		require_once 'dropdown.class.php';
		$this->pagination_dropdown = new dropdown();
		$this->pagination_dropdown->setId($this->getId() . '_pagination_dropdown'); // very stylish isnt it ? Unique id's are mandatory for proper session persistence
		
		require_once 'session.class.php';
		$session = new session();
	
		
		$this->pagination_dropdown->add('5', '5 ' . translate('per_page'));
		$this->pagination_dropdown->add('10', '10 ' . translate('per_page'));
		$this->pagination_dropdown->add('20', '20 ' . translate('per_page'));
		$this->pagination_dropdown->add('50', '50 ' . translate('per_page'));
		$this->pagination_dropdown->add('100', '100 ' . translate('per_page'));
		$this->pagination_dropdown->setTitle(translate('items_per_page'));
		
		$session->persist($this->pagination_dropdown);
		
		if ($this->pagination_dropdown->getSelected())
		{
		$this->setPageSize($this->pagination_dropdown->getSelected() );
		}
		
	}		
	
	
	function render()
	{
		$out='';
		
		if (isset($this->pagination_dropdown))
		{
			$out.=$this->pagination_dropdown->render();
		}
		
		if ($this->total > 0)
		{
			require_once ROOT . '/class/url.class.php';
			$url = new url();
			$pages = (int) ($this->total / $this->getPageSize());
			for ($i=0; $i<=$pages; $i++)
			{
				$page = $i + 1;
				$url->setParam($this->getId(), $i);
				$out.= '<a class="pager_button" href="' . $url->render() .'">' . $page . '</a>' . " | ";
			}
		}
		
		return $out;
		
		
	}
	
}
