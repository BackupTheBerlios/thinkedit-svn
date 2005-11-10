<?php

/*
Node base class
*/

class node
{
	
	/**
	* Node object constructor. If an id is given, it will load the node with this id. Else a new node is implied.
	*
	*
	**/
	function node($id = false)
	{
		global $thinkedit;
		if (!$thinkedit)
		{
			trigger_error('node:node() global thinkedit class not found');
		}
		else
		{
			$this->thinkedit = $thinkedit;
		}
		
		
		if ($id)
		{
			$this->setNodeId($id);
		}
		
	}
	
	
	/**
	* Returns the table name of the node table
	*
	*
	**/
	function getNodeTableName()
	{
		// todo config parameter
		return 'node';
	}
	
	
	function getTitle()
	{
		trigger_error('node::getTitle() : don\'t call this function, a node doesn\'t have a title');
		return 'a node doesn\'t have a title';
	}
	
	
	
	/**
	* returns the id of this node, false if undefined
	*
	*
	**/
	function getNodeId()
	{
		if (isset($this->node_id))
		{
			return $this->node_id;
		}
		else
		{
			return false;
		}
	}
	
	
	
	function setNodeId($id)
	{
		$this->node_id = $id;
	}
	
	
	/**
	* returns the module id of this node
	*
	*
	**/
	function getModuleId()
	{
		$this->load();
		return $this->module_id;
		//return $this->getNodeId();
	}
	
	
	
	/**
	* sets the module id of this node
	*
	*
	**/
	function setModuleId($id)
	{
		$this->module_id = $id;
	}
	
	
	
	function getModuleType()
	{
		$this->load();
		return $this->module_type;
	}
	
	function setModuleType($type)
	{
		$this->module_type = $type;
	}
	
	
	function setParent($parent)
	{
	}
	
	
	
	function hasParent()
	{
		if ($this->getParent())
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	
	
	/**
	* returns nodes
	*
	*
	**/
	function getParent()
	{
		global $thinkedit;
		$db = $thinkedit->getDb();
		$res = $db->query("select * from " . $this->getNodeTableName() . " where id='" . $db->escape($this->getNodeId()) . "'");
		
		if ($db->isError())
		{
			trigger_error('node::getParent() DB error');
			return false;
		}
		
		if ($res[0]['parent_id'] > 0)
		{
			
			return new node($res[0]['parent_id']);
			/*
			// debug($res, 'res parent');
			$module = $thinkedit->newModuleByNodeId($res[0]['parent']);
			return $module;
			*/
		}
		
		return false;
		
		// debug($res);
	}
	
	
	/**
	* load form table, almost private function
	*
	*
	**/
	function load()
	{
		if ($this->is_loaded)
		{
			return true;
		}
		else
		{
			global $thinkedit;
			$db = $thinkedit->getDb();
			$res = $db->query("select * from " . $this->getNodeTableName()  . " where id='" . $db->escape($this->getNodeId()).  "'");
			
			if ($db->isError())
			{
				trigger_error('node::load() DB error');
				return false;
			}
			
			$this->setNodeId($res[0]['id']);
			$this->setModuleId($res[0]['module_id']);
			$this->setModuleType($res[0]['module_type']);
			
			$this->is_loaded = true;
			return true;
		}
		
	}
	
	
	
	function getParentRecursive()
	{
	}
	
	
	
	/**
	* Removes this node from the node hierarchy.
	* Doesn't delete the data from it, only the node attachment in the hierarchy
	*
	**/
	function removeNode()
	{
		if (!$this->getNodeId())
		{
			trigger_error('node::removeNode() no node id defined, won\'t even try to delete');
			return false;
		}
		
		// todo use root not fixed root id
		if ($this->getNodeId() == 1)
		{
			trigger_error('node::removeNode() node id is root (1), won\'t even try to delete');
			return false;
		}
		
		global $thinkedit;
		$db = $thinkedit->getDb();
		$res = $db->query(sprintf("delete from %s where id='%s'", $this->getNodeTableName(), $this->getNodeId() ) );
		
		if ($db->isError() )
		{
			trigger_error('node::removeNode() DB error');
			return false;
		}
		
		if ($res > 0)
		{
			return true;
		}
		else
		{
			trigger_error('node::removeNode() node not found thus not deleted (0 rows affected)');
			return false;
		}
		
		
	}
	
	function delete()
	{
		$this->removeNode();
	}
	
	
	/**
	* returns true if th enode has childrens
	*
	*
	**/
	function hasChildren()
	{
		if ($this->getChildren() )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	* returns childrens (nodes)
	*
	*
	**/
	function getChildren()
	{
		$db = $this->thinkedit->getDb();
		$childs = $db->query(sprintf("select * from %s where parent_id='%s'", $this->getNodeTableName(), $db->escape($this->getNodeId() ) ) );
		
		if ($db->isError())
		{
			trigger_error('node::getChilds() DB error');
			return false;
		}
		
		if (is_array($childs))
		{
			// debug($res, 'res parent');
			foreach ($childs as $child)
			{
				$nodes[] = new node ($child['id']);
			}
			return $nodes;
		}
		
		return false;
	}
	
	function addChild($child)
	{
		$child_id = $child->getId();
		$child_type = $child->getType();
		
		$parent = $this->getNodeId();
		
		if ($child_id and $child_type and $parent)
		{
			global $thinkedit;
			$db = $thinkedit->getDb();
			$res = $db->query(sprintf('insert into %s (parent_id, module_id, module_type) values (\'%s\', \'%s\' , \'%s\')', $this->getNodeTableName(), $parent, $child_id, $child_type ) );
			
			if ($db->isError())
			{
				trigger_error('node::getParent() DB error');
			}
		}
		else
		{
			trigger_error('Cannot addChild, id or type missing from given child, or $this item doesn\'t have a node id defined');
		}
		
	}
	
	function removeChild($child)
	{
		trigger_error('Not Implemented');
	}
	
	
	
	function hasSiblings()
	{
		trigger_error('Not Implemented');
	}
	
	function getSiblings()
	{
		trigger_error('Not Implemented');
	}
	
	
	function isRoot()
	{
		trigger_error('Not Implemented');
	}
	
	function saveAsRoot()
	{
		trigger_error('Not Implemented');
		die('not yet');
		$this->db->query("insert into node (id, parent, uid, type) values (?, ?, ?, ?)", array('0', '0', $this->getId(), $this->getType()));
		
	}
	
	
	
	function getModule()
	{
		if ($this->getModuleType() and $this->getModuleId() )
		{
			$module = $this->thinkedit->newModule($this->getModuleType(), $this->getModuleId());
			$module->node_id = $this->getNodeId();
			return $module;
		}
		else
		{
			return false;
		}
	}
	
}


?>