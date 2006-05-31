<?php

die('deprecated');

/*DEPRECATED*/

/*
Consider this as an interface, not a base class you should extend. Currently I'd beter cut and paste the code bellow in any class that needs it.
*/
class base
{
	
	var $class;
	var $type;
	var $id;
	var $locale;
	var $version;
	
	
	/*
	Return Uid of this object. See docs for more info. This is an important part of Thinkedit
	*/
	function getUid()
	{
	}
	
	
	/* Returns a human readable title of this object*/
	function getTitle()
	{
	}
	
	/* returns a short help text for this object*/
	function getHelp()
	{
	}
	
	
	/*
	returns a full path to an icon representing this object
	*/
	function getIcon()
	{
	}
	
	
	/*
	Load if needed the object
	*/
	function load()
	{
	}
	
	
	
	
}

?>
