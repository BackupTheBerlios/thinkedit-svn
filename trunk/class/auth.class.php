<?php
die ('deprecated');
require_once 'session.class.php';

class auth 
{
	function auth ()
	{
		global $thinkedit;
		$this->db = $thinkedit->getDb();
		$this->session = new session();
	}
	/**
	* Checks username and password against database
	* @return void
	* @access private
	*/
	function login($login, $password) 
	{
		global $thinkedit;
		
		
		// See if we have values already stored in the session
		if ( $this->session->get('login') && $this->session->get('password'))
		{
			return true;
		}
		
		// Query to count number of users with this combination
		
		$sql = sprintf("SELECT * FROM %s WHERE login='%s' AND password='%s'", $thinkedit->getTable('users'), $login, $password );
		
		$result = $this->db->query($sql);
		
		
		// If there isn't is exactly one entry, redirect
		if ( count($result)!=1 )
		{
			return false;
		}
		// Else is a valid user; set the session variables	
		else
		{
			$this->session->set('login', $login);
			$this->session->set('password', $password);
			return true;
		}
	}
	
	
	
	
	/**
	* Logs the user out
	* 
	* 
	*
	*/
	function logout () 
	{
		$this->session->del('login');
		$this->session->del('password');
		
	}
	
	
	
}
?>