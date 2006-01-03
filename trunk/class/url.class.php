<?php

/*

Trouver un myen sûr de lier à un objet avec un uid qui est tableau de taille inconnue,
et de pouvoir mettre plusieurs objets dans le même url


on pourrait avoir

object_source comme préfix

avec un article ça donnerait :

object_source_id=1
object_source_type=article
object_source_class=record

s'il était multilingue, ça donnerait ceci en plus :
object_source_locale=en

du coup, 


url->getObject($prefix = false)
et

url->getObject('object_source_')
donnerait une instance de cet objet...
		
		Pourquoi pas ?


*/


class url
{
		var $url;
		var $param;
		var $self;
		
		
		/*
		we have three arrays :
		
		$this->orig_param : parameters found in the current url
		$this->keep : params user asked to keep in the current params
		$this->params : parameters defined by the user, that must be included, and overriding original parameters
		
		*/
		
		
		/*
		Constructor, will populate self filename and existing parameters
		*/
		function url()
		{
				// define a list of parameters automatically kepts across urls
				// todo : could be configurable DONE : $this->keepParam($id)
				//$keep_params = array('id', 'node', 'type', 'path', 'debug', 'module_id', 'node_id', 'module_type');
				foreach ($_REQUEST as $key=>$value)
				{
						$this->orig_param[$key] = $value;
				}
				$this->self = $_SERVER['PHP_SELF'];
				//$this->keepParam('debug');
				$this->keepParam('debug');
				//$this->keepParam('table');
				
				// those three parameters are what I call a GUID of a class
				$this->keepParam('action');
				$this->keepParam('class');
				$this->keepParam('type');
				$this->keepParam('id');
				$this->keepParam('node_id');
				
				
				//$this->keepAll();
		}
		
		
		
		// this is an alias
		function set($id, $value)
		{
				$this->setParam($id, $value);
		}
		
		
		function get($id)
		{
				return $this->getParam($id);
		}
		
		function getObject()
		{
				global $thinkedit;
				$class = $this->get('class');
				$type = $this->get('type');
				$id = $this->get('id');
				
				if ($class && $type && $id)
				{
						$uid['class'] = $class;
						$uid['type'] = $type;
						$uid['id'] = $id;
						return $thinkedit->newObject($uid);
				}
				else
				{
						trigger_error(__METHOD__ . ' cannot instantiate object from url');
						return false;
				}
		}
		
		function setArray($params)
		{
				foreach ($params as $key=>$value)
				{
						$this->set($key, $value);
				}
		}
		
		
		
		
		
		/*
		use this to add a parameter to an url
		*/
		function setParam($id, $value)
		{
				$this->param[$id] = $value;
		}
		
		/*
		use this to add a parameter to an url
		*/
		function setParamArray($values)
		{
				foreach ($values as $key=>$value)
				{
						$this->param[$key] = $value;
				}
		}
		
		/*
		retrieve existing param, looking first at user defined ones, than in the existing parameters found in the url
		*/
		function getParam($id)
		{
				/*
				if (isset($this->param[$id]))
				{
						return $this->param[$id];
				}
				*/
				//else
				if (isset($this->orig_param[$id]))
				{
						return $this->orig_param[$id];
				}
				else
				{
						return false;
				}
		}
		
		
		/*
		Keep an existing parameter when rendering an url
		*/
		function keepParam($param)
		{
				$this->keep[] = $param;
		}
		
		
		/*
		Keep all existing parameter when rendering an url
		*/
		function keepAll()
		{
				foreach ($this->orig_param as $key=>$value)
				{
						$this->keepParam($key);
				}
		}
		
		/*
		unset a user defined parameter
		*/
		function unsetParam($id)
		{
				if (isset($this->param[$id]))
				{
						
						unset($this->param[$id]);
				}
				if (isset($this->orig_param[$id]))
				{
						unset($this->orig_param[$id]);
				}
		}
		
		
		
		/*
		Render query string
		Private function
		*/
		function getQueryString()
		{
				$url = '';
				$final_param = '';
				// populate final_param list with original params, but only the ones we want to keep
				
				if (isset ($this->orig_param))
				{
						if (is_array ($this->orig_param))
						{
								foreach ($this->orig_param as $key=>$value)
								{
										if (is_array($this->keep))
										{
												if (in_array($key, $this->keep))
												{
														$final_param[$key] = $value;
												}
										}
								}
								
						}
				}
				
				
				
				
				// override with user defined ones
				if (is_array ($this->param))
				{
						foreach ($this->param as $key=>$value)
						{
								$final_param[$key] = $value;
						}
				}
				
				// render if we have params
				if (is_array($final_param))
				{
						$url.='?';
						foreach ($final_param as $key=>$value)
						{
								$url .= $key . '=' . $value . '&';
						}
				}
				
				
				return $url;
		}
		
		function setFilename($filename)
		{
				$this->self = $filename;
		}
		
		
		/*
		Render an url
		
		if filename is set, it is used instead of curent script filename
		*/
		function render($filename = false)
		{
				if ($filename)
				{
						$url = $filename;
				}
				else
				{
						$url = $this->self;
				}
				return $url . $this->getQueryString();
		}
		
		
		/*
		Links an object to an action
		
		The object should provide getUid()
		*/
		function linkTo($object, $filename)
		{
				if ($object->getUid())
				{
						$uid = $object->getUid();
						foreach ($uid as $key=>$value)
						{
								$this->set($key, $value);
						}
						if ($filename)
						{
								$url = $filename;
						}
						else
						{
								$url = $this->self;
						}
						return $url . $this->getQueryString();
				}
				else
				{
						return false;
				}
		}
		
		function redirect($filename = false)
		{
				header('location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/'. $this->render($filename));
		}
		
		
		/*
		
		function toPath($theURL)
		{
				global $WIMPY_BASE, $slash;
				$AtheFile = explode ("/", $theURL);
				$theFileName = array_pop($AtheFile);
				$AwimpyPathWWW = explode ("/", $WIMPY_BASE['path']['www']);
				$AtheFilePath = array_values (array_diff ($AtheFile, $AwimpyPathWWW));
				if($AtheFilePath)
				{
						$theFilePath = $slash.implode($slash, $AtheFilePath).$slash.$theFileName;
				} 
				else 
				{
						$theFilePath = implode($slash, $AtheFilePath).$slash.$theFileName;
				}
				return ($WIMPY_BASE['path']['physical'].$theFilePath);
		}
		
		function toUrl($local_path)
		{
				$slash = '/';
				$AtheFile = explode ($slash, $local_path);
				$theFileName = array_pop($AtheFile);
				$AwimpyPathFILE = explode ($slash, ROOT);
				$AtheFilePath = array_values (array_diff ($AtheFile, $AwimpyPathFILE));
				$thFileURL = implode("/", $AtheFilePath)."/".$theFileName;
				return ($WIMPY_BASE['path']['www']."$thFileURL");
		}
		*/
		
		
}




?>