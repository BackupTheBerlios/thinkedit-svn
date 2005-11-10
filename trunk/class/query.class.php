<?php

/**
* Sql query generator, simplistic interface, builds sql queries for use by database
*
*
*/
class query
{
	
	var $type;
	var $param;
	var $limit;
	var $table;
	var $where;
	var $value;
	
	
	/**
	* Initialise query object. It needs nothing, but if a db object is passed,
	* It's escape function is used. This is usefull, because db escaping is db specific.
	*
	**/
	function query($db = false)
	{
		if ($db)
		{
			$this->db = $db;
		}
		else
		{
			global $thinkedit;
			if ($thinkedit)
			{
				$this->db = $thinkedit->getDb();
			}
			else
			{
				trigger_error('query::query() No db instance passed as parameter, and no global thinkedit object found, db->escape won\'t work');
			}
		}
		
	}
	
	
	/**
	* Adds a user defined field as limitator for example $this->add('title', 'like', 'News%')
	* Used as "where xxx = yyy" in sql
	*
	**/
	function addCondition($param, $operator, $value, $quote = true)
	{
		die('query::addCondition() is deprecated use addwhere() instead, exiting');
		//  $this->param[$param][$operator]=$value;
		$this->condition[$param]['param'] = $param;
		$this->condition[$param]['operator'] = $operator;
		$this->condition[$param]['value'] = $value;
		$this->condition[$param]['quote'] = $quote;
	}
	
	
	
	/**
	* adds a where clause to the sql query
	*
	* needs
	* a row,
	* a condition (=, < , >, like, etc ...)
	* a value to match
	* if we want the field name to be quoted or not (boolean)
	*/
	function addWhere($row, $condition, $value, $quote = true)
	{
		$this->where[$row]['condition'] = $condition;
		$this->where[$row]['value'] = $value;
		$this->where[$row]['quote'] = $quote;
	}
	
	
	/**
	* adds a where clause to the sql query
	*
	* needs
	* a row,
	* a condition (=, < , >, like, etc ...)
	* a value to match
	* if we want the field name to be quoted or not (boolean)
	*/
	function addValue($row, $value, $quote = true)
	{
		$this->value[$row]['value'] = $value;
		$this->value[$row]['quote'] = $quote;
	}
	
	/**
	* adds a table to use
	*
	*/
	function addTable($table, $quote = true)
	{
		$this->table[$table]['table'] = $table;
		$this->table[$table]['quote'] = $quote;
		
	}
	
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
				
				$sql .= $row . ' ' . $where['condition'] . ' ';
				
				/*
				Now done in db->escape()
				
				// numeric values are not quoted
				if (!is_numeric($where['value']))
				{
					$sql .= "'";
				}
				*/
				
				if ($where['quote'])
				{
					$sql .= $this->db->escape($where['value']);
				}
				else
				{
					$sql .= $where['value'];
				}
				
				/*
				if (!is_numeric($where['value']))
				{
					$sql .= "'";
				}
				*/
				
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
	
	
	/**
	* Renders the sql "from" table clause
	*
	*
	**/
	function getFromClause()
	{
		$sql = '';
		$i = 0;
		
		if (is_array($this->table))
		{
			foreach ($this->table as $table => $from)
			{
				if ($from['quote'])
				{
					$sql .= ' ' . $this->db->escape($from['table']) . ' ';
				}
				else
				{
					$sql .= ' ' . $from['table'] . ' ';
				}
				
				if ($i < count($this->table)-1)
				{
					$sql .= ', ';
				}
				$i++;
			}
			$sql .= ' ';
			return $sql;
		}
		else
		{
			trigger_error('query::getFromClause() query won\'t work if we select from "nothing", please query::addFrom() at least for one table');
			return false;
		}
	}
	
	
	/**
	* if limit is set, will use a limit query (for paged result sets for example)
	*
	*/
	function setLimit($start, $lenght)
	{
		$this->limit['start'] = (int) $start;
		
		$this->limit['lenght'] = (int) $lenght;
		return true;
	}
	

	
	/**
	* returns a select query string
	*
	*/
	function getSelectQuery()
	{
		
		$sql = "select * from " . $this->getFromClause();
		
		if ($this->getWhereClause())
		{
			$sql .= $this->getWhereClause();
		}
		
		if (is_array($this->limit))
		{
			$sql .= ' limit ' . $this->limit['start'] . ', ' . $this->limit['lenght'];
		}
		
		return $sql;
	}
	
	
	/**
	* returns an insert query string
	*
	*/
	function getInsertQuery()
	{
		$sql = "insert into " . $this->getFromClause();
		
		if (is_array($this->value))
		{
			$i = 0;
			$sql.= ' (';
			
			// builds row list in ()'s
			foreach ($this->value as $row=>$value)
			{
				$sql.= $this->db->escape($row);
				
				if ($i < count($this->value)-1)
				{
					$sql .= ', ';
				}
				$i++;
			}
			$sql.= ' )';
			
			// builds data in ()'s quoted
			$i = 0;
			$sql.= ' values (';
			
			foreach ($this->value as $row=>$value)
			{
				$sql.= $this->db->escape($value['value']);
				
				if ($i < count($this->value)-1)
				{
					$sql .= ', ';
				}
				$i++;
			}
			$sql.= ' )';
			
			if ($this->getWhereClause())
			{
				$sql .= $this->getWhereClause();
			}
			
			return $sql;
		}
		else
		{
			trigger_error('query::insert() cannot insert without values, please $this->addValue() at least once');
			return false;
		}
	}
	
	
	
	
	/**
	* returns an update query string
	*
	*/
	function getUpdateQuery()
	{
		$sql = "update " . $this->getFromClause();
		if (is_array($this->value))
		{
			$i = 0;
			$sql.= ' set ';
			
			foreach ($this->value as $row=>$value)
			{
				$sql.= $this->db->escape($row);
				$sql .= '=';
				$sql.= $this->db->escape($value['value']);
				
				if ($i < count($this->value)-1)
				{
					$sql .= ', ';
				}
				$i++;
			}
			$sql.= ' ';
			
			if ($this->getWhereClause())
			{
				$sql .= $this->getWhereClause();
			}
			
			return $sql;
		}
		else
		{
			trigger_error('query::update() cannot update without values, please $this->addValue() at least once');
			return false;
		}
	}
	
	
	/*
	Counts the number of item in this sql query
	Usefull for paged navigation for instance
	*/
	function getCountClause()
	{
		$sql = "select count(*) as count from " . $this->getFromClause();
		
		if ($this->getWhereClause())
		{
			$sql .= $this->getWhereClause();
		}
		
		
		return $sql;
	}
	
	
	function select()
	{
	return $this->db->select($this->getSelectQuery());
	}
	
	
	function insert()
	{
	return $this->db->query($this->getInsertClause());
	}
	
	function update()
	{
	return $this->db->query($this->getUpdateClause());
	}
	
	function count()
	{
	return $this->db->query($this->getCountClause());
	}
}

?>