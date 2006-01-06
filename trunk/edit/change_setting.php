<?php
/*
Change a setting in user session, and redirect to referer url.
*/


require_once('common.inc.php');


// needed if the request variables are not automatically registered
$setting = $_REQUEST['setting'];
$value = $_REQUEST['value'];




// 1. change setting

if ($setting <> 'user')
{
  $_SESSION[$setting] = $value;
}


//$_SESSION[$setting] = $value;




// 2. redirect to original page

if ($_SERVER['HTTP_REFERER'])
{
  if ($setting == 'preferred_locale')
  {
    $url = $_SERVER['HTTP_REFERER'] . '&db_locale=' . $value;
  }
  else
  {
    $url = $_SERVER['HTTP_REFERER'];
  }
	
	
	//echo $url;
	
  header("Location: " . $url);
}
else
{
 header("Location: main.php");
}




?>
