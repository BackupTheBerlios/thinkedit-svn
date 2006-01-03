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
// todo fix debug security, allow debug only if defined in config and display a warning on every page
// idem for user less setup
function debug($data, $title=false)
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
				$translations = $translation->find(array('translation_id' => $translation_id, 'locale' => $user->getLocale() ));
				if ($translations)
				{
						if ($translations[0]->get('translation'))
						{
								return $translations[0]->get('translation');
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
				
				/*
				
				if ($html)
				{
						return htmlentities($translation[0]['translation']);
				}
				else
				{
						return $translation[0]['translation'];
				}
				
				*/
		}
		else
		{
				return false;
		}
}




?>