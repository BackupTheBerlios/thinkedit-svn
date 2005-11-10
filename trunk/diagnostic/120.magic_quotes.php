<?php


class magic_quotes
{
	
	
    function try()
    {
		if (get_magic_quotes_gpc())
		{
			return false;
		}
		else
		{
			return true;
		}
    }
	
	
    function getHelp()
    {
		return 'Test wether magic quotes are enabled or not';
    }
	
    function getTitle()
    {
		return 'Magic Quotes';
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