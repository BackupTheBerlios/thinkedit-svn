<?php


require_once 'spyc.php';

class yml_parser
{
		
		function init()
		{
				
				
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
		
		
		function load($filename)
		{
				global $thinkedit;
				$cache = $thinkedit->getCacheFile($filename);
				if ($result = $cache->get($filename))
				{
						return $result;
				}
				else
				{
						$yml = file_get_contents($filename);
						$data = $this->toArray($yml);
						$cache->save($data, $filename);
						return $data;
				}
		}
		
		function save($filename, $data)
		{
				$yml = $this->toYml($data);
				$handler = fopen($filename, 'w+');
				fwrite($handler, $yml);
				fclose($handler);
		}
		
}


?>
