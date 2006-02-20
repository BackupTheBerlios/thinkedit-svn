<?php


class field
{
		
		var $data;
		
		function field($table, $id, $data = false)
		{
				global $thinkedit;
				
				$this->table = $table;
				$this->id = $id;
				if ($data)
				{
						$this->set($data);
				}
				
				
				if (isset($thinkedit->config['table'][$table]['field'][$id]))
				{
						$this->config = $thinkedit->config['table'][$table]['field'][$id];
				}
				else
				{
						die('field::field() Field called "' . $this->id . '" not found in config, check table id spelling in config file / in code');
				}
		}
		
		
		
		
		function get()
		{
				return $this->data;
		}
		
		function getRaw()
		{
				return $this->data;
		}
	
		
		function set($data)
		{
				$this->data = $data;
		}
		
		function getId()
		{
				return $this->id;
		}
		
		function getName()
		{
				return $this->id;
		}
		
		
		function renderUI()
		{
				$out = '';
				$out .= sprintf('<input type="text" value="%s" name="%s", size="32">', $this->getRaw(), $this->getName());
				return $out;
		}
		
		function validate()
		{
				return true;
		}
		
		function getHelp()
		{
				global $thinkedit;
				if (isset($this->config['help'][$thinkedit->user->getLocale()]))
				{
						return $this->config['help'][$thinkedit->user->getLocale()];
				}
				else
				{
						return false;
				}
				
		}
		
		
		function getTitle()
		{
				;
				if (isset($this->config['title'][$thinkedit->user->getLocale()]))
				{
						return $this->config['title'][$thinkedit->user->getLocale()];
				}
				else
				{
						return ucfirst($this->getName());
				}
				
		}
		
		function isSortable()
		{
				return true;
		}
		
		function isPrimary()
		{
				if (isset($this->config['primary']))
				{
						if ($this->config['primary'] == 'true')
						{
								return true;
						}
				}
				return false;
		}
		
		function isTitle()
		{
				if (isset($this->config['is_title']))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		function getType()
		{
				if (isset($this->config['type']))
				{
						return $this->config['type'];
				}
				else
				{
						return false;
				}
		}
		
		
		
		
		function isEmpty()
		{
				if (empty($this->data))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		
		function useInView($view)
		{
				// enable by default title columns in list view
				if ($this->isTitle() && $view == 'list')
				{
						return true;
				}
				
				if (isset($this->config['use'][$view]))
				{
						if ($this->config['use'][$view] == true)
						{
								return true;
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

?>
