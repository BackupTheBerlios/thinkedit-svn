<?php
// check if current user is valid
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
