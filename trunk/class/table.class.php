<?php
/*
Class to deal with sql tables on the server (will allow to create tables for instance)
*/
class table
{
		
		
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
		
		
		// very important concept
		function getUid()
		{
				// builds an array of all primary keys
				
				$data['class'] = 'table';
				$data['type'] = $this->getTableName();
				return $data;
		}
		
		
		function hasField($field_name)
		{
				$fields = $this->db->select('describe ' . $this->getTableName() );
				debug($fields, 'Fields found in table ' . $this->getTableName() );
				foreach ($fields as $field)
				{
						if ($field['Field'] == $field_name)
						{
								return true;
						}
				}
				
				return false;
		}
		
		
		function createField($name, $type, $extra = false)
		{
				$sql = 'alter table ' . $this->getTableName() . ' add column ';
				
				if ($type == 'varchar')
				{
						if (isset ($extra['size']))
						{
								$sql .= $name . ' ' . $type . '(' . $extra['size'] . ')';
						}
						else
						{
								trigger_error(__METHOD__ . '$extra[\'size\'] must be defined with varchar');
						}
				}
				
				elseif ($type == 'text')
				{
						
						$sql .= $name . ' ' . $type;
				}
				
				elseif ($type == 'int')
				{
						
						$sql .= $name . ' ' . $type;
				}
				
				elseif ($type == 'datetime')
				{
						
						$sql .= $name . ' ' . $type;
				}
				else
				{
					trigger_error("type $type is not supported");
				}
				
				
				
				debug ($sql, 'Sql from createField');
				
				$results = $this->db->query($sql);
				//examples :
				// ALTER TABLE `article` ADD `test` VARCHAR( 250 ) NOT NULL ;
				
		}
		
		
		
}

?>
