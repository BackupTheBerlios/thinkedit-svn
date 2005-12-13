<?php
/*

Rules : 

pass/return only arrays

*/


class table
{
	
	var $where;
	
	function table($table)
	{
		$this->table=$table;
		global $thinkedit;
		$this->db = $thinkedit->getDb();
		
		if (isset($thinkedit->config['table'][$table]))
		{
			$this->config = $thinkedit->config['table'][$table];
		}
		else
		{
			trigger_error('table::table() Table called "' . $this->table . '" not found in config, check table id spelling in config file / in code');
		}
	}
	
	
	/*
	Returns table id fomr config
	*/
	function getTableName()
	{
		return $this->table;
	}
	
	
	/*
	Returns table id fomr config
	*/
	function getId()
	{
	  die('deprecated');
	  return $this->table;
	}
	
	function getTitle()
	{
	  return $this->table;
	}
	
	/*
	Returns real sql table name, not table id in config
	*/
	function getSqlTableName()
	{
		// todo : handle table name in config instead of using id
		return $this->table;
	}
	
	
	
	
	function limit($start, $end)
	{
		$this->start = (int) $start;
		$this->end = (int) $end;
	}
	
	function filter($column, $criteria, $value)
	{
		$this->where[$column]['criteria'] = $criteria;
		$this->where[$column]['value'] = $value;
	}
	
	function filterByRecord($record)
	{
		// experimental : query by example : add a filter for each defined field.
		foreach ($record as $field=>$value)
		{
			
			$this->filter($field, '=', $value);
			
		}
	}
	
	
	// queries :
	
	function select()
	{
		$sql = "select * from " . $this->getSqlTableName();
		
		
		if ($this->getWhereClause())
		{
			$sql .= $this->getWhereClause();
		}
		
		
		if (isset($this->start) && isset($this->end))
		{
			$sql .= ' limit ' . $this->start . ', ' . $this->end;
		}
		
		$results = $this->db->select($sql);
		
		if (is_array($results))
		{
			/*
			foreach ($results as $result)
			{
				global $thinkedit;
				$record = $thinkedit->newRecord($this->getTable());
				$record->setArray($result);
				$records[] = $record;
			}
			
			return $records;
			*/
			return $results;
		}
		else
		{
			return false;
		}
	}
	
	
	function insert($record)
	{
		global $thinkedit;
		$config = $thinkedit->newConfig();
		$fields_list = $config->getAllFields($this->getTableName());
		$primary_fields_list = $config->getPrimaryFields($this->getTableName());
		
		
		$sql = "insert into `" . $this->getSqlTableName();
		
		
		$sql .= '` (';
		foreach ($record as $field=>$value)
		{
			if (in_array($field, $fields_list))
			{
				$fields[] =   "`" .$field . "`";
			}
		}
		
		$sql .= implode(', ',  $fields );
		$sql .= ')';
		
		$sql .= ' values ';
		
		$sql .= '(';
		
		foreach ($record as $field=>$data)
		{
			if (in_array($field, $fields_list))
			{
				$fields_data[] =  "'" . $this->db->escape($data) . "'";
			}
		}
		$sql .= implode(', ',  $fields_data);
		$sql .= ')';
		
		
		$results = $this->db->query($sql);
		return $results;
		
		//$sql;
		
	}
	
	
	/*
	old record class based update()
	
	function update($record)
	{
		$sql = "update  " . $this->getTableName();
		$sql .= ' set ';
		
		// $sql .= '';
		foreach ($record->field as $field)
		{
			$sql_fields[] = $field->getId() . ' = ' . "'" . $this->db->escape($field->get()) . "'";
		}
		
		$sql .= implode(', ',  $sql_fields);
		
		
		foreach ($record->field as $field)
		{
			if ($field->isPrimary())
			{
				$this->filter($field->getId(), '=', $field->get() );
			}
		}
		
		
		$sql.= $this->getWhereClause();
		
		// echo $sql;
		$results = $this->db->query($sql);
		return $results;
	}
	
	*/
	
	
	/*
	givren an array, it will update the corresponding record(s)
	*/
	function update($record)
	{
		global $thinkedit;
		$config = $thinkedit->newConfig();
		$fields_list = $config->getAllFields($this->getTableName());
		$primary_fields_list = $config->getPrimaryFields($this->getTableName());
		
		$sql = "update `" . $this->getSqlTableName() . "`";
		
		$sql.= " set ";
		
		foreach ($record as $field=>$value)
		{
			if (in_array($field, $fields_list))
			{
				$fields[] =   "`" .$field . "`" . "=" . "'" . $this->db->escape($value) . "'";
			}
		}
		
		$sql .= implode(', ',  $fields );
		
		$sql .= ' where ';
		foreach ($record as $field=>$value)
		{
			if (in_array($field, $primary_fields_list))
			{
				$primary_fields[] =   "`" .$field . "`" . "=" . "'" . $this->db->escape($value) . "'";
			}
		}
		
		$sql .= implode(' and ',  $primary_fields );
		
		
		$results = $this->db->query($sql);
		return $results;
	}
	
	
	/*
	// given an array, it will update an item if it is found else raise error
	function update($record)
	{
		//$sql = "update  " . $this->getSqlTableName();
		//$sql .= ' set ';
		
		// instance new query
		require_once('query.class.php');
		$query = new query();
		
		$query->addTable($this->getSqlTableName());
		
		
		// get field names from config
		require_once('config.class.php');
		$config = new config();
		$fields = $config->getAllFields($this->getTableName());
		$primary_fields = $config->getPrimaryFields($this->getTableName());
		
		
		// take only real fields from input array
		foreach ($record as $field=>$value)
		{
			if (in_array($field, $fields))
			{
				$query->addValue($field, $value);
			}
		}
		
		// take only primary fields from input array and add where clause
		foreach ($record as $field=>$value)
		{
			if (in_array($field, $primary_fields))
			{
				$query->addWhere($field, '=', $value);
			}
		}
		
		debug($record);
		
		die($query->getUpdateQuery());
		
		// $sql .= '';
		foreach ($record->field as $field)
		{
			$sql_fields[] = $field->getId() . ' = ' . "'" . $this->db->escape($field->get()) . "'";
		}
		
		$sql .= implode(', ',  $sql_fields);
		
		
		foreach ($record->field as $field)
		{
			if ($field->isPrimary())
			{
				$this->filter($field->getId(), '=', $field->get() );
			}
		}
		
		
		$sql.= $this->getWhereClause();
		
		// echo $sql;
		$results = $this->db->query($sql);
		return $results;
	}
	*/
	
	
	function delete($record)
	{
		$delete_allowed = true;
		
		foreach ($record->getPrimaryKeys() as $key)
		{
			//print_r ($record);
			
			if (!is_null($record->field[$key]->get()))
			{
				$this->filter($record->field[$key]->getId(), '=', $record->field[$key]->get());
			}
			else
			{
				trigger_error('table::delete() the record has no all primary keys filled, I won\'t try to delete');
				$delete_allowed = false;
			}
			
		}
		
		$sql = "delete from " . $this->getSqlTableName();
		
		
		if ($this->getWhereClause())
		{
			$sql .= $this->getWhereClause();
		}
		if ($delete_allowed)
		{
			$results = $this->db->query($sql);
			return $results;
		}
		else
		{
			return false;
		}
		
		
	}
	
	
	/*
	Counts the number of item in this sql query
	Usefull for paged navigation for instance
	*/
	function count()
	{
		$sql = "select count(*) as count from " . $this->getSqlTableName();
		
		if ($this->getWhereClause())
		{
			$sql .= $this->getWhereClause();
		}
		
		
		$result = $this->db->select($sql);
		return $result[0]['count'];
	}
	
	
	
	// tools : (todo : mark private in comments)
	/**
	* Render the where clause to be used by the query
	*
	*
	**/
	function getWhereClause()
	{
		if (is_array($this->where))
		{
			$sql = " where ";
			$i=0;
			foreach ($this->where as $row => $where)
			{
				
				$sql .= $row . ' ' . $where['criteria'] . ' ';
				
				// numeric values are not quoted
				if (!is_numeric($where['value']))
				{
					$sql .= "'";
				}
				
				
				if (isset($where['quote']))
				{
					$sql .= $this->db->escape($where['value']);
				}
				else
				{
					$sql .= $where['value'];
				}
				
				if (!is_numeric($where['value']))
				{
					$sql .= "'";
				}
				
				if ($i < count($this->where)-1)
				{
					$sql .= ' and ';
				}
				$i++;
			}
			$sql .= ' ';
			return $sql;
		}
		else
		{
			return false;
		}
	}
	
	
	// very important concept
  function getUid()
  {
	// builds an array of all primary keys
	
	$data['class'] = 'table';
	$data['type'] = $this->getTableName();
	return $data;
  }
  
	
	
	
}

?>
