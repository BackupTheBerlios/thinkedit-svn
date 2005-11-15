<?php

require_once 'session.class.php';

class user
{
	
	function user()
	{
		global $thinkedit;
		$this->db = $thinkedit->getDb();
		//$this->load();
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
	
	function load()
	{
		trigger_error('deprecated');
		return true;
		
		global $thinkedit;
		$session = new session();
		
		//echo $sql;
		
		$res = $this->db->select($sql); 
	}
	
	function hasPermission($permission)
	{
		return true;
		// If I don't have any permissions, fetch them
		if ( !isset($this->permissions) )
		{
			$this->permissions = array();
			$sql="SELECT
			p.".PERM_TABLE_NAME." as permission
			FROM
			".USER2COLL_TABLE." uc, ".COLL2PERM_TABLE.
			" cp, ".PERM_TABLE." p
			WHERE
			uc.".USER2COLL_TABLE_USER_ID."='".$this->userId."'
			AND
			uc.".USER2COLL_TABLE_COLL_ID.
			" = cp.".COLL2PERM_TABLE_COLL_ID."
			AND
			cp.".COLL2PERM_TABLE_PERM_ID." = p.".PERM_TABLE_ID;
			$result=$this->db->select($sql);
			while ( $row=$result->fetch() )
			{
				$this->permissions[]=$row['permission'];
			}
		}
		if ( in_array($permission,$this->permissions) )
		{
			return true;
		}
		else
		{
			return false;
		}
		
		
	}
	
	
	
	
	function getLocale()
	{
		return 'fr';
	}
	
	function isAnonymous()
	{
		
	}
	
}


?>