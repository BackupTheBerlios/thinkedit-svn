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
				$cache = $this->getCache($filename);
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
		
		
		function getCache($master_file)
		{
				// I hate pear global include system, so I have this "solution" :-/
				require_once '../lib/pear/cache/Lite/File.php';
				$options = array(
				'cacheDir' => './tmp',
				'lifeTime' => 86400,
				'pearErrorMode' => CACHE_LITE_ERROR_DIE,
				'automaticSerialization' => true,
				'masterFile' => $master_file
				);
				return new Cache_Lite_File($options);
		}
		
}


?>
