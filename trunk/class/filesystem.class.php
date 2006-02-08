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
				
				
				
				if (isset($this->config['path']))
				{
						$config_path = $this->config['path'];
				}
				else
				{
						trigger_error('filesystem:filesystem() : you must provide a path in filesystem config');
				}
				
				
				
				// get path from config
				if (isset($this->config['root']))
				{
						$this->root = $this->config['root'] . $config_path;
				}
				else
				{
						//trigger_error('filesystem::filesystem() path not defined in config, using server document root instead');
						$this->root = ROOT . $config_path;
				}
				
				
				// get path from parameter
				if ($path)
				{
						$this->path = $path; 
				}
				else
				{
						$this->path = '/';
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
										if (substr($file,0,1)!=".")
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
		
		function getExtension()
		{
				if ($this->isFolder())
				{
						return false;
				}
				else
				{
						$ext = substr(strrchr($this->getPath(), "."), 1);
						if (isset($ext))
						{
								return $ext;
						}
						else
						{
								return false;
						}
				}
		}
		
		
		function isImage()
		{
				if (in_array($this->getExtension(), array('png', 'jpeg', 'jpg', 'gif')))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		/*
		returns a full path to an icon representing this object
		*/
		function getIcon()
		{
				if ($this->isImage())
				{
						return ROOT_URL . '/lib/phpthumb/phpThumb.php?src=' . $this->getPath() . '&w=22&h=22'; // todo custom thumbnail width / height
				}
				else
				{
						return ROOT_URL . '/edit/ressource/image/icon/text-x-generic.png';
				}
		}
		
		
		function load()
		{
				return true;
		}
		
		
		/*
		Here is a simple directory walker class that does not use recursion.
	 ---- from http://be.php.net/readdir----
	 
		class DirWalker {
				function go ($dir) {
						$dirList[] = $dir;
						while ( ($currDir = array_pop($dirList)) !== NULL ) {
								$dir = opendir($currDir);
								while((false!==($file=readdir($dir)))) {
										if($file =="." || $file == "..") {
												continue;
										}
										
										$fullName = $currDir . DIRECTORY_SEPARATOR . $file;
										
										if ( is_dir ( $fullName ) ) {
												array_push ( $dirList, $fullName );
												continue;
										}
										
										$this->processFile ($file, $currDir);
								}
								closedir($dir);
						}
				}
				
				function processFile ( $file, $dir ) {
						print ("DirWalker::processFile => $file, $dir\n");
				}
		}
		*/
		
		function getFolderListRecursive($object = false, $list = false)
		{
				global $my_strange_list_123; // how to avoid global ?
				
				if ($object)
				{
						$folders = $object->getFolders();
				}
				else
				{
						// add current folder to the list
						$my_strange_list_123[] = $this;
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
		
		function addFile($name, $content)
		{
				if ($this->isFolder())
				{
						$filename = $this->getRealPath() . '/' . $name;
						
						// Let's make sure the file exists and is writable first.
						//if (is_writable($filename)) 
						//{
								
								// In our example we're opening $filename in append mode.
								// The file pointer is at the bottom of the file hence
								// that's where $somecontent will go when we fwrite() it.
								if (!$handle = fopen($filename, 'x')) 
								{
										trigger_error('filesystem::addFile() : ' . "Cannot write to file ($filename). Maybe it's already there?");
										return false;
								}
								
								// Write $somecontent to our opened file.
								if (fwrite($handle, $content) === FALSE) 
								{
										trigger_error('filesystem::addFile() : ' . "Cannot write to file ($filename)");
										return false;
								}
								
								//	echo "Success, wrote ($somecontent) to file ($filename)";
								
								fclose($handle);
								return true;
								
						//} 
						//else 
						//{
						//		trigger_error('filesystem::addFile() : ' . "The file $filename is not writable");
						//}
				}
				else
				{
						trigger_error('filesystem::addFile() : you can add a file only inside a folder');
						return false;
				}
		}
		
		function addFolder($name)
		{
				if ($this->isFolder())
				{
						return mkdir ($this->getRealPath() . '/' . $name);
				}
				else
				{
						trigger_error('filesystem::addFolder() : you can add a folder only inside a folder');
				}
		}
		
		
		/*
		Deletes this file or this folder
		*/
		function delete()
		{
				if ($this->isFolder())
				{
						trigger_error('filesystem::delete() not yet for folders. Do it manually with FTP or wathever');
						// todo : implement this ;-)
				}
				else
				{
						return unlink ($this->getRealPath());
				}
				
		}
		
		
}
?>
