<?php
/*
Thinkedit plugin example

Scenario
Thinkedit plugin manager would scan the /plugin folder, and include and instantiante all classes found

Then it would create an array of all the methods found in those classes


*/


class test
{
		// maybe even not needed :
		function init()
		{
				global $thinkedit;
				$thinkedit->plugin->register($this);
		}
		
		
		// how to define an api for this ?
		function onAddRecord($record)
		{
				// code that sends an email when a record is added
		}
		
		
}
?>
