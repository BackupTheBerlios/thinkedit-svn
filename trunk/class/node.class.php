<?php
require_once ('record.class.php');


/*
Node base class
*/

class node extends record 
{
	
	/**
	* Node object constructor.
	*
	*
	**/
	function node()
	{
		// init a record with a tablename = 'node' 
		parent::record('node');
		
	}
	
	
	/**
	* Returns the table name of the node table
	*
	*
	**/

	

	

	
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
		$this->load();
		// todo : returns a node and not a record
		return $this->find(array('id'=>$this->get('parent_id')) );
	
	}
	

	
	

	
	
	/**
	* returns true if the node has childrens
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
		
		
		$this->load();
		// todo : returns a node and not a record
		return $this->find(array('parent_id'=>$this->get('id')) );
		
		
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
}


?>