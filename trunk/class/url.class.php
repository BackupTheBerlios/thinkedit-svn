<?php



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
		$this->keepParam('table');
		//$this->keepAll();
	}
	
	/*
	use this to add a parameter to an url
	*/
	function setParam($id, $value)
	{
		$this->param[$id] = $value;
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
	function unSetParam($id)
	{
		unset($this->param[$id]);
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
	
	
	function redirect($filename = false)
	{
		header('location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/'. $this->render($filename));
	}
	
	
	
	
	
}




?>