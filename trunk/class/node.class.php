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



GENERAL TODO : OPTIMIZE THIS

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
				$this->load();
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
		
		function getParentId()
		{
				$parent = $this->record->get('parent_id');
				if (isset($parent))
				{
						return $parent;
				}
				else
				{
						trigger_error('node::getParentId() no parent id found');
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
				
				if ($this->record->load())
				{
						$this->is_loaded = true;
						return true;
				}
				trigger_error('node::load() cannot load node');
				return false;
		}
		
		
		function save()
		{
				return $this->record->save();
		}
		
		
		function isSiblingOf($node)
		{
				$node->load();
				$this->load();
				if ($this->getParentId() == $node->getParentId())
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		
		function isChildOf($node)
		{
				$node->load();
				$this->load();
				if ($this->getParentId() == $node->getId())
				{
						return true;
				}
				else
				{
						return false;
				}
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
				$children =  $this->record->find(array('parent_id'=>$this->get('id')), array('sort_order' => 'asc') );
				
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
		
		
		function getSiblings()
		{
				$this->load();
				debug($this->get('parent_id'), 'Sibligns current parent ID');
				 
				
				$siblings =  $this->record->find(array('parent_id'=>$this->get('parent_id')), array('sort_order' => 'asc') );
				
				if ($siblings)
				{
						global $thinkedit;
						foreach ($siblings as $sibling)
						{
								$siblings_node[] = $thinkedit->newNode($this->table, $sibling->get('id'));
						}
						return $siblings_node;
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
		
		
		function getLevel()
		{
				$parents = $this->getParentUntilRoot(); // todo : optimize!
				
				if ($parents)
				{
						return count($parents);
				}
				else
				{
						return 0;
				}
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
		
		
		
		
		/*
		Return a list of all nodes in the right order (from $this node to last leaf)
		*/
		function getAllNodes($node_id = false, $level = false, $out = false)
		{
				if (!$level)
				{
						$level = 0;
				}
				global $thinkedit;
				$node = $thinkedit->newNode();
				
				if ($node_id)
				{
						$node->load($node_id);
				}
				else
				{
						$node = $this;
						$this->node_list[] = $node;
				}
				debug($node);
				if ($node->hasChildren())
				{
						$children = $node->getChildren();
						// display each child
						foreach  ($children as $child)
						{
								$this->node_list[] = $child;
								if ($level > 20)
								{
										trigger_error('menu::displayChildren() level higher than 20, infinite loop ?');
								}
								else
								{
										$this->getAllNodes($child->getId(), $level+1, $out);
								}
						}
				}
				
				return $this->node_list;
				
		}
		
		
		function getOrder()
		{
				return $this->record->get('sort_order');
		}
		
		function moveUp()
		{
				$this->load();
				// first find items before this one
				$siblings = $this->getSiblings();
				if ($siblings)
				{
						foreach ($siblings as $sibling)
						{
								$sibling->load();
								$sort_orders[] = $sibling->get('sort_order'); 
						}
				}
				
				rsort($sort_orders);
				
				debug($sort_orders, 'Sort Orders');
				
				if (is_array($sort_orders))
				{
						foreach ($sort_orders as $sort_order)
						{
								if ($sort_order < $this->get('sort_order'))
								{
										$higher_orders[] = $sort_order;
								}
						}
				}
				
				if (isset($higher_orders))
				{
						//echo '$higher_orders';
						//print_r ($higher_orders);
						
						
						// if we have 2 or more
						if (count($higher_orders) >= 2)
						{
								$a = $higher_orders[0];
								$b = $higher_orders[1];
								$new_order = $b + (($a - $b) / 2);
								//echo 'New order : ' . $new_order;
								
								
								$this->set('sort_order', $new_order);
								$this->save();
								return true;
						}
						else // if we have one, move top
						{
								return $this->moveTop();
						}
				}
				else
				{
						// if we have none
						// we are at top, do nothing
						trigger_error('node::moveUp() already on top');
				}
				
		}
		
		function moveDown()
		{
				$this->load();
				// first find items on the same level as this one
				$siblings = $this->getSiblings();
				if ($siblings)
				{
						foreach ($siblings as $sibling)
						{
								$sibling->load();
								$sort_orders[] = $sibling->get('sort_order'); 
						}
				}
				
				sort($sort_orders);
				
				debug($sort_orders, 'Sort Orders');
				
				if (is_array($sort_orders))
				{
						foreach ($sort_orders as $sort_order)
						{
								if ($sort_order > $this->get('sort_order'))
								{
										$higher_orders[] = $sort_order;
								}
						}
				}
				
				if (isset($higher_orders))
				{
						//echo '$higher_orders';
						//print_r ($higher_orders);
						
						
						// if we have 2 or more
						if (count($higher_orders) >= 2)
						{
								$a = $higher_orders[0];
								$b = $higher_orders[1];
								$new_order = $b + (($a - $b) / 2);
								//echo 'New order : ' . $new_order;
								
								
								$this->set('sort_order', $new_order);
								$this->save();
								return true;
								
						}
						else // if we have one, move top
						{
								return $this->moveTop();
						}
				}
				else
				{
						// if we have none
						// we are at top, do nothing
						trigger_error('node::moveUp() already on top');
				}
				
		}
		
		function moveBottom()
		{
				$this->load();
				// first find items before this one
				$siblings = $this->getSiblings();
				if ($siblings)
				{
						foreach ($siblings as $sibling)
						{
								$sibling->load();
								$sort_orders[] = $sibling->get('sort_order'); 
						}
				}
				
				rsort($sort_orders);
				
				debug($sort_orders, 'Sort Orders');
				
				if (is_array($sort_orders))
				{
				
						$new_order = $sort_orders[0] + 1;
						$this->set('sort_order', $new_order);
						$this->save();
						return true;
				}
		}
		
		function moveTop()
		{
				$this->load();
				// first find items before this one
				$siblings = $this->getSiblings();
				if ($siblings)
				{
						foreach ($siblings as $sibling)
						{
								$sibling->load();
								$sort_orders[] = $sibling->get('sort_order'); 
						}
				}
				
				sort($sort_orders);
				
				debug($sort_orders, 'Sort Orders');
				
				if (is_array($sort_orders))
				{
				
						$new_order = $sort_orders[0] - 1;
						$this->set('sort_order', $new_order);
						$this->save();
						return true;
				}
		}
		
		
}


?>
