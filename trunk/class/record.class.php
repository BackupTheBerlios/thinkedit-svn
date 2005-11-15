<?php


class record
{
	
	function record($table)
	{
		$this->table = $table;
		
		// load config
		global $thinkedit;
		if (isset($thinkedit->config['table'][$table]))
		{
			$this->config = $thinkedit->config['table'][$table];
		}
		else
		{
			trigger_error('record::record() Table called "' . $this->table . '" not found in config, check table id spelling in config file / in code');
		}
		
		if (is_array($this->config['field']))
		{
			foreach ($this->config['field'] as $id=>$field)
			{
				$this->field[$id] = $thinkedit->newField($table, $id);
			}
		}
		else
		{
			trigger_error('record::record() Table called "' . $this->table . '" has no fields defined. Check config file');
		}
		
	}
	
	
	
	// Returns the primary keys in this record
	function getPrimaryKeys()
	{
		foreach ($this->field as $field)
		{
			if ($field->isPrimary())
			{
				$list[] = $field->getId();
			}
		}
			if (is_array ($list))
			{
				return $list;
			}
			else
			{
				trigger_error('record::getPrimaryKeys() : no primary keys found in table called ' . $this->table);
				return false;
			}
	}
	
	
	
	function setArray($array)
	{
		if (is_array($array))
		{
			foreach ($array as $id=>$value)
			{
				if (isset($this->field[$id]))
				{
					$this->field[$id]->set($value);
				}
			}
			return true;
		}
		else
		{
			trigger_error('$array is not an array');
			return false;
		}
		
	}
	
	function getArray()
	{
		foreach ($this->field as $field)
		{
			$data[$field->getId()] = $field->get();
		}
		return $data;
	}
	
	function getNiceArray()
	{
		foreach ($this->field as $field)
		{
			$data[$field->getId()] = $field->getNice();
		}
		return $data;
	}
	
	function getId()
	{
		
		foreach ($this->field as $field)
		{
			if ($field->getType() == 'id')
			{
				return $field->get();
			}
		}
		trigger_error('record::getId() : no id field found in table called ' . $this->table);
		return false;
	}




}

?>
