<?php


class php_version
{
	
	
	function try()
	{
		return true;
	}
	
	
	function getHelp()
	{
		return 'Test if we have a recent PHP version';
	}
	
	function getTitle()
	{
		return 'PHP version';
	}
	
	function canFix()
	{
		return false;
	}
	
	
	function fix()
	{
		return false;
	}
	
	
}

?>