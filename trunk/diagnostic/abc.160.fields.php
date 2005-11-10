<?php


class fields
{
	
	
	function try()
	{
		
		
		
		return true;
		
		global $thinkedit;
		$tables = $thinkedit->getTableList();
		$db = $thinkedit->getDb();
		$result = true;
		foreach ($tables as $table)
		{
			
			if ($db->hasTable($table))
			{
				
			}
			else
			{
				trigger_error('Diagnostic : table ' . $table . ' not in DB');
				$result = false;
			}
			
			return $result;
			
		}
		
		return true;
		
		
		
		
		$fldlist = mysql_list_fields($DB, $Table);
		$columns = mysql_num_fields($fldlist);
		
		for ($i = 0; $i < $columns; $i++) {
			$Listing[] = mysql_field_name($fldlist, $i);
		}
		Return ($Listing); 
		
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
		return true;
	}
	
	
}

?>



