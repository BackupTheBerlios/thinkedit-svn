<?php


class tree
{
	
	
	// $tree is the tree id defined in config file, so multiple trees are possible
	function tree($tree = 'main')
	{
		$this->tree = $tree;
		global $thinkedit;
		
		//init config
		if (isset($thinkedit->config['tree'][$this->tree]))
		{
			$this->config = $thinkedit->config['tree'][$this->tree];
		}
		else
		{
			trigger_error('tree::tree() tree not defined in config');
		}
		
		// init table class for db access
		if (isset($this->config['table']))
		{
			$this->table = $thinkedit->newTable($this->config['table']);
		}
		else
		{
			trigger_error('tree::tree() cannot find tree table name in config file');
		}
		
	}
	
	function setNodeId($node_id)
	{
		$this->node_id = $node_id;
	}
	
	function setType($type)
	{
		$this->type = $type;
	}
	
	
	function setName($name)
	{
		$this->name = $name;
	}
	
	function setUid($uid)
	{
		$this->uid = $uid;
	}
	
	
	function getParent()
	{
	}
	
	
	// returns a list of tree objects or false if no child found
	function getChildren()
	{
		// do we have a node id?
		if (isset($this->node_id))
		{
			$id = $this->node_id;
		}
		else
		{
			$id = 1;
			trigger_error('tree::getChildren() no node id defined, assuming root or 1');
		}
		
		
		// currently php4 will do a copy for us
		$table = $this->table;
		
		$table->filter('parent', '=', $id);
		
		if ($table->count() > 0)
		{
			$records = $table->select();
			foreach ($records as $record)
			{
				$tree = new tree($this->tree);
				$tree->node_id = $record->field['id']->get();
				$tree->uid = $record->field['uid']->get();
				$tree->name = $record->field['name']->get();
				$tree->type = $record->field['type']->get();
				$list[] = $tree;
			}
			return $list;
		}
		else
		{
			return false;
		}
	}
	
	
	//takes a tree and adds it to this one
	function addChild($tree)
	{
		global $thinkedit;
		// do we have a node id?
		if (isset($this->node_id))
		{
			$id = $this->node_id;
		}
		else
		{
			$id = 1;
			trigger_error('tree::addChild() no node id defined, assuming root or 1');
		}
		
		
		// currently php4 will do a copy for us
		$table = $this->table;
		$record = $thinkedit->newRecord($this->table->getTableName());
		
		$record->field['type']->set($tree->type);
		$record->field['name']->set($tree->name);
		$record->field['uid']->set($tree->uid);
		$record->field['parent']->set($id);
		
		if ($table->insert($record))
		{
			return true;
		}
		else
		{
			return false;
		}
		
		
	}
	
	function removeNode($node_id)
	{
	}
	
	
	function getObject()
	{
		global $thinkedit;
		if ($this->type == 'table')
		{
			$table = $thinkedit->newTable($this->name);
			$table->filter('id', '=', $this->uid);
			$records = $table->select();
			return $records;
		}
		else
		{
		trigger_error('tree::getObject() only table type is currently supported');
		}
	}
	
	
}

?>
