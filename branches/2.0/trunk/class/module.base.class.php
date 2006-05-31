<?php


class module_base
{
	
	var $id;
	var $type;
	var $title;
	var $element; // an array of the elements objects
	
	function getTitle()
	{
		if (isset ($this->title))
		{
			return $this->title;
		}
		else
		{
			return '';
		}
	}
	
	function setTitle($title)
	{
		if (isset($title))
		{
			$this->title = $title;
		}
		else
		{
			$this->title = 'Untitled';
		}
		return true;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setId($id)
	{
		$this->id = $id;
	}
	

	
	/**
	* Sets the type of this module after instanciation
	*
	*/
	function setType($type)
	{
		die('module.sql::setType() dont do this, once a module has been instantied, define the type in the constructor');
	}
	
	/**
	* Returns the type of this module
	*
	*/
	function getType()
	{
		
		if (isset($this->type))
		{
			return $this->type;
		}
		else
		{
			return false;
		}
	}
	
	
	
	
	/**
	* Returns the icon for this module
	*
	*/
	function getIcon()
	{
		// need some more validation in non production mode ?
		if (isset($this->icon)) return $this->icon;
		return $this->getType() . '.png';
		/*
		if ($this->type == 'folder')
		{
			return 'folder.png';
		}
		else
		{
			return 'unknown.png';
		}
		*/
	}
	
	
	/**
	* Dynamically sets the icon for this module
	*
	*/
	function setIcon($icon)
	{
		$this->icon = $icon;
	}
	
	
	
	/**
	* outputs some info about this module
	*
	*/
	function debug()
	{
		$out = '<pre>';
		$out .= '<ul>';
		$out .= "<h1>Debug for '" . $this->getTitle() . "' (type : {$this->type}) (id: {$this->id}) </h1>";
		$out .= "<li>Type : " .$this->type;
		$out .= "<li>My id is {$this->id}";
		$out .= "<li>My title is " . $this->getTitle();
		
		
		if (isset($this->element))
		{
			$out .= '<li>Sub-elements :</li>';
			$out .= '<ul>';
			foreach ($this->element as $element)
			{
				$out .= '<li>';
				$out .= $element->getName();
				$out .= ' : "';
				$out .= $element->get();
				$out .= '"</li>';
			}
			$out .= '</ul>';
		}
		$out .= '</ul>';
		$out .= '</pre>';
		
		return $out;
	}
	
	
	
	/**
	* returns the content of $element if found, false otherwise
	*
	*/
	function getElement($element)
	{
		if ($this->load())
		{
			if (isset($this->element[$element]))
			{
				return $this->element[$element]->get();
			}
			else
			{
				trigger_error("module::get() element $element not found");
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	* sets a module's $element to $data
	*
	*/
	function setElement($element, $data)
	{
		if (isset($this->element[$element]))
		{
			return $this->element[$element]->set($data);
		}
		else
		{
			return false;
		}
	}
	
	
	/**
	* Returns true if we can display an edit form for this module, and thus an edit button for instance in the browser
	*
	*/
	function isEditable()
	{
		return true;
	}
	
	
	/**
	* Returns true if we can delete this module, and thus an delete button for instance in the browser
	*
	*/
	function isDeletable()
	{
		return true;
	}
	
	
	
	function getArray()
	{
		foreach ($this->element as $element)
		{
			$data[$element->getId()] = $element->get();
		}
		$data['type'] = $this->getType();
		
		return $data;
	}
	
	
}



?>