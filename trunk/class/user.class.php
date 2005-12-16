<?php

require_once 'session.class.php';

class user
{
  
  function user()
  {
  }
  
  function login($login, $password)
  {
	global $thinkedit;
	
	// select from DB
	$sql = sprintf("select * from %s where login='%s' and password='%s'", $thinkedit->getTable('user'), $login, $password);
	$res = $this->db->select($sql); 
	if (count($res) == 1)
	{
	  return true;
	}
	else
	{
	  return false;
	}
  }
  
  function logout()
  {
  }
  
  
  function hasPermission($permission, $object = false)
  {
	return true;
  }
  
  
  
  
  function getLocale()
  {
	return 'fr';
  }
  
  function isLogged()
  {
  }
  
}


?>