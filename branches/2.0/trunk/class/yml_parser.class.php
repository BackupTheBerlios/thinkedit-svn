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
				$cache = $this->loadCache($filename);
				if ($cache)
				{
						return $cache;
				}
				else
				{
						$yml = file_get_contents($filename);
						$data = $this->toArray($yml);
						
						if ($data)
						{
								$this->saveCache($filename, $data);
						}
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
		
		
		function loadCache($filename)
		{
				$cache_filename = $filename . '.cache';
				//echo 'loading cache ' . $cache_filename;
				if (file_exists($cache_filename))
				{
						$data = file_get_contents($cache_filename);
						return unserialize($data);
				}
				else
				{
						return false;
				}
				
				
		}
		
		function saveCache($filename, $data)
		{
				
				$cache_filename = $filename . '.cache';
				
				//echo 'saving cache ' . $cache_filename;
				
				$handler = fopen($cache_filename, 'w+');
				$cache_data = serialize($data);
				fwrite($handler, $cache_data);
				fclose($handler);
		}
		
		
		function getCache($master_file, $cache_dir)
		{
				if (is_dir($cache_dir))
				{
						// I hate pear global include system, so I have this "solution" :-/
						require_once ROOT . '/lib/pear/cache/Lite/File.php';
						$options = array(
						'cacheDir' => $cache_dir,
						'lifeTime' => 86400,
						'pearErrorMode' => CACHE_LITE_ERROR_DIE,
						'automaticSerialization' => true,
						'masterFile' => $master_file
						);
						return new Cache_Lite_File($options);
				}
				else
				{
						return false;
				}
		}
		
}


?>
