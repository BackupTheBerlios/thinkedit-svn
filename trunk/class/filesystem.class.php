<?php

class filesystem
{
		
		function filesystem($id = 'main', $path = false)
		{
				$this->id = $id;
				
				// load config
				global $thinkedit;
				if (isset($thinkedit->config['filesystem'][$id]))
				{
						$this->config = $thinkedit->config['filesystem'][$id];
				}
				else
				{
						trigger_error('filesystem::filesystem() filesystem called "' . $id . '" not found in config, check filesystem id spelling in config file / in code');
				}
				
				
				// get path from config
				if (isset($this->config['root']))
				{
						$this->root = $this->config['root'];
				}
				else
				{
						//trigger_error('filesystem::filesystem() path not defined in config, using server document root instead');
						$this->root = $_SERVER['DOCUMENT_ROOT'];
				}
				
				
				if (isset($this->config['path']))
				{
						$this->path = $this->config['path'];
				}
				
				// get path from parameter
				if ($path)
				{
						$this->path = $path; 
				}
				
				
				
				// todo validate path
				
				
		}
		
		
		function getChildren()
		{
				global $user;
				if ($user->hasPermission('view', $this))
				{
						if ($this->isFolder())
						{
								$this->handle = opendir($this->getRealPath());
								while (false !== ($file = readdir($this->handle))) 
								{
										if ($file <> '.' && $file <> '..')
										{
												$filesystem[] = new filesystem($this->id, $this->getPath() . '/' . $file);
										}
								}
								if (isset($filesystem) && is_array($filesystem))
								{
										return $filesystem;
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
				}
		}
		
		
		/*
		will return children files of the curent folder
		*/
		function getFiles()
		{
				global $user;
				if ($user->hasPermission('view', $this))
				{
						$items = $this->getChildren();
						// todo returns only files
						if ($items)
						{
								foreach ($items as $item)
								{
										if (!$item->isFolder())
										{
												$list[] = $item;
										}
								}
						}
						
						if (isset($list))
						{
								return $list;
						}
						else
						{
								return false;
						}
						
				}
		}
		
		
		/*
		will return children files of the curent folder
		*/
		function getFolders()
		{
				global $user;
				if ($user->hasPermission('view', $this))
				{
						$items = $this->getChildren();
						// todo returns only files
						// todo returns only files
						if ($items)
						{
								foreach ($items as $item)
								{
										if ($item->isFolder())
										{
												$list[] = $item;
										}
								}
						}
						
						if (isset($list))
						{
								return $list;
						}
						else
						{
								return false;
						}
						
				}
		}
		
		function getAll()
		{
				global $user;
				if ($user->hasPermission('load', $this))
				{
						return $this->getChildren();
				}
		}
		
		
		
		function getUid()
		{
				$uid['class'] = 'filesystem';
				$uid['type'] = $this->id;
				$uid['id'] = $this->getPath();
				return $uid;
		}
		
		function getTitle()
		{
				return $this->getPath();
		}
		
		
		function getFilename()
		{
				$path_parts = pathinfo($this->getRealPath());
				return $path_parts['basename'];
		}
		
		function getContent()
		{
				global $user;
				if ($user->hasPermission('view', $this))
				{
						if ($this->isFolder())
						{
								return false;
						}
						else
						{
								return file_get_contents($this->getRealPath());
						}
				}
		}
		
		
		// will return an image class, with thumbnailing abilities
		function getImage()
		{
				global $user;
				if ($user->hasPermission('view', $this))
				{
						if ($this->isFolder())
						{
								return false;
						}
						else
						{
								// todo return image object or wathever
								return file_get_contents($this->getRealPath());
						}
				}
		}
		
		function isFolder()
		{
				if (is_dir($this->getRealPath()))
				{
						return true;
				}
				else
				{
						return false;
				}
				
		}
		
		
		function setPath($path)
		{
				if ($path)
				{
						// todo validate path
						$this->path = $path;
				}
		}
		
		
		function getPath()
		{
				// todo validate path
				return $this->path;
		}
		
		
		function getRealPath()
		{
				// todo validate path
				//debug($this->root . $this->path, 'Real path called');
				return $this->root . $this->path;
		}
		
		
		
		/*
		returns a full path to an icon representing this object
		*/
		function getIcon()
		{
				return '/ressource/image/icon/text-x-generic.png';	
		}
		
		
		function load()
		{
				return true;
		}
		
		
		function getFolderListRecursive($object = false, $list = false)
		{
				global $my_strange_list_123; // how to avoid global ?
				
				if ($object)
				{
						$folders = $object->getFolders();
				}
				else
				{
						$folders = $this->getFolders();
				}
				
				//global $list;
				if ($folders) 
				{
						//$list[] = $folders;
						foreach ($folders as $folder) 
						{
								$my_strange_list_123[] = $folder;
								$folder->getFolderListRecursive($folder, $list);
								
								
						}
						
				}
				//return (isset($list) ? $list : false);
				return (isset($my_strange_list_123) ? $my_strange_list_123 : false);
		} 
		
		
		
}
?>
