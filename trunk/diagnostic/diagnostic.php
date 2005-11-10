<?php
/*
Thinkedit Diagnostic System

How it works :
-------------

For each test you want to perform :

- create a file xxx.yourtestname.php in this folder
- inside this file, put class code class yourtestname, with methods found in example.test.php
- xxx must be an int, the tests will be run in this order

so, you have a test called "amihappy" (Am I happy)

you create 500.amihapy.php (will be run after 499.xyz.php and before 501.xyz.php)

inside this file :

class amihapy
{
	function fix()
	etc...
}


Please note :
-----------

- Your test will be run by end users (administrators), make it easy to understand what it does
- Your test may be run several times (each time something goes wrong), as such it should not be destructive
- If your fix() is hasardous, warn the user loudly
- Give friendly error messages / titles / help
-


*/


require_once '../thinkedit.init.php';



// todo : secure access to this file

echo '<pre>';

// Find all files beginning with digits


if ($handle = opendir('.'))
{
    while (false !== ($file = readdir($handle)))
    {
		if ($file != "." && $file != ".." && is_file($file))
		{
			if (is_numeric(substr($file, 0, 3)))
			{
				$tests[] = $file;
			}
		}
    }
    closedir($handle);
}

// Order by digits
sort($tests);


if (is_array($tests))
{
    foreach ($tests as $test)
    {
		// Extract class names
		
		$data = explode('.', $test);
		// print_r ($data);
		
		$test_nr = $data[0];
		$class_name = $data[1];
		
		require_once ($test_nr . '.' . $class_name . '.php');
		
		// - instantiate
		$class = new $class_name;
		
		// - get title and help
		echo '<h1>' . $class->getTitle() . '</h1>';
		echo '<p>' . $class->getHelp() . '</p>';
		
		// - try
		if ($class->try())
		{
			echo '[OK]';
		}
		else
		{
			echo '[ERROR]';
			
			if ($class->canFix())
			{
				if (isset($_REQUEST['fix']) && $_REQUEST['fix'] == $class_name)
				{
					if ($class->fix())
					{
						echo '[FIXED]';
					}
					else
					{
						echo '[UNABLE TO FIX]';
					}
				}
				// - link to a fix if canFix()
				else
				{
					require_once ROOT . '/class/url.class.php';
					$url = new url();
					$url->setParam('fix', $class_name);
					if ($class->getContext())
					{
						
						// bof
						foreach ($class->getContext() as $key=>$val)
						{
							$url->setParam($key, $val);
						}
					}
					$url->setParam('fix', $class_name);
					$msg = ' I can fix this error, <a href="'. $url->render() .'">click here to fix</a>';
					
					echo $msg;
				}
			}
			else
			{
				echo ' This error cannot be fixed, please fix manually';
			}
			
		}
		
		
		
		
		
		
    }
}
else
{
    trigger_error('No tests found');
}

die();








?>
