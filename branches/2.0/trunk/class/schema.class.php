<?php

// Db syncer, will create database tables and field corresponding to the xml config files
class schema()
{
  function schema()
  {
	global $thinkedit;
	$this->db = $thinkedit->getDb();
  }
  
  
  function fixTable($table_id)
  {
	
	global $thinkedit;
	$table = $thinkedit->newTable($table_id);
	
	// table exists ?
	if ($this->db->hasTable($table_id))
	{
	  debug('table there');
	}
	else
	{
	  debug('table not there');
	}
	
	// if table not there, create it with simple id field
	
	// if table exists, 
	// loop over fields
	// if field not there, create it with right type
	
	// handle field change type ?
	// this may be a risky job
	
	// handle primary keys
	
	// handle indexes
	
	// end
  }
  
  function fixAllTables()
  {
	require_once ROOT . '/class/config.class.php';
	$config = new $config();
	
	$tables = $config->getTableList();
	
	foreach ($tables as $table)
	{
	  $this->fixTable($table);
	}
	
	
  }
  
  
}

?>
