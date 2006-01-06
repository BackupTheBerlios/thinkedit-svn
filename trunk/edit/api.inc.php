<?php


// returns the primary locale for the site
function get_main_locale()
{
	global $config;
	foreach ($config['config']['site']['locale'] as $key=>$locale)
	{
		if ($locale['main'] == 'true') return $key;
	}
	
}



// returns the preferred locale for the site
function get_preferred_locale()
{
	
	global $config, $_SESSION;
	if ($_SESSION['preferred_locale']) return $_SESSION['preferred_locale'];
	
	foreach ($config['config']['site']['locale'] as $key=>$locale)
	{
		if ($locale['main'] == 'true') return $key;
	}
	
	return "fr";
	
}




// return a list of locales used by a site
function get_all_locales()
{
	global $config;
	foreach ($config['config']['site']['locale'] as $key=>$locale)
	{
		
		$result[] = $key;
	}
	
	return $result;
	
}





// return the number of locales used by a site
function get_num_locales()
{
	
	return count (get_all_locales());
	
}



function is_multilingual ($module)
{
	global $config;
	if ($config['config']['module'][$module]['locale']['type'] == 'multilingual')
	{
		return true;
	}
	else
	{
		return false;
	}
}




//return the $module batch size or false if batch disabled
function get_module_batch_size ($module)
{
	global $config;
	if (isset($config['config']['module'][$module]['batch']['size']))
	{
		return $config['config']['module'][$module]['batch']['size'];
	}
	else
	{
		return false;
	}
}



// Generates an url based on the current location
// First argument is the script name. Current arguments are kept (in the request ?)
// and other argument are added following the function arguments.
// Priority is given to the arguments passed to the function. (overwriting)

function make_url($file_name)
{
	print_a(func_get_args());
	echo $file_name;
}



//given a module name, sends the title row
function get_module_title_row($module)
{
	global $config;
	
	if (isset($config['config']['module'][$module]['title_row']))
	{
		return $config['config']['module'][$module]['title_row'];
	}
	else
	{
		die('title_row not set in config file');
		//return 'title'; // bad hack
	}
}


//given a module name, sends the local field if the module is multilingual, else false
function get_module_locale_field($module)
{
	global $config;
	
	if ($config['config']['module'][$module]['locale']['type'] == 'multilingual')
	{
		return 'locale'; //locale field name could be configurable
	}
	else
	{
		return false;
	}
}


// returns the path to the right thumbnail file for the given file_id in the given filemanager_id
function thumbnail_path($filemanager_id, $file_id)
{
	global $config;
	$table = $config['config']['module'][$filemanager_id]['table'];
	
	// generates the real filename and path from the db
	global $db;
	$sql_file = $db->get_row("select * from $table where id=$file_id");
	
	//$db->debug();
	
	
	$file = $sql_file->filename;
	$path = $sql_file->path;
	
	$url = $config['config']['module'][$filemanager_id]['public_path'] . '/' . $path . '/' . $file; 
	
	return 'resize/phpthumb.php?src=' . $url . '&w=' . $config['config']['site']['thumbnails']['width'] . '&h=' . $config['config']['site']['thumbnails']['height'];
	
	return "thumbnail.php?filemanager_id=$filemanager_id&file_id=$file_id";
	
	/*$cache_file = './cache/' . $filemanager_id . '.' . $file_id . '.interface.jpg';
	$thumbnail_path = dirname($_SERVER['PATH_TRANSLATED']) . "/cache/" . $filemanager_id . '.' . $file_id .  '.interface.jpg' ;
	
	
	if (file_exists($thumbnail_path))
	{
		return $cache_file;
	}
	else
	{
		return "thumbnail.php?filemanager_id=$filemanager_id&file_id=$file_id";
	}
	*/
	
}



// used by the html editor :
//php example
function RTESafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = trim($strText);
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
	//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}




?>
