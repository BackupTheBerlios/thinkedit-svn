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
	}
	
	
	function connectToDb($id)
	{
		if (isset($this->config['site']['database'][$id]))
		{		
			$login = $this->config['site']['database'][$id]['login'];
			$password = $this->config['site']['database'][$id]['password'];
			$host = $this->config['site']['database'][$id]['host'];
			$database = $this->config['site']['database'][$id]['database'];
			$this->db[$id] = new db($host, $login, $password, $database);
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
		if (isset($this->db[$id]))
		{
			return $this->db[$id];
		}
		else
		{
			if ($this->connectToDb($id))
			{
				return $this->db[$id];
			}
			else
			{
				trigger_error('thinkedit::getDb() Cannot instantiate DB');
				return false;
			}
		}
	}
	
	
	/**
	* Using an ftp server to store remote files. TODO and move to a specific module management class, module.ftp.class.php
	*
	*
	**/
	function connectToFtp($id)
	{
	}
	
	
	
	// based on uid, will instantiate a class
	function newObject($uid)
	{
		
	}
	
	
	/**
	* Given a type and an id, instantiate a module
	* If no id given, instantiate a new empty module of type, using the right class for this module type
	*
	**/
	function newModule($type, $id=false)
	{
		// will include the right module class if needed, for example, specialized modules like ftp datasource
		// currently the base module is used
		if ($type<>'')
		{
			require_once('module.sql.class.php');
			return new module_sql($type, $id);
		}
		else
		{
			trigger_error('thinkedit::newModule() $type empty');
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
	function newRecord($table)
	{
		// will include the right module class if needed, for example, specialized modules like ftp datasource
		// currently the base module is used
		if ($table<>'')
		{
			require_once('record.class.php');
			return new record($table);
		}
		else
		{
			trigger_error('thinkedit::newRecord() $table not defined');
		}
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
	
	
	/**
	* Given a node id, instantiate a module of the right type and id
	* Assigns the node id to the module
	*
	**/
	function newNode($node_id)
	{
		trigger_error ('deprecated');
		$db = $this->getDb();
		$res = $db->query(sprintf("select * from node where id='%s'", $db->escape($node_id) ));
		
		if ($db->isError())
		{
			trigger_error('thinkedit::newModuleByNode() Db error, node selection');
		}
		elseif (is_array($res))
		{
			//debug($res);
			$module=$this->newModule($res[0]['module_type'], $res[0]['module_id']);
			$module->setNodeId($node_id);
			return $module;
		}
		else
		{
			trigger_error(translate('node_not_found'));
			return false;
		}
		
		
	}
	
	function newTree($tree_name)
	{
			require_once('tree.class.php');
			return new tree($tree_name);
	}
	
	function newConfig()
	{
		$config = new config();
		return $config;
	}
		
	
	
	function &newElement($module, $name, $data = false)
	{
		
		if (isset($this->config['module'][$module]['element'][$name]))
		{
			if (isset($this->config['module'][$module]['element'][$name]['type']))
			{
				$type = $this->config['module'][$module]['element'][$name]['type'];
				
				// todo : class path management
				$file = ROOT . '/class/element.' . $type . '.class.php';
				$class = 'element_' . $type;
				
				if (file_exists($file))
				{
					require_once($file);
					return new $class($module, $name, $data);
				}
				else
				{
					trigger_error("thinkedit::newElement config error, type $type for element $name not supported (class not found)");
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
					trigger_error("thinkedit::newElement config error, type $type for element $field not supported (class not found)");
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
	
	
	
	/**
	* Should be moved to user prefenrences and context for the site (editing) interface locale
	*
	*
	**/
	function getInterfaceLocale()
	{
		return 'fr';
	}
	
	
	
	
	
	/**
	* Returns a list of available modules type in config
	*
	*
	**/
	function getModuleList()
	{
		if (isset($this->config['module']))
		{
			foreach ($this->config['module'] as $module_id=>$module)
			{
				//$list[] = $this->new_module($module_id);
				$list[] = $module_id;
			}
			return $list;
		}
		else
		{
			trigger_error(translate('no_modules_in_config'));
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
	
	
	
	/**
	* Returns a list of available modules type in config
	*
	*
	**/
	function getTreeList()
	{
		if (isset($this->config['tree']))
		{
			foreach ($this->config['tree'] as $tree_id=>$tree)
			{
				$list[] = $tree_id;
			}
			return $list;
		}
		else
		{
			//trigger_error(translate('no_tree_in_config'));
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
		return 'relation';
	}
	
	
	function getTable($table)
	{
		// todo take it from config, currently returning what is asked raw
		return $table;
	}
	
	
	// returns root node id, could be made configurable to have more than one site in the same DB, with different roots
	function getRootNodeId()
	{
		return 1;
	}
	
	
}


?>