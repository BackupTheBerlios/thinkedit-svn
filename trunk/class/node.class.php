<?php

/*
Node base class

I was thinking about extending the record object. Fianlly, I will use a proxy object (is it the right name for this)
$this->record contains the reocrd object used by this node.

I feel safer this way


TODO : optimize number of sql queries needed.

Using the adjacency list model that evryone uses
More info at http://www.sitepoint.com/article/hierarchical-data-database/1
and at http://dev.mysql.com/tech-resources/articles/hierarchical-data.html

It could be simply doing a single query of the whole node db, store it in a var, and work from this.

Benchamrk is needed. Maybe do this for a tree smaller than x nodes

Too early optimisation is the root of all evil

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
				global $thinkedit;
				$this->record->load();
				// todo : returns a node and not a record
				$parent = $this->record->find(array('id'=>$this->record->get('parent_id')) );
				if ($parent)
				{
						$parent_node = $thinkedit->newNode($this->table, $parent[0]->get('id'));
						return $parent_node;
				}
				else
				{
						return false;
				}
				
				
		}
		
		
		
		function delete()
		{
				if ($this->hasChildren())
				{
						trigger_error('node::delete() cannot delete non empty nodes, please delete childs of this node first');
				}
				else
				{
						return $this->record->delete();
				}
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
		
		function loadRootNode()
		{
				return $this->load(1); // todo : configure or search where parent = 0 or config file for multiple sites in the same tree 
		}
		
		
		function isRoot()
		{
				if ($this->getId() == 1)
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		/*
		function getParentUntilRoot()
		{
				if ($this->hasParent())
				{
						$parent = $this->getParent();
						$parents[] = $parent;
				}
				else
				{
						return false;
				}
				$i = 0;
				while ($parent->hasParent())
				{
						$parent = $parent->getParent();
						$parents[] = $parent;
						$i++;
						if ($i > 20) // limit depth to 20 to avoid infinite loop, you never know what can go wrong
						{
								break;
						}
				}
				
				return $parents;
		}*/
		
		
		
		function getParentUntilRoot()
		{
				
				$temp = $this;
				$parents = false;
				$i = 0;
				while ($temp->hasParent())
				{
						
						$temp = $temp->getParent();
						$parents[] = $temp;
						$i++;
						if ($i > 20) // limit depth to 20 to avoid infinite loop, you never know what can go wrong
						{
								break;
						}
				}
				
				return $parents;
		}
		
		
		function debug()
		{
				return $this->record->debug();
		}
		
		
		/*
		Returns a list (array) of allowed items you can add inside this node
		*/
		function getAllowedItems()
		{
				// first let's say we can add anything
				
				global $thinkedit;
				$config = $thinkedit->newConfig();
				$tables = $config->getTableList();
				
				// all tables
				foreach ($tables as $table_id)
				{
						$table = $thinkedit->newTable($table_id);
						$item['class'] = 'record';
						$item['type'] = $table_id;
						$item['title'] = $table->getTitle();
						$items[] = $item;
						
				}
				
				$item['class'] = 'filesystem';
				$item['type'] = 'main';
				$item['title'] = translate('file');
				$items[] = $item;
				
				return $items;
		}
}


?>