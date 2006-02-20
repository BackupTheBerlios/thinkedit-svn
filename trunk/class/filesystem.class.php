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
				
				
				
				/*
				The goal is to set 2 variables :
				
				$this->root_path
				$this->root_url
				*/
				
				if (isset($this->config['root_url']))
				{
						$this->root_url = $this->config['root_url'];
				}
				else
				{
						trigger_error('filesystem:filesystem() : you must provide a root_url in filesystem config', E_USER_ERROR);
				}
				
				
				
				// get path from config
				if (isset($this->config['root_path']['relative']))
				{
						$this->root_path = ROOT_PATH . $this->config['root_path']['relative'];
				}
				else
				{
						trigger_error('filesystem::filesystem() root_path not defined in config', E_USER_ERROR);
						//$this->root = ROOT . $config_path;
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
				
				debug($this->path, 'path');
				
				if (!$this->isValidPath())
				{
						trigger_error('filesystem::filesystem() invalid path detected, exiting', E_USER_WARNING);
				}
				
		}
		
		
		function isValidPath()
		{
				$path = realpath($this->getRealPath());
				$root = realpath($this->root_path);
				
				/*
				echo 'path : ' . $path;
				echo '<br/>';
				echo 'root : '. $root;
				echo '<br/>';
				*/
				
				// todo security : is it totally safe ?
				// we check if the path is found within the root
				
				
				if (substr_count($path, $root) == 1)
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		
		function getChildren()
		{
				global $thinkedit;
				if ($thinkedit->user->hasPermission('view', $this))
				{
						if ($this->isFolder())
						{
								$this->handle = opendir($this->getRealPath());
								while (false !== ($file = readdir($this->handle))) 
								{
										if (substr($file,0,1)!=".")
										{
												// not needed, readdir gives only filenames :
												// $path_parts = pathinfo($file);
												// $filename = $path_parts['basename'];
												
												// handle 2 cases : either path is simply / and we don't append / at the beginning,
												// either it /something and we append a '/' before the file
												if ($this->getPath() <> '/')
												{
														$filesystem[] = new filesystem($this->id, $this->getPath() . '/' . $file);
												}
												else
												{
														$filesystem[] = new filesystem($this->id, $this->getPath() . $file);
												}
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
				global $thinkedit;
				if ($thinkedit->user->hasPermission('view', $this))
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
				global $thinkedit;
				if ($thinkedit->user->hasPermission('view', $this))
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
				global $thinkedit;
				if ($thinkedit->user->hasPermission('load', $this))
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
				if (!$this->isValidPath())
				{
						trigger_error('filesystem::filesystem() invalid path detected, exiting', E_USER_ERROR);
				}
				
				global $thinkedit;
				if ($thinkedit->user->hasPermission('view', $this))
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
				if (!$this->isValidPath())
				{
						trigger_error('filesystem::filesystem() invalid path detected, exiting', E_USER_ERROR);
				}
				
				global $thinkedit;
				if ($thinkedit->user->hasPermission('view', $this))
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
				//debug($this->root_url . $this->path, 'getpath called');
				//return $this->root_url . $this->path;
				return $this->path;
		}
		
		
		function getUrl()
		{
				// todo validate path
				//debug($this->root_url . $this->path, 'getpath called');
				//return $this->root_url . $this->path;
				return $this->root_url . $this->path;
		}
		
		function getRealPath()
		{
				// todo validate path
				debug($this->root_path . $this->path, 'Real path called');
				return realpath($this->root_path . $this->path);
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
						return ROOT_URL . '/lib/phpthumb/phpThumb.php?src=' . $this->getRealPath() . '&w=22&h=22'; // todo custom thumbnail width / height
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
				global $my_strange_list_123; // how to avoid global ? this is a todo
				
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
				$name = $this->safeFileName($name);
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
				$name = $this->safeFileName($name);
				
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
		
		
		// returns a safe filename (only alphanums, lowercase)
		function safeFileName($filename)
		{
				// from http://www.qanswered.com/q/1-Remove_All_Non-Alphanumeric_Characters_From_A_String_In_PHP.htm
				$filename = strtolower($filename);
				$filename=ereg_replace("[^a-z,A-Z,0-9,_,-,.]","",$filename);
				
				return $filename;
		}
		
		
}
?>
