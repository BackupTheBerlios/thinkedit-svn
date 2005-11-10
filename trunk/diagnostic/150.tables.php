<?php


class tables
{
	
	
	function try()
	{
		global $thinkedit;
		$tables = $thinkedit->getTableList();
		$db = $thinkedit->getDb();
		$result = true;
		
		print_r($tables);
		foreach ($tables as $table)
		{
			
			if ($db->hasTable($table))
			{
				echo $table . ' found';
			}
			else
			{
				trigger_error('Diagnostic : table ' . $table . ' not in DB');
				$this->table = $table;
				$result = false;
			}
			
			
			
		}
		return $result;
	}
	
	// bof ...
	function getContext()
	{
		$context['table'] = $this->table;
		return $context;
	}
	
	function getHelp()
	{
		return 'Test if all the tables defined in the config files are present in the DB';
	}
	
	function getTitle()
	{
		return 'SQL Tables';
	}
	
	function canFix()
	{
		return true;
	}
	
	
	function fix()
	{
		global $thinkedit;
		$db = $thinkedit->getDb();
		if (isset($this->table))
		{
			return $db->createTable($this->table);
		}
		else
		{
			trigger_error('cannot fix, table not defined');
			return false;
		}
		
	}
	
	
}

?>