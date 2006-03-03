<?php


class yml_parser
{
		
		function init()
		{
				require_once 'spyc.php';
				
		}
		
		function toArray($yml)
		{
				$this->init();
				return Spyc::YAMLLoad($yml);
		}
		
		
		function toYml($array)
		{
				$this->init();
				return Spyc::YAMLDump($array, 4, 100);
		}
		
		
}


?>
