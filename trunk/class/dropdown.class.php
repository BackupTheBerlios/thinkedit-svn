<?php

class dropdown
{
	
	var $items; // contains the items of the dropdown
	
	function add($id, $label, $action = false)
	{
		$this->items[$id]['label'] = $label;
		$this->items[$id]['action'] = $action;
		//$this->items[$id]['selected'] = $selected;
	}
	
	function setTitle($title)
	{
		$this->title = $title;
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
			return false;
		}
	}
	
	

	
	function getSettings()
	{
		
		//echo 'get settings called';
		if ($this->getSelected())
		{
			$settings['selected'] = $this->getSelected();
			return $settings;
		}
		return false;
	}
	
	function setSettings($settings)
	{
		if (isset($settings['selected']))
		$this->selected = $settings['selected'];
	}
	
	
	function getSelected()
	{
		if ( isset($this->selected) )
		{
			return $this->selected;
		}
		
		require_once 'url.class.php';
		$url = new url();
		if ( $url->getParam($this->getId()) )
		{
			//$session->set($this->getId(), $url->getParam($this->getId()) );
			$this->selected = $url->getParam($this->getId());
			return $this->selected;
		}
		else
		{
			return false;
		}
	}
	
	function setSelected($selected)
	{
		$this->selected = $selected;
	}
	
		
	
	
	function render()
	{
		$out = '';
		//$out.= '<form method="post" action="' . $this->action .'">';
		$out.= '<select OnChange="location.href=this.options[this.selectedIndex].value">';
		
		$url = new url();
		
		
		if (isset($this->title))
		{
			$out.= '<option value="">' . $this->title . '</option>';
		}
		else
		{
			$out.= '<option value="">Select ...</option>';
		}
		
		if (is_array($this->items))
		{
			foreach ($this->items as $id=>$item)
			{
				if ($item['action'])
				{
					$action = $item['action'];
				}
				else
				{
					$url->setParam($this->getId(), $id);
					$action = $url->render();
				}
				
				$out.= '<option value="'. $action . '"';
				if ( $this->getSelected() == $id )
				{
					$out .= ' selected="selected" ';
				}
				$out .='>'. $item['label'] .'</option>';
			}
		}
		
		$out.= '</select>';
		//$out.= '</form>';
		
		return $out;
	}
	
	
}

?>