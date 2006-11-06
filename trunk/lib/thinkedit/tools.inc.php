<?php
function default_error_handler($errno, $errstr, $errfile, $errline, $errcontext)
{
	if ($errno < E_ALL)
	{
		if ($errno == E_USER_NOTICE)
		{
			$type = 'notice';
		}
		elseif ($errno == E_USER_WARNING)
		{
			$type = 'warning';
		}
		elseif ($errno == E_USER_ERROR)
		{
			$type = 'error';
		}
		else
		{
			$type = $errno;
		}
		
		$error['message'] = "[$type] <b>$errstr</b> in line $errline of file $errfile";
		//$error['message']  .= "Error in line $errline of file $errfile";
		
		
		$error['string'] = $errstr;
		$error['file'] = $errfile;
		$error['line'] = $errline;
		//$error['context'] = $errcontext;
		
		global $thinkedit;
		
		$thinkedit->errors[] = $error;
	}
	return true;
}

function production_error_handler($errno, $errstr , $errfile , $errline , $errcontext)
{
	if ($errno < E_USER_WARNING)
	{
		$error['message'] = "[$errno] $errstr<br />\n";
		$error['message']  .= "Fatal error in line $errline of file $errfile";
		$error['message']  .= "Aborting...<br />\n";
		
		$error['string'] = $errstr;
		$error['file'] = $errfile;
		$error['line'] = $errline;
		//$error['context'] = $errcontext;
		
		global $thinkedit;
		
		$thinkedit->errors[] = $error;
	}
	return true;
}

//set_error_handler ('production_error_handler');
//set_error_handler ('default_error_handler');


if ($thinkedit->isInProduction())
{
	set_error_handler ('production_error_handler');
}
else
{
	set_error_handler ('default_error_handler');
}


// some security issues as well if debug is enabled, to say the least...
// todo fix debug security, allow debug only if defined in config and display a warning on every page
// idem for user less setup
function debug($data, $title=false)
{
	global $thinkedit;
	if ($thinkedit->isInProduction())
	{
		return true;
	}
	else
	{
		global $debug;
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
			$debug[] = $out;
			echo $out;
		}
	}
	
	
}


function translate($translation_id)
{
	// todo : load everything in a single array to have only a single sql query per request
	// todo : then cache
	// todo : then check if it's faster ;-)
	
	global $interface_locale;
	return $interface_locale->translate($translation_id);
	
	
	
	if (!empty ($translation_id))
	{
		
		global $thinkedit;
		
		$user = $thinkedit->getUser();
		
		// todo, use config
		$translation = $thinkedit->newRecord('translation');
		
		//$translation->set('translation', $translation_id);
		//$translation->set('locale', $user->getLocale());
		$the_translation = $translation->findFirst(array('translation_id' => $translation_id, 'locale' => $user->getLocale() ));
		if ($the_translation)
		{
			if ($the_translation->get('translation'))
			{
				return $the_translation->get('translation');
			}
			else
			{
				return '!' . $translation_id . '!';
			}
		}
		else
		{
			// todo : insert translation
			//$translation->set('translation', $id);
			$translation->set('translation_id', $translation_id);
			$translation->set('locale', $user->getLocale());
			$translation->insert();	
			return "[translation_added] #" . $translation_id . "#";
		}
		
		
	}
	else
	{
		return false;
	}
}




function redirect($page)
{
	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/".$page);
}

function get_file_extension($filename)
{
	return strtolower(end(explode('.', $filename)));
}


function get_file_filename($filename)
{
	$tmp = explode('.', $filename);
	return strtolower($tmp[0]);
}


function check_user ()
{
	global $thinkedit;
	$user = $thinkedit->getUser();
	if ($user->isLogged())
	{
		return true;
	}
	else
	{
		require_once ROOT . '/class/url.class.php';
		$url = new url();
		$url->redirect('login.php');
		die();
		/*
		$url = urlencode ($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); 
		redirect("login.php?original_url=$url");
		*/
	}
	
}

?>