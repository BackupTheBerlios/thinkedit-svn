<?php


// check if current user is valid
function check_user ()
{

  if (isset($_SESSION['user']))
  {
  //nothing to do, we are registered
	}
  else
  {
    $url = urlencode ($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); 
		redirect("login.php?original_url=$url");
  }

}

?>
