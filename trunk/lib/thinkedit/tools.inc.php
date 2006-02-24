<?php

function production_error_handler($errno, $errstr , $errfile , $errline , $errcontext)
{
		$error_message = "[$errno] $errstr<br />\n";
		$error_message .= "Fatal error in line $errline of file $errfile";
		$error_message .= "Aborting...<br />\n";
		switch ($errno)
		{
				case E_USER_ERROR:
				echo "<b>ERROR</b> An error occured<br />\n";
				$out['title'] = 'An error occured';
				/*
				include(ROOT . '/edit/header.template.php');
				include(ROOT . '/edit/error.template.php');
				include(ROOT . '/edit/footer.template.php');
				*/
				die();
				break;
				
				case E_USER_WARNING:
				echo "<b>WARNING</b> [$errno] $errstr in line $errline of file $errfile<br />\n";
				break;
		}
		
}

//set_error_handler ('production_error_handler');


if ($thinkedit->isInProduction())
{
		set_error_handler ('production_error_handler');
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
		
		if (!empty ($translation_id))
		{
				
				global $thinkedit, $user;
				
				// todo, use config
				$translation = $thinkedit->newRecord('translation');
				
				//$translation->set('translation', $translation_id);
				//$translation->set('locale', $user->getLocale());
				$the_translation = $translation->findFirst(array('translation_id' => $translation_id, 'locale' => $thinkedit->user->getLocale() ));
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
						$translation->set('locale', $thinkedit->user->getLocale());
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




?>