<?php
// check if current user is valid
function check_user ()
{
		global $thinkedit;
		if ($thinkedit->user->isLogged())
		{
				return true;
		}
		else
		{
				$url = urlencode ($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); 
				redirect("login.php?original_url=$url");
		}
		
}

?>
