<?php
/**
* A lightweight MySql access class.
* An adapter could be written for pear or wathever.


What a database user needs : 

select and query

select() returns results as an array of associative arrays
query() returns the number of rows affected

see http://www.justinvincent.com/home/articles.php?articleId=1&page=4



*
*/
class db
{
  function db ($host, $login, $password, $database)
  {
	if (empty ($host)) trigger_error('db::db() host definition empty');
	if (empty ($login)) trigger_error('db::db() login argument is empty');
	if (empty ($password)) trigger_error('db::db() no password given');
	if (empty ($database)) trigger_error('db::db() no database name given, cannot select db');
	$this->host=$host;
	$this->login=$login;
	$this->password=$password;
	$this->database=$database;
	$this->connect();
  }
  
  /**
  * Establishes connection to MySQL and selects a database
  * @return void
  * @access private
  */
  function connect ()
  {
	
	// Make connection to MySQL server
	if (!$this->connection = @mysql_pconnect($this->host, $this->login, $this->password))
	{
	  trigger_error('Could not connect to server');
	  $this->connectError=true;
	  // Select database
	}
	else if ( !@mysql_select_db($this->database,$this->connection) )
	{
	  trigger_error('Could not select database, maybe this database doesn\'t exist ?');
	  $this->connectError=true;
	  return false;
	}
	
  }
  
  /**
  * Checks for MySQL errors
  * @return boolean
  * @access public
  */
  function isError ()
  {
	if (isset($this->connectError))
	{
	  return true;
	}
	if (isset($this->connection))
	{
	  $error=mysql_error($this->connection);
	  $error_number=mysql_errno($this->connection);
	  
	  if ( empty ($error) )
	  {
		return false;
	  }
	  else
	  {
		trigger_error ($error_number . ' : ' . $error);
		return true;
	  }
	}
  }
  
  /**
  * Returns an instance of MySQLResult to fetch rows with
  * @param $sql string the database query to run
  * @return MySQLResult
  * @access public
  */
  function query($sql)
  {
	if (strstr($sql, 'select'))
	{
	  trigger_error('don\'t use query() when selecting, you won\'t have any results back');
	}
	
	// one line debugging tool :-)
	debug($sql, 'db:query()');
	
	$this->sql = $sql;
	$result = mysql_query($sql, $this->connection);
	
	if (!$result)
	{
	  trigger_error ('Query failed: '.mysql_error($this->connection).     ' <br>SQL: '.$sql);
	  return false;
	}
	else
	{
	  return true;
	}
	
	
	// if not rows affected, it wil return 0, and the caller will think it failed, but an update can succeed and change 0 rows
	//return mysql_affected_rows($this->connection);
	
	/*
	if (mysql_affected_rows($this->connection) == -1)
	{
	  return false;
	}
	else
	{
	  return mysql_affected_rows($this->connection);
	}
	*/	
  }
  
  function select($sql)
  {
	global $db_cache;
	
	$hash =  sha1($sql);
	
	if (isset($db_cache[$hash]))
	{
	  // one line debugging tool :-)
	  debug($sql . '[cached]', 'db:select()');
	  return ($db_cache[$hash]);
	}
	else
	{
	  // one line debugging tool :-)
	  debug ($sql . '[select]', 'db:select()');
	  
	  $this->sql = $sql;
	  if (!$this->query = mysql_query($sql,$this->connection))
	  {
		trigger_error ('Query failed: '.mysql_error($this->connection).     ' <br>SQL: '.$sql);
		return false;
	  }
	  
	  
	  $result = '';
	  
	  while ($row = mysql_fetch_assoc($this->query))
	  {
		$result[] = $row;
	  }
	  
	  $db_cache[$hash] = $result;
	  
	  
	  if (count($result > 0))
	  {
		return $result;
	  }
	  else
	  {
		//trigger_error($sql . ' nothing found');
		return false;
	  }
	  
	}
  }
  
  
  function size ()
  {
	return mysql_num_rows($this->query);
  }
  
  function affectedRows ()
  {
	return mysql_affected_rows($this->query);
  }
  
  function insertID ()
  {
	return mysql_insert_id($this->connection);
  }
  
  
  function escape($string)
  {
	if (get_magic_quotes_gpc())
	{
	  trigger_error('get_magic_quotes_gpc() php setting is ON, I don\'t like this');
	  return $string;
	}
	else
	{
	  $string = mysql_real_escape_string($string);
	  return $string;
	  
	}
  }
  
  
  function quote($string)
  {
	if (get_magic_quotes_gpc())
	{
	  trigger_error('gpc on');
	  return $string;
	}
	else
	{
	  // trigger_error('gpc off');
	  if (!is_numeric($string)) 
	  {
		$string = "'" . mysql_real_escape_string($string) . "'";
	  }
	  return $string;
	  
	}
  }
  
  
  function hasTable($table)
  {
	$tables = $this->select("SELECT 1 FROM " . $table . " LIMIT 0");
	if ($tables)
	{
	  return true;
	}
	else
	{
	  return false;
	}
  }
  
  
  function createTable($table)
  {
	$results = $this->query("create table " . $table);
	if ($results)
	{
	  return true;
	}
	else
	{
	  return false;
	}
  }
  
  
}

?>