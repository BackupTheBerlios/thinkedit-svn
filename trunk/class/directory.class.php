<?php

class fs_directory
{
	
	function fs_directory()
	{
		$this->dir = dir('./');
		while (false !== ($entry = $this->dir->read())) {
			$this->list[] .= $entry;
		}
		$this->dir->close();
	}
	
	function hasChildren()
	{
		if (is_array($this->list))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	function getChildren()
	{
		for ($i=0; $i<10 ; $i++)
		{
			$list[$i] = new fakemodule();
		}
		
		return $list;
	}
	
	
	function hasParent()
	{
		return true;
	}
	
	
	function getParent()
	{
		return new fakemodule();
	}
	
	function getTitle()
	{
		return 'This is my title ' . rand(1, 500);
	}
	
	
	function getLastModified()
	{
		return time();
	}
	
	
	function getIcon()
	{
		return 'default.png';
	}
	
	
	function getId()
	{
		return 1;
	}
	
}


?>