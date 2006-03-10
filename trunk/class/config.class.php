<?php

class config
{
		function config()
		{
				global $thinkedit;
				$this->config = $thinkedit->config;
				if (!is_array($this->config))
				{
						trigger_error('config::config() var config is not defined');
				}
		}
		
		
		
		function getTitleFields($table)
		{
				foreach ($this->config['table'][$table]['field'] as $id=>$field)
				{
						$all_fields[] = $id;
						if ($field['is_title'] == 1 || $field['is_title'] == 'true')
						{
								$fields[] = $id;
						}
				}
				if (is_array($fields))
				{
						return $fields;
				}
				else
				{
						return $all_fields;
				}
				
		}
		
		
		function getPrimaryFields($table)
		{
				foreach ($this->config['table'][$table]['field'] as $id=>$field)
				{
						$all_fields[] = $id;
						if (isset($field['primary']))
						{
								if ($field['primary'] == 'true' || $field['primary'] == 1)
								{
										$fields[] = $id;
								}
						}
				}
				if (is_array($fields))
				{
						return $fields;
				}
				else
				{
						trigger_error('table_has_no_primary_fields');
						return false;
				}
				
		}
		
		
		function getAllFields($table)
		{
				foreach ($this->config['table'][$table]['field'] as $id=>$field)
				{
						$all_fields[] = $id;
						
				}
				if (is_array($all_fields))
				{
						return $all_fields;
				}
				else
				{
						trigger_error('table_has_no_fields');
						return false;
				}
				
		}
		
		
		/**
		* Returns a list of available modules type in config
		*
		*
		**/
		function getTableList()
		{
				if (isset($this->config['table']))
				{
						foreach ($this->config['table'] as $table_id=>$table)
						{
								//$list[] = $this->new_module($module_id);
								$list[] = $table_id;
						}
						return $list;
				}
				else
				{
						trigger_error(translate('no_tables_in_config'));
						return false;
				}
		}
		
		
		
		function tableExists($table)
		{
				if (in_array($table, $this->getTableList()))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		
		function cleanPath($path)
		{
				return rtrim($path, '/');
		}
		
		
		function getRootPath($default = false)
		{
				
				if (isset($this->config['site']['root_path'] ))
				{
						return $this->cleanPath($this->config['site']['root_path']);
				}
				else
				{
						//trigger_error('config::getRootUrl() root_url not defined in config, please define it in config.xml');
						return $default;
				}
				
		}
		
		function getRootUrl()
		{
				
				if (isset($this->config['site']['root_url'] ) )
				{
						return $this->cleanPath($this->config['site']['root_url']);
				}
				else
				{
						trigger_error('config::getRootUrl() root_url not defined in config, please define it in config.xml', E_USER_ERROR);
						return false;
				}
				
		}
		
		function getTmpPath()
		{
				if (isset($this->config['site']['tmp_path'] ) )
				{
						return $this->cleanPath($this->config['site']['tmp_path']);
				}
				else
				{
						// is this better supported on hosts ? : 
						// if safe mode is on, we'll have trouble : http://bugs.php.net/bug.php?id=27133
						$path = realpath(dirname(tempnam('/tmp', 'foo'))) . '/';
						//echo $path;
						return $path;
						
						//trigger_error('config::getTmpPath() tmp_path not defined in config, please define it in config.xml' , E_USER_ERROR);
						//return false;
				}
				
		}
		
		function getDesign()
		{
				if (isset($this->config['site']['design']))
				{
						// todo check if folder exists
						return $this->config['site']['design'];
				}
				else
				{
						return 'default';
				}
		}
		
}



?>
