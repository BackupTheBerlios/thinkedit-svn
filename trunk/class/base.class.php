<?php

die('deprecated');

/*DEPRECATED*/

/*
Consider this as an interface, not a base class you should extend. Currently I'd beter cut and paste the code bellow in any class that needs it.
*/
class base
{
	
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
	
	
	
	
}

?>
