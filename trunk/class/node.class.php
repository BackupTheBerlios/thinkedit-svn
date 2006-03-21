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
				if ($this->getId() == 1)
				{
						return false;
				}
				
				global $thinkedit;
				$this->load();
				// todo : returns a node and not a record
				$parent = $this->record->find(array('id'=>$this->record->get('parent_id')) );
				if ($parent)
				{
						$parent_node = $thinkedit->newNode($this->table, $parent[0]->get('id'), $parent[0]->getArray());
						return $parent_node;
				}
				else
				{
						return false;
				}
				
				
		}
		
		function getParentId()
		{
				trigger_error('getParentId() is it a usefull function ?');
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
						$result = $this->record->delete();
						$this->rebuild();
						return $result;
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
						//echo 'load record';
						$this->is_loaded = true;
						return true;
				}
				//trigger_error('node::load() cannot load node');
				return false;
		}
		
		
		function loadByArray($data)
		{
				foreach ($this->record->field as $field)
				{
						if (array_key_exists($field->getId(), $data))
						{
								$this->set($field->getId(), $data[$field->getId()]);
						}
						else
						{
								return false;
						}
				}
				$this->is_loaded = true;
				return true;
		}
		
		
		
		function save()
		{
				// todo, we must be safe with this !
				if ($this->get('parent_id') > -1)
				{
						return $this->record->save();
				}
				else
				{
						trigger_error('node::save() cannot save a node without parent id defined');
						return false;
				}
		}
		
		
		// rebuilds nested set tree from adjacency list tree.
		// from http://www.sitepoint.com/article/hierarchical-data-database/3
		function rebuild($parent_id = 0, $left = 1)
		{
				global $thinkedit;
				// the right value of this node is the left value + 1
				$right = $left+1;
				
				// get all children of this node
				$sql = 'SELECT id FROM ' . $this->table . ' WHERE parent_id=' . $parent_id . ' order by sort_order';
				
				$results = $thinkedit->db->select($sql);
				
				if (is_array($results))
				{
					foreach ($results as $result)
					{
						$right = $this->rebuild($result['id'], $right);
					}
				}
				
				// we've got the left value, and now that we've processed
				// the children of this node we also know the right value
				
				/***************** big todo ***************/
				// todo : update node level as well :
				
				$sql = 'UPDATE '. $this->table .' SET left_id='. $left .', right_id='.	$right .' WHERE id='. $parent_id;
				
				$thinkedit->db->query($sql);
				
				// return the right value of this node + 1
				return $right+1; 
				
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
		
		function isAncestorOf($node)
		{
				$node->load();
				$this->load();
				
				// handle the case of this is parent of $node
				if ($this->getId() == $node->get('parent_id'))
				{
						return true;
				}
				
				$parents = $node->getParentUntilRoot();
				if (is_array($parents))
				{
						foreach ($parents as $parent)
						{
								if ($this->getId() == $parent->get('parent_id'))
								{
										return true;
								}
						}
				}
				return false;
						
		}
		
		/**
		* returns true if the node has childrens
		*
		*
		**/
		function hasChildren($options = false)
		{
				global $thinkedit;
				
				if (!$thinkedit->context->enablePreview())
				{
						if ($this->getChildren($options))
						{
								return true;
						}
						else
						{
								return false;
						}
				}
				
				$this->load();
				$right = $this->get('right_id');
				$left = $this->get('left_id');
				
				$childs = ($right - $left - 1) / 2;
				
				if ($childs > 0)
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
		function getChildren($options = false)
		{
				//echo  'called get children<br>';
				$this->load();
				// todo : returns a node and not a record
				$where['parent_id'] = $this->get('id');
				
				global $thinkedit;
				
				if (!$thinkedit->context->enablePreview())
				{
						$where['publish'] = 1;
				}
				
				
				
				$children =  $this->record->find($where, array('sort_order' => 'asc') );
				
				if ($children)
				{
						global $thinkedit;
						foreach ($children as $child)
						{
								$childs[] = $thinkedit->newNode($this->table, $child->get('id'), $child->getArray());
						}
						return $childs;
				}
				else
				{
						return false;
				}
		}
		
		
		/*
		Returns all sub nodes of this node
		*/
		function getAllChildren()
		{
				global $thinkedit;
				$this->load();
				$left_id = $this->get('left_id');
				$right_id = $this->get('right_id');
				// this is critical function, so we use direct sql to be faster (no use of the record class here)
				// todo : check if it's faster this way
				$sql = "SELECT * FROM {$this->table} WHERE left_id BETWEEN {$left_id} AND {$right_id} ORDER BY left_id ASC;";
				
				$results = $thinkedit->db->select($sql);
				
				if (is_array($results))
				{
						foreach ($results as $result)
						{
								$nodes[] = $thinkedit->newNode($this->table, $result['id'], $result);
						}
						return $nodes;
						
				}
				else
				{
						return false;
				}
				
		}
		
		
		/*
		Returns an array of 
		*/
		function getFamilly()
		{
				global $thinkedit;
				$this->load();
				$parent_id = $this->get('parent_id');
				$id = $this->get('id');
				// this is critical function, so we use direct sql to be faster (no use of the record class here)
				// todo : check if it's faster this way
				$sql = "SELECT * FROM {$this->table} WHERE id = {$parent_id} or parent_id = {$parent_id} or parent_id = {$id} ORDER BY left_id ASC;";
				
				$results = $thinkedit->db->select($sql);
				
				if (is_array($results))
				{
						foreach ($results as $result)
						{
								$nodes[] = $thinkedit->newNode($this->table, $result['id'], $result);
						}
						return $nodes;
						
				}
				else
				{
						return false;
				}
		}
		
		function getSiblings($options = false)
		{
				$this->load();
				debug($this->get('parent_id'), 'Sibligns current parent ID');
				
				$where['parent_id'] = $this->get('parent_id');
				
				global $thinkedit;
				
				if (!$thinkedit->context->enablePreview())
				{
						$where['publish'] = 1;
				}
				
				
				$siblings =  $this->record->find($where, array('sort_order' => 'asc') );
				
				if ($siblings)
				{
						global $thinkedit;
						foreach ($siblings as $sibling)
						{
								/*
								echo $sibling->debug();
								echo '<hr>';
								*/
								$siblings_node[] = $thinkedit->newNode($this->table, $sibling->get('id'), $sibling['cache']);
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
						$results = $node->save();
						if ($results)
						{
								$node->moveTop();
								$this->rebuild();
								return $node;
						}
						else
						{
								trigger_error('node::add() failed saving node', E_USER_WARNING);
								return false;
						}
				}
				else
				{
						trigger_error('node::add() must be given an object with getUid() method', E_USER_ERROR);
						return false;
				}
		}
		
		
		function getUid()
		{
				$uid['class'] = 'node';
				$uid['type'] = 'node';
				$uid['id'] = $this->getId();
				return $uid;
		}
		
		
		// what's the status of this ?
		function getType()
		{
				return 'node';
		}
		
		function getClass()
		{
				return 'node';
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
				
				////
				/*
				$object = $thinkedit->newObject($uid);
				return $object;
				*/
				////
				
				
				// todo
				/// this is an optimization. Must be turned on, later...
				if ($this->get('cache') <> '')
				{
						$data = unserialize($this->get('cache'));
						//print_r($data);
						return $thinkedit->newObject($uid, $data);
				}
				else
				{
						$object = $thinkedit->newObject($uid);
						$object->load();
						if ($data = $object->getArray())
						{
								$cache = serialize($data);
								$this->set('cache', $cache);
								$this->save();
						}
						return $object;
				}
		}
		
		
		/*
		Must be called everytime the content attached to this node is updated
		*/
		function clearContentCache()
		{
				$this->set('cache', '');
				$this->save();
		}
		
		function getTitle()
		{
				$this->load();
				$content = $this->getContent();
				$content->load();
				$title = $content->getTitle();
				return $title;
		}
		
		
		function getIcon()
		{
				$content = $this->getContent();
				//$content->load();
				return $content->getIcon();
		}
		
		
		function loadRootNode()
		{
				
				$root = $this->record->find(array('parent_id' => 0));
				
				if ($root)
				{
						return $this->load($root[0]->getId());
				}
				else
				{
						if ($this->record->count() == 0)
						{
								trigger_error('node::loadRootNode() : no nodes found in db. Please create at least one node in admin', E_USER_WARNING);
								return false;
						}
						else
						{
						trigger_error('node::loadRootNode() : no nodes with parent_id = 0 found in db. Please create at least one node in admin', E_USER_WARNING);
						return false;
						}
				}
		}
		
		
		
		/*
		Create a root node using object as the content
		*/
		function saveRootNode($object)
		{
				
				if ($object->getUid())
				{
						$uid = $object->getUid();
						global $thinkedit;
						$node = $thinkedit->newNode();
						$node->set('object_class', $uid['class']);
						$node->set('object_type', $uid['type']);
						$node->set('object_id', $uid['id']);
						$node->set('parent_id', 0);
						$node->set('id', 1);
						$results = $node->record->insert();
						if ($results)
						{
								return $node;
						}
						else
						{
								trigger_error('node::saveRootNode() failed saving root node', E_USER_WARNING);
								return false;
						}
				}
				else
				{
						trigger_error('node::saveRootNode() must be given an object with getUid() method', E_USER_ERROR);
						return false;
				}
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
				global $thinkedit;
				$this->load();
				$left_id = $this->get('left_id');
				$right_id = $this->get('right_id');
				
				$sql = "SELECT * FROM {$this->table} WHERE left_id < {$left_id} AND right_id > {$right_id} ORDER BY level desc";
				
				$results = $thinkedit->db->select($sql);
				
				if (is_array($results))
				{
						foreach ($results as $result)
						{
								$nodes[] = $thinkedit->newNode($this->table, $result['id'], $result);
						}
						return $nodes;
						
				}
				else
				{
						return false;
				}
		}
		
		
		function updatePath()
		{
				$parents[] = $this;
				
				$parents_until_root = $this->getParentUntilRoot();
				
				if (is_array($parents_until_root))
				{
						foreach ($parents_until_root as $parent)
						{
								$parents[] = $parent;
						}
				}
				
				$parents = array_reverse($parents);
				
				$path = '.';
				
				foreach ($parents as $parent)
				{
						$path .= str_pad($parent->getId(), 5, '0', STR_PAD_LEFT) . '.';
						
				}
				$this->set('path', $path);
				$this->save();
				
				return $path;
		}
		
		function getPath()
		{
				$parents[] = $this;
				
				$parents_until_root = $this->getParentUntilRoot();
				
				if (is_array($parents_until_root))
				{
						foreach ($parents_until_root as $parent)
						{
								$parents[] = $parent;
						}
				}
				
				$parents = array_reverse($parents);
				$path = '/';
				
				foreach ($parents as $parent)
				{
						$content = $parent->getContent();
						$content->load();
						$path .= $content->getTitle() . '/';
				}
				
				return $path;
		}
		
		function getLevel()
		{
				if ($this->get('parent_id') == 0)
				{
						return 0;
				}
				
				$this->load();
				if ($this->get('level'))
				{
						return $this->get('level');
				}
				else
				{
						$parents = $this->getParentUntilRoot();
						if ($parents)
						{
								$level = count($parents);
						}
						else
						{
								$level = 0;
						}
						if ($this->load())
						{
								$this->set('level', $level);
								$this->save();
						}
						return $level;
				}
		}
		
		
		
		
		function debug()
		{
				return $this->record->debug();
		}
		
		
		/*
		Returns a list (array) of allowed items you can add inside this node
		this array is an array of UID's
		
		class / type / (id)
		
		*/
		function getAllowedItems()
		{
				$content = $this->getContent();
				
				if ($content)
				{
				// first let's say we can add anything
				if (isset($content->config['allowed_items']['record']))
				{
						foreach ($content->config['allowed_items']['record'] as $key=>$value)
						{
								$item['class'] = 'record';
								$item['type'] = $key;
								$items[] = $item;
						}
						return $items;
						
				}
				else
				{
						return false;
				}
				}
				else
				{
						return false;
				}
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
								// this IS a hack ;-). But else DB cache will keep the old order and it will be bad for getChildren (it will give previous order)
								// This took one hour to figure out...
								global $thinkedit;
								$db = $thinkedit->getDb();
								$db->clearCache();
								$this->rebuild();
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
				//echo  'called move down<br>';
				//echo 'order before move' . $this->getOrder();
				
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
								// echo 'order after move save' . $this->getOrder();
								// this IS a hack ;-). But else DB cache will keep the old order and it will be bad for getChildren (it will give previous order)
								// This took one hour to figure out...
								global $thinkedit;
								$db = $thinkedit->getDb();
								$db->clearCache();
								$this->rebuild();
								return true;
								
						}
						else // if we have one, move top
						{
								return $this->moveBottom();
						}
				}
				else
				{
						// if we have none
						// we are at top, do nothing
						trigger_error('node::moveDown() already on bottom');
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
						// this IS a hack ;-). But else DB cache will keep the old order and it will be bad for getChildren (it will give previous order)
						// This took one hour to figure out...
						global $thinkedit;
						$db = $thinkedit->getDb();
						$db->clearCache();
						$this->rebuild();
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
						// this IS a hack ;-). But else DB cache will keep the old order and it will be bad for getChildren (it will give previous order)
						// This took one hour to figure out...
						global $thinkedit;
						$db = $thinkedit->getDb();
						$db->clearCache();
						$this->rebuild();
						return true;
				}
		}
		
		
		function publish()
		{
				$this->record->set('publish', 1);
				return $this->record->save();
		}
		
		function unPublish()
		{
				$this->record->set('publish', 0);
				return $this->record->save();
		}
		
		function isPublished()
		{
				if ($publish = $this->record->get('publish'))
				{
						if ($publish == 1)
						{
								return true;
						}
						else
						{
								return false;
						}
				}
		}
		
		
		function useInNavigation()
		{
				// todo : configurable somewhat :-)
				
				if ($this->get('object_class') == 'record' && $this->get('object_type') == 'page')
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
