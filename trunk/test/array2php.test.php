<?php
require_once ('../thinkedit.init.php');



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
