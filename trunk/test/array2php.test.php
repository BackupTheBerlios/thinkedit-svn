<?php
require_once ('../thinkedit.init.php');
require_once ROOT . '/class/array2php.class.php';


$parser = new array2php();

echo '<pre>';

echo $parser->toPhp($thinkedit->config, '$config');


$config_php = $parser->toPhp($thinkedit->config, '$config');

echo '<hr>';



die();

$config = $thinkedit->config;


function toPhp($data, $path = false)
{

		if (is_array($data))
		{
				foreach ($data as $key=>$value)
				{
						
						if (is_array($value))
						{
								$path[] = $key;
								//echo $key . ' : <br/>';
								toPhp($value, $path);
						}
						else
						{
								
								echo '$config'; 
								foreach ($path as $item)
								{
										echo "['" . $item . "']";
								}
								
						echo ' = ' . $value . '<br>';
						
						}
						
				}
				$path = array_pop ($path);
		}
		else
		{
				//echo $data;
		}
}


toPhp($config);

?>
