<?php


class record
{
		
		function record($table)
		{
				$this->table_name = $table;
				
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
		
		function getTableName()
		{
				return $this->table_name;
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
				global $user;
				if ($user->hasPermission('view', $this))
				{
						
						if ($this->checkPrimaryKey())
						{
								
								$sql = "select * from " . $this->getTableName() . " where ";
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
								// is it an error to try to load a record without filling all the primary keys?
								//trigger_error("record::load() you must set all primary keys if you want to load a record");
								// we should return false and set an error somewhere... 
								return false;
						}
				}
		}
		
		
		function find($where= false, $order = false, $limit = false)
		{
				global $user;
				if ($user->hasPermission('view', $this))
				{
						$sql = "select * from " . $this->getTableName();
						
						if (is_array($where))
						{
								$sql .= " where ";
								foreach ($where as $key=>$value)
								{
										$where_clause[] =  $key . '=' . "'" . $value . "'";
										
								}
								$sql .= implode($where_clause, ' and ');
						}
						
						
						debug($sql, 'record:find() sql');
						
						global $thinkedit;
						$db = $thinkedit->getDb();
						
						$results = $db->select($sql);
						
						if ($results && count($results) > 0)
						{
								global $thinkedit;
								debug($results, 'record:find() results for select query');
								foreach ($results as $result)
								{
										$record = $thinkedit->newRecord($this->getTableName());
										foreach ($result as $key=>$field)
										{
												$record->set($key, $field);
										}
										$records[] = $record;
								}
								return $records;
						}
						else
						{
								return false;
						}
				}
		}
		
		
		
		
		
		function save()
		{
				global $user;
				if ($user->hasPermission('update', $this))
				{
						global $thinkedit;
						$db = $thinkedit->getDb();
						
						// if all primary keys are set and we have a row in the DB (successfull load), 
						// we update
						//if ($this->checkPrimaryKey() && $this->load())
						// why do we need to load before saving ?
						if ($this->checkPrimaryKey())
						{
								$sql = "update " . $this->getTableName() . ' set ';
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
								
								debug($sql, 'record::save()');
								
								if ($db->query($sql))
								{
										return true;
								}
								else
								{
										trigger_error('record::save() failed while updating record');
										return false;
								}
								//return  $sql;
						}
						else
						// if not all or no primary keys are set,
						// we do an insert
						{
								$sql = "insert into " . $this->getTableName();
								
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
								
								
								if ($db->query($sql))
								{
										return true;
								}
								else
								{
										trigger_error('record::save() failed while inserting record');
										return false;
								}
						}
						
						
				}
				
				
				
				
		}
		
		function delete()
		{
				global $user;
				if ($user->hasPermission('delete', $this))
				{
						if ($this->checkPrimaryKey())
						{
								
								$sql = "delete from " . $this->getTableName() . " where ";
								
								foreach ($this->field as $field)
								{
										if ($field->isPrimary())
										{
												$where[] =  $field->getId() . '=' . "'" . $field->get() . "'";
										}
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
								trigger_error("record::delete() you must set all primary keys if you want to load a record");
								return false;
						}
				}
		}
		
		
		
		
		// returns true if all primary keys are _set_
		// false else
		function checkPrimaryKey()
		{
				foreach ($this->field as $field)
				{
						if ($field->is_empty() and $field->isPrimary())
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
				//die ('deprecated, use getUid() instead');
				
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
		
		// very important concept
		function getUid()
		{
				
				$data['class'] = 'record';
				$data['type'] = $this->getTableName();
				// builds an array of all primary keys
				foreach ($this->field as $field)
				{
						if ($field->isPrimary())
						{
								$data[$field->getId()] = $field->get();
						}
						
				}
				
				return $data;
		}
		
		
		function getTitle()
		{
				$title = '';
				foreach ($this->field as $field)
				{
						if ($field->isTitle())
						{
								$title[]= $field->get();
						}
				}
				return implode($title, ' ');
		}
		
		
}

?>
