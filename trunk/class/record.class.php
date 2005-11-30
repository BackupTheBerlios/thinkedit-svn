<?php


class record
{
  
  function record($table)
  {
	$this->tableName = $table;
	
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
  
  
  
  function get($field)
  {
	return $this->field[$field]->get();
  }
  
  
  function set($field, $value)
  {
	//debug ($field, 'field');
	//debug($value, 'value');
	if (isset($this->field[$field]))
	{
	  $this->field[$field]->set($value);
	}
	else
	{
	  return false;
	}
  }
  
  
  
  /*
  Load will only load a single record and assign values to the current object
  Look at find() for multiple load
  */
  function load()
  {
	if ($this->checkPrimaryKey())
	{
	  
	  $sql = "select * from " . $this->tableName . " where ";
	  foreach ($this->field as $field)
	  {
		if ($field->isPrimary())
		{
		  $where[] =  $field->getId() . '=' . "'" . $field->get() . "'";
		}
	  }
	  $sql .= implode($where, ' and ');
	  
	  debug($sql, 'Sql query');
	  
	  global $thinkedit;
	  $db = $thinkedit->getDb();
	  
	  $results = $db->select($sql);
	  
	  if ($results && count($results) == 1)
	  {
		debug($results, 'results for select query');
		foreach ($results[0] as $key=>$field)
		{
		  $this->set($key, $field);
		}
		return true;
	  }
	  else
	  {
		return false;
	  }
	}
	else
	{
	  trigger_error("record::load() you must set all primary keys if you want to load a record");
	  return false;
	}
  }
  
  
  function find()
  {
	
	$sql = "select * from " . $this->tableName . " where ";
	foreach ($this->field as $field)
	{
	  if ($field->isPrimary())
	  {
		$where[] =  $field->getId() . '=' . "'" . $field->get() . "'";
	  }
	}
	$sql .= implode($where, ' and ');
	
	debug($sql, 'Sql query');
	
	global $thinkedit;
	$db = $thinkedit->getDb();
	
	$results = $db->select($sql);
	
	if ($results && count($results) == 1)
	{
	  debug($results, 'results for select query');
	  foreach ($results[0] as $key=>$field)
	  {
		$this->set($key, $field);
	  }
	  return true;
	}
	else
	{
	  return false;
	}
  }
  
  
  
  
  
  function save()
  {
	// il all primary keys are set and we have a row in the DB (successfull load), 
	// we update
	if ($this->checkPrimaryKey() && $this->load())
	{
	  $sql = "update " . $this->tableName . ' set ';
	  foreach ($this->field as $id=>$field)
	  {
		$set[] =  $id . '=' . "'" . $this->get($id) . "'"; 
	  }
	  $sql .= implode($set, ', ');
	  
	  $sql .= " where ";
	  foreach ($this->field as $field)
	  {
		if ($field->isPrimary())
		{
		  $where[] =  $field->getId() . '=' . "'" . $field->get() . "'";
		}
	  }
	  $sql .= implode($where, ' and ');
	  
	  return  $sql;
	}
	else
	// if not all or no primary keys are set,
	// we do an insert
	{
	  $sql = "insert into " . $this->tableName;
	  
	  foreach ($this->field as $id=>$field)
	  {
		$fields_names[] =  $id; 
	  }
	  
	  $sql.= ' ( ';
	  $sql .= implode($fields_names, ', ');
	  $sql.= ' ) ';
	  
	  $sql.= ' values ';
	  
	  
	  foreach ($this->field as $id=>$field)
	  {
		$values[] =  "'" . $this->get($id) . "'"; 
	  }
	  $sql.= ' ( ';
	  $sql .= implode($values, ', ');
	  $sql.= ' ) ';
	  
	  return  $sql;
	  
	}
	
	
	
	
  }
  
  function delete()
  {
	if ($this->checkPrimaryKey())
	{
	  
	  $sql = "delete * from " . $this->tableName . " where ";
	  foreach ($this->primaryKeys as $key)
	  {
		$where[] =  $key . '=' . "'" . $this->get($key) . "'"; 
	  }
	  $sql .= implode($where, ' and ');
	  
	  global $thinkedit;
	  $db = $thinkedit->getDb();
	  
	  $results = $db->query($sql);
	  
	  if ($results && count($results) == 1)
	  {
		return true;
	  }
	  else
	  {
		return false;
	  }
	}
	else
	{
	  trigger_error("record::load() you must set all primary keys if you want to load a record");
	  return false;
	}
  }
  
  
  
  
  // returns true if all primary keys are _set_
  // false else
  function checkPrimaryKey()
  {
	foreach ($this->field as $field)
	{
	  if ($field->is_null() and $field->isPrimary())
	  {
		return false;
	  }
	}
	
	return true;
	
	
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
  
  
  /*
  // Returns the fields in this record
  function getFields()
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
  */
  
  
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
