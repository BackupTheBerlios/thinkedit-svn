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
						trigger_error('record::record() Table called "' . $this->table . '" not found in config, check table id spelling in config file / in code', E_USER_ERROR);
				}
				
				// init fields
				if (is_array($this->config['field']))
				{
						foreach ($this->config['field'] as $id=>$field)
						{
								$this->field[$id] = $thinkedit->newField($table, $id);
						}
				}
				else
				{
						trigger_error('record::record() Table called "' . $this->table . '" has no fields defined. Check config file', E_USER_ERROR);
				}
				
				// init DB
				$this->db = $thinkedit->getDb();
				
		}
		
		function getTableName()
		{
				return $this->table_name;
		}
		
		function get($field)
		{
				return $this->field[$field]->get();
		}
		
		function getSqlSafe($field)
		{
				global $thinkedit;
				$db = $thinkedit->getDb();
				return $db->escape($this->field[$field]->get());
		}
		
		
		function set($field, $value)
		{
				$this->is_loaded = false;
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
						if (isset($this->is_loaded) && $this->is_loaded)
						{
								return true;
						}
						else
						{
								
								if ($this->checkPrimaryKey())
								{
										
										$sql = "select * from " . $this->getTableName() . " where ";
										foreach ($this->field as $field)
										{
												if ($field->isPrimary())
												{
														$where[] =  $field->getId() . '=' . "'" . $this->db->escape($field->get()) . "'";
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
												$this->is_loaded = true;
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
		}
		
		
		function find($where = false, $order = false, $limit = false)
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
										$where_clause[] =  $key . '=' . "'" . $this->db->escape($value) . "'";
										
								}
								$sql .= implode($where_clause, ' and ');
						}
						
						
						debug($sql, 'record:find() sql');
						
						global $thinkedit;
						
						
						$results = $this->db->select($sql);
						
						if ($results && count($results) > 0)
						{
								global $thinkedit;
								//debug($results, 'record:find() results for select query');
								foreach ($results as $result)
								{
										$record = $thinkedit->newRecord($this->getTableName());
										foreach ($result as $key=>$field)
										{
												$record->set($key, $field);
										}
										$record->is_loaded = true;
										$records[] = $record;
								}
								return $records;
						}
						else
						{
								return false;
						}
				}
				else
				{
						return false;
				}
		}
		
		
		function findFirst($where = false, $order = false)
		{
				$results = $this->find($where, $order, '1');
				if (is_array($results))
				{
						return $results[0];
				}
				return false;
		}
		
		
		function save()
		{
				// if I find the same record in the DB based on the keys, I update
				
				foreach ($this->field as $field)
				{
						if ($field->isPrimary())
						{
							//	if ($field->isEmpty())
							//	{
										//trigger_error(__METHOD__ . ' cannot save if all primary keys are not defined');
							//	}
								$fields[$field->getId()] = $field->get();
						}
				}
				
				if (is_array($fields))
				{
						if ($this->find($fields))
						{
								return $this->update();
						}
						else // else I insert
						{
								return $this->insert();
						}
				}
				else
				{
						trigger_error(__METHOD__ . ' no primary fields, cannot save');
						return false;
				}
		}
		
		
		
		
		
		function update()
		{
				global $user;
				if ($user->hasPermission('insert', $this))
				{
						global $thinkedit;
						
						$sql = "update " . $this->getTableName() . ' set ';
						foreach ($this->field as $id=>$field)
						{
								$set[] =  $id . '=' . "'" . $this->db->escape($this->get($id)) . "'"; 
						}
						$sql .= implode($set, ', ');
						
						$sql .= " where ";
						foreach ($this->field as $field)
						{
								if ($field->isPrimary())
								{
										if ($field->isEmpty())
										{
												trigger_error(__METHOD__ . ' cannot save if all primary keys are not defined');
										}
										$where[] =  $field->getId() . '=' . "'" . $this->db->escape($field->get()) . "'";
								}
						}
						$sql .= implode($where, ' and ');
						debug($sql, 'record::update()');
						if ($this->db->query($sql))
						{
								return true;
						}
						else
						{
								trigger_error('record::save() failed while updating record', E_USER_WARNING);
								return false;
						}
				}
		}
		
		
		
		function insert()
		{
				$sql = "insert into " . $this->getTableName();
				foreach ($this->field as $id=>$field)
				{
						// we don't want to use id's in insert clause as we imply that id's are autoincrement fields
						if ($field->getType() <> 'id')
						{
								$fields_names[] =  $id;
						}
				}
				$sql.= ' ( ';
				$sql .= implode($fields_names, ', ');
				$sql.= ' ) ';
				$sql.= ' values ';
				foreach ($this->field as $id=>$field)
				{
						// idem : 
						// we don't want to use id's in insert clause as we imply that id's are autoincrement fields
						if ($field->getType() <> 'id')
						{
								$values[] =  "'" . $this->db->escape($this->get($id)) . "'";
						}
				}
				$sql.= ' ( ';
				$sql .= implode($values, ', ');
				$sql.= ' ) ';
				
				debug($sql, 'record::insert()');
				if ($this->db->query($sql))
				{
						// when finished, set the id of the field to the new autoinserted id (mysql at least)
						$this->field[$this->getIdField()]->set($this->db->insertID());
						return true;
				}
				else
				{
						trigger_error('record::save() failed while inserting record', E_USER_WARNING);
						return false;
				}
		}
		
		
		function delete()
		{
				$this->is_loaded = false;
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
												$where[] =  $field->getId() . '=' . "'" . $this->db->escape($field->get()) . "'";
										}
								}
								
								$sql .= implode($where, ' and ');
								
								
								
								$results = $this->db->query($sql);
								
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
								trigger_error("record::delete() you must set all primary keys if you want to delete a record", E_USER_WARNING);
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
						if ($field->isEmpty() and $field->isPrimary())
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
				if (is_array($list))
				{
						return $list;
				}
				else
				{
						trigger_error('record::getPrimaryKeys() : no primary keys found in table called ' . $this->table, E_USER_WARNING);
						return false;
				}
		}
		
		
		
		
		function setArray($array)
		{
				die ('deprecated');
				$this->is_loaded = false;
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
				die ('deprecated');
				
				foreach ($this->field as $field)
				{
						$data[$field->getId()] = $field->get();
				}
				return $data;
		}
		
		function getNiceArray()
		{
				die ('deprecated');
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
						if ($field->getType() == 'id' || $field->getType() == 'stringid')
						{
								return $field->get();
						}
				}
				trigger_error('record::getId() : no id field found in table called ' . $this->getTableName(), E_USER_WARNING);
				return false;
		}
		
		
		function getIdField()
		{
				//die ('deprecated, use getUid() instead');
				
				foreach ($this->field as $field)
				{
						if ($field->getType() == 'id' || $field->getType() == 'stringid')
						{
								return $field->getName();
						}
				}
				trigger_error('record::getId() : no id field found in table called ' . $this->getTableName(), E_USER_WARNING);
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
				if (!$this->is_loaded)
				{
						trigger_error('record::getTitle() trying to get title on an unloaded record');
				}
				$title = '';
				foreach ($this->field as $field)
				{
						if ($field->isTitle())
						{
								$title[]= $field->get();
						}
				}
				if (is_array($title))
				{
						return implode($title, ', ');
				}
				else
				{
						trigger_error('No title defined in config for table ' . $this->table_name);
						return false;
				}
		}
		
		function getIcon()
		{
				return 'ressource/image/icon/text-x-generic.png';
		}
		
		
		
		function debug()
		{
				$out = '';
				$out .= '<p>';
				foreach ($this->field as $field)
				{
						$out .= '<b>' .  $field->getId() . ' : ' .  $field->get() . '</b><br/>';
				}
				$out .= '</p>';
				return $out;
		}
}

?>
