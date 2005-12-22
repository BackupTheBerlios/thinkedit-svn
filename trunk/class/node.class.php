<?php

/*
Node base class

I was thinking about extending the record object. Fianlly, I will use a proxy object (is it the right name for this)
$this->record contains the reocrd object used by this node.

I feel safer this way
*/
class node
{
  
  /**
  * Node object constructor.
  *
  *
  **/
  function node($table = 'node')
  {
	// init a record with a tablename = 'node'
	global $thinkedit;
	$this->record = $thinkedit->newRecord($table);
	$this->table = $table;
	
  }
  
  function setId($node_id)
  {
	return $this->record->set('id', $node_id);
  }
  
  
  function getId()
  {
	return $this->record->get('id');
  }
  
  
  function set($field, $value)
  {
	return $this->record->set($field, $value);
  }
  
  function get($field)
  {
	return $this->record->get($field);
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
	$this->record->load();
	// todo : returns a node and not a record
	$parent = $this->record->find(array('id'=>$this->record->get('parent_id')) );
	if ($parent)
	{
	  $parent_node = $thinkedit->newNode($this->table, $parent->get('id'));
	  return $parent_node;
	}
	else
	{
	  return false;
	}
	
	
  }
  
  
  
  function delete()
  {
	return $this->record->delete();
  }
  
  
  function load($node_id = false)
  {
	if ($node_id)
	{
	  $this->setId($node_id);
	}
	
	if (isset($this->is_loaded) && $this->is_loaded)
	{
	  return true;
	}
	elseif ($this->record->load())
	{
	  $this->is_loaded = true;
	  return true;
	}
	return false;
  }
  
  
  function save()
  {
	return $this->record->save();
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
	$children =  $this->record->find(array('parent_id'=>$this->get('id')) );
	
	if ($children)
	{
	  global $thinkedit;
	  foreach ($children as $child)
	  {
		$childs[] = $thinkedit->newNode($this->table, $child->get('id'));
	  }
	  return $childs;
	}
	else
	{
	  return false;
	}
  }
  
  
  function add($child_object)
  {
	if ($child_object->getUid())
	{
	  $uid = $child_object->getUid();
	  global $thinkedit;
	  $node = $thinkedit->newNode();
	  $node->set('object_class', $uid['class']);
	  $node->set('object_type', $uid['type']);
	  $node->set('object_id', $uid['id']);
	  $node->set('parent_id', $this->getId());
	  return $node->save();
	}
	else
	{
	  trigger_error('node::add() must be given an object with getUid() method', E_USER_ERROR);
	}
  }
  
  
  function getUid()
  {
	$uid['class'] = 'node';
	$uid['type'] = 'node';
	$uid['id'] = $this->getId();
	return $uid;
  }
  
  /*
  Returns the content object of this node
  */
  function getContent()
  {
	global $thinkedit;
	$this->load();
	$uid['class'] = $this->get('object_class');
	$uid['type'] = $this->get('object_type');
	$uid['id'] = $this->get('object_id');
	return $thinkedit->newObject($uid);
  }
  
}


?>