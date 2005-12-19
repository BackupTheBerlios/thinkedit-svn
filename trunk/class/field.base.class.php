<?php


class field
{
	
	var $data;
	
	function field($table, $id, $data = false)
	{
		global $thinkedit;
		
		$this->table = $table;
		$this->id = $id;
		if ($data)
		{
			$this->set($data);
		}
		
		
		if (isset($thinkedit->config['table'][$table]['field'][$id]))
		{
			$this->config = $thinkedit->config['table'][$table]['field'][$id];
		}
		else
		{
			die('field::field() Field called "' . $this->id . '" not found in config, check table id spelling in config file / in code');
		}
	}
	
	
	function getNice()
	{
		return strip_tags($this->get());
	}
	
	
	function get()
	{
		return $this->data;
	}
	
	function getRaw()
	{
		return $this->data;
	}
	
	function set($data)
	{
		$this->data = $data;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function getName()
	{
		return $this->id;
	}
		
	
	function renderUI()
	{
		$out = '';
		$out .= sprintf('<input type="text" value="%s" name="%s", size="32">', $this->getRaw(), $this->getName());
		return $out;
	}
	
	function validate()
	{
		return true;
	}
	
	function getHelp()
	{
		if (isset($this->config['help']))
		{
			return $this->config['help'];
		}
		else
		{
			return ucfirst($this->getName());
		}
		
	}
	
	
	function getTitle()
	{
		if (isset($this->config['title']))
		{
			return $this->config['title'];
		}
		else
		{
			return ucfirst($this->getName());
		}
		
	}
	
	function isSortable()
	{
		return true;
	}
	
	function isPrimary()
	{
		return false;
	}
	
	function isTitle()
	{
		if (isset($this->config['is_title']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getType()
	{
		if (isset($this->config['type']))
		{
			return $this->config['type'];
		}
		else
		{
		return false;
		}
	}
	
	
	function is_null()
	{
	  die('not needed');
	  if (is_null($this->data))
	  {
		return true;
	  }
	  else
	  {
		return false;
	  }
	}
	
	
	function is_empty()
	{
	  if (empty($this->data))
	  {
		return true;
	  }
	  else
	  {
		return false;
	  }
	}
	
}

?>
