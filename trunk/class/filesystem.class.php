<?php

class filesystem
{
		
		function filesystem($id = main, $path = false)
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
				if (isset($this->config['path']))
				{
						$this->path = $this->config['path'];
				}
				
				// get path from parameter
				if ($path)
				{
						$this->path = $path; 
				}
				
				
				
				
				
		}
		
		
		function getChildren()
		{
				global $user;
				if ($user->hasPermission('view', $this))
				{
						if ($this->isFolder())
						{
								$this->handle = opendir($this->path);
								while (false !== ($file = readdir($this->handle))) 
								{
										if ($file <> '.' && $file <> '..')
										{
												$filesystem[] = new filesystem($this->id, realpath($this->path) . '/' . $file);
										}
								}
								if (is_array($filesystem))
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
				$uid['id'] = $this->path;
				return $uid;
		}
		
		function getTitle()
		{
				return $this->path;
		}
		
		
		function getFilename()
		{
				$path_parts = pathinfo($this->path);
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
								return file_get_contents($this->path);
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
								return file_get_contents($this->path);
						}
				}
		}
		
		function isFolder()
		{
				if (is_dir($this->path))
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
				$this->path = $path;
		}
		
		/*
		returns a full path to an icon representing this object
		*/
		function getIcon()
		{
				
		}
		
}
?>
