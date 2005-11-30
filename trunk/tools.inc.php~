<?php

function error_handler($errno, $errstr , $errfile , $errline , $errcontext)
{
	switch ($errno)
	{
		case E_USER_ERROR:
		$error_message = "<b>FATAL</b> [$errno] $errstr<br />\n";
		$error_message .= "  Fatal error in line $errline of file $errfile";
		$error_message .= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
		$error_message .= "Aborting...<br />\n";
		$out['title'] = 'An error occured';
		include('header.template.php');
		include('error.template.php');
		include('footer.template.php');
		die();
		break;
		
		case E_USER_WARNING:
		echo "<b>ERROR</b> [$errno] $errstr in line $errline of file $errfile<br />\n";
		break;
		case E_USER_NOTICE:
		echo "<b>WARNING</b> [$errno] $errstr in line $errline of file $errfile<br />\n";
		break;
		default:
		echo "Unkown error type: [$errno] $errstr in line $errline of file $errfile<br />\n";
		break;
	}
	
}





// some security issues as well if debug is enabled, to say the least...
function debug($data, $title=false)
{
	
	//global $debug;
	if (isset($_GET['debug']))
		
	{
		$out='';
		if ($title) $out.="<h1>$title</h1>";
		$out.= '<pre>';
		ob_start();
		print_r($data);
		$out.= ob_get_contents();
		ob_end_clean();
		
		
		$out.='</pre>';
		echo $out;
	}
	
}


function translate($id, $html = true)
{
	// todo : load everything in a single array to have only a single sql query per request
	// todo : then cache
	// todo : then check if it's faster
	
	global $thinkedit, $user;
	
	// todo, use config
	$translation = $thinkedit->newRecord('translation');
	
	$translation->set('id', $id);
	$translation->set('locale', $user->getLocale());
	
	if ($translation->load())
	{
		if (!($translation->get('translation')))
		{
			return "#" . $id . "#";
		}
		else
		{
			return $translation->get('translation');
		}
	}
	else
	{
	// todo : insert translation
		return $id;
	}
	
	/*
	if (count($translation) > 0)
	{
		if (!isset($translation[0]['translation']))
		{
			return "#" . $id . "#";
		}
		else
		{
			if ($html)
			{
				return htmlentities($translation[0]['translation']);
			}
			else
			{
				return $translation[0]['translation'];
			}
			
		}
	}
	else
	{
		$locale_db->query("insert into $table (id, translation, locale) values ('$id', NULL, '$interface_locale')");
		return $id;
	}
	*/
}




?>