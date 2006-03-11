<?php
require_once ('../thinkedit.init.php');
require_once ROOT . '/class/php_parser.class.php';


$parser = new php_parser();

echo '<pre>';

//echo $parser->save('config.php', $thinkedit->config);


//echo $parser->toPhpHumanFriendly($thinkedit->config);

$parser->save('config.php', $thinkedit->config);





die();

echo '<hr>';


$test = $parser->load('config.php');


print_r ($test);


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
