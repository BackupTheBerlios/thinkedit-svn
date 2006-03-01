<?php
/**
* Thinkedit Base class
*/


require_once('xml_parser.class.php');
require_once('db.class.php');



/**
* Thinkedit 2 Base class
*
*/
class thinkedit
{
		
		var $module; // object containing an instance of each module, ready to use
		
		
		/**
		* Passing it a config folder, and it will use it for the whole application
		**/
		function thinkedit($config_path = './config/')
		{
				
				$config = new xml_parser();
				$config = $config->parse_folder($config_path);
				$this->config = $config['config'];
				
				
				//$this->configuration = new config();
				//return $config;
				
			
		}
		
		
		/************************* DB factory methods **************************/
		
		function connectToDb($id)
		{
				if (isset($this->config['site']['database'][$id]))
				{		
						$login = $this->config['site']['database'][$id]['login'];
						$password = $this->config['site']['database'][$id]['password'];
						$host = $this->config['site']['database'][$id]['host'];
						$database = $this->config['site']['database'][$id]['database'];
						$this->db_instance[$id] = new db($host, $login, $password, $database);
						return true;
				}
				else
				{
						trigger_error("no connect info found in config for db called '$id'");
						return false;
				}
				
				
		}
		
		
		/**
		* Returns a db instance ot be used anywhere. Usually, the main db is used, but multi db can be configure din config file
		*
		*
		**/
		function getDb($id='main')
		{
				if (isset($this->db_instance[$id]))
				{
						return $this->db_instance[$id];
				}
				else
				{
						if ($this->connectToDb($id))
						{
								return $this->db_instance[$id];
						}
						else
						{
								trigger_error('thinkedit::getDb() Cannot instantiate DB');
								return false;
						}
				}
		}
		
		
		
		
		
		/************************* Factory methods **************************/
		
		// based on uid, will instantiate a class
		function newObject($uid)
		{
				if (!isset($uid['class']))
				{
						trigger_error('thinkedit::newObject() $uid[\'class\'] not defined', E_USER_ERROR);
				}
				
				if (!isset($uid['type']))
				{
						trigger_error('thinkedit::newObject() $uid[\'type\'] not defined', E_USER_ERROR);
				}
				
				if ($uid['class'] == 'record')
				{
						if (isset($uid['id']))
						{
								return $this->newRecord($uid['type'], $uid['id']);
						}
						else
						{
								return $this->newRecord($uid['type']);
						}
						
				}
				elseif ($uid['class'] == 'node')
				{
						if (isset($uid['id']))
						{
								return $this->newNode($uid['type'], $uid['id']);
						}
						else
						{
								return $this->newNode($uid['type']);
						}
						
				}
				elseif ($uid['class'] == 'filesystem')
				{
						return $this->newFilesystem($uid['type'], $uid['id']);
				}
				
				else
				{
						trigger_error("thinkedit::newObject() class " . $uid['class'] . "not supported", E_USER_ERROR);
				}
		}
		
		
		
		/**
		* Given a table_name, instantiate a table
		**/
		function newTable($table_name)
		{
				// will include the right module class if needed, for example, specialized modules like ftp datasource
				// currently the base module is used
				if ($table_name<>'')
				{
						require_once('table.class.php');
						return new table($table_name);
				}
				else
				{
						trigger_error('thinkedit::newTable() $table_name empty');
				}
		}
		
		
		/**
		* Given a type and an id, instantiate a module
		* If no id given, instantiate a new empty module of type, using the right class for this module type
		*
		**/
		function newRecord($table, $id=false)
		{
				// will include the right module class if needed, for example, specialized modules like ftp datasource
				// currently the base module is used
				if ($table<>'')
				{
						require_once('record.class.php');
						$record = new record($table);
						if ($id)
						{
								$record->set('id', $id);
						}
						return $record;
				}
				else
				{
						trigger_error('thinkedit::newRecord() $table not defined');
				}
		}
		
		
		
		function newNode($table = "node", $id = false)
		{
				// will include the right module class if needed, for example, specialized modules like ftp datasource
				// currently the base module is used
				if ($table<>'')
				{
						
						require_once('node.class.php');
						$node = new node($table);
						
						
						// experimental optimized node class support :
						/*
						require_once('node_optimized.class.php');
						$node = new node_optimized($table);
						*/
						
						if ($id)
						{
								$node->setId($id);
						}
						return $node;
				}
				else
				{
						trigger_error('thinkedit::newNode() $table not defined');
						return false;
				}
				return false;
		}
		
		
		
		
		/**
		* Given an id and a path, instantiate a filesystem
		* id and path can be ommited
		*
		**/
		function newFilesystem($id='main', $path=false)
		{
				// will include the right module class if needed, for example, specialized modules like ftp datasource
				// currently the base module is used
				require_once('filesystem.class.php');
				return new filesystem($id, $path);
		}
		
		
		
		
		function newConfig()
		{
				$config = new config();
				return $config;
		}
		
		
		
		function newField($table, $field, $data = false)
		{
				
				if (isset($this->config['table'][$table]['field'][$field]))
				{
						if (isset($this->config['table'][$table]['field'][$field]['type']))
						{
								$type = $this->config['table'][$table]['field'][$field]['type'];
								
								// todo : class path management
								$file = ROOT . '/class/field.' . $type . '.class.php';
								$class = 'field_' . $type;
								
								if (file_exists($file))
								{
										require_once($file);
										return new $class($table, $field, $data);
								}
								else
								{
										trigger_error("thinkedit::newField config error, type $type for element $field not supported (class file not found)");
								}
								
						}
						else // we default for string if no type defined
						{
								require_once('element.string.class.php');
								return new element_string($module, $name, $data);
						}
						
				}
				trigger_error("thinkedit::newElement config error, type $name not found in config");
				
		}
		
		
		function newRelation()
		{
				require_once ROOT . '/class/relation.class.php';
				return new relation();
		}
		
		function newSession()
		{
				require_once ROOT . '/class/session.class.php';
				return new session();
		}
		
		
		/************************* TOOLS **************************/
		
		/**
		* Should be moved to user prefenrences and context for the site (editing) interface locale
		*
		*
		**/
		function getInterfaceLocale()
		{
				//die ('deprecated');
				return 'fr';
		}
		
		
		/**
		* Returns a list of available modules type in config
		*
		*
		**/
		function getTableList()
		{
				trigger_error('deprecated');
				trigger_error('deprecated, use config::getTableList() instead');
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
		
		
		
		function getHelp()
		{
				$help = $this->config['site']['help'][$this->getInterfaceLocale()];
				
				if (isset($help))
				{
						return $help;
				}
				else
				{
						trigger_error(translate('no_help_in_config'));
						return false;
				}
		}
		
		
		function getTitle()
		{
				$title = $this->config['site']['title'][$this->get_interface_locale()];
				if (isset($title))
				{
						return $title;
				}
				else
				{
						trigger_error(translate('no_title_in_config'));
						return false;
				}
		}
		
		
		function getRelationTable()
		{
				trigger_error('deprecated');
				return 'relation';
		}
		
		
		function getTable($table)
		{
				trigger_error('deprecated');
				// todo take it from config, currently returning what is asked raw
				return $table;
		}
		
		
		// returns root node id, could be made configurable to have more than one site in the same DB, with different roots
		function getRootNodeId()
		{
				trigger_error('deprecated');
				return 1;
		}
		
		
		function getRunMode()
		{
				if (isset($this->config['site']['run_mode']))
				{
						if ($this->config['site']['run_mode'] == 'development')
						{
								return 'development';
						}
						if ($this->config['site']['run_mode'] == 'production')
						{
								return 'production';
						}
				}
				return 'production';
						
		}
		
		/*
		Return true if we are in a live, production system.
		This is defined in config file.
		
		If true, we should not report any error to the user!
		*/
		function isInProduction()
		{
				if ($this->getRunMode() == 'production')
				{
						return true;
				}
				else
				{
				return false;
				}
		}
		
		
		
		
}


?>