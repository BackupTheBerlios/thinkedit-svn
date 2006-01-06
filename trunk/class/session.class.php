<?php

class session 
{
		
		function session () 
		{
				//session_start();
				if (!isset($_SESSION))
				{
						session_start();
				}
		}
		
		
		function set ($id,$value) 
		{
				$_SESSION[$id]=$value;
		}
		
		
		function get ($id) 
		{
				if ( isset ( $_SESSION[$id] ) )
				{
						return $_SESSION[$id];
				}
				else
				{
						return false;
				}
		}
		
		
		function delete($id) 
		{
				if ( isset ( $_SESSION[$id] ) ) 
				{
						unset ( $_SESSION[$id] );
						return true;
				} 
				else 
				{
						return false;
				}
		}
		
		
		
		function destroy () 
		{
				session_destroy();
		}
		
		
		
		/* 
		Given an $object, it will persist it. The object must implement :
		getIt()
		getSettings -> array
		setSettings <- array
		*/
		function persist(&$object)
		{
				if ( method_exists($object, 'getId') and method_exists($object, 'getSettings') and method_exists($object, 'setSettings') )
				{
						$object_id = $object->getId();
						$object_settings = $object->getSettings();
						$saved_settings = $this->get($object_id);
						
						if (is_array($object_settings))
						{
								$result = array_merge($saved_settings, $object_settings);
						}
						else
						{
								$result = $saved_settings;
						}
						if (is_array($result))
						{
								$this->set($id, $result);
								$object->setSettings($result);
						}
						
						debug($result, 'results from array merge');
						debug($_SESSION, 'Session data');
						return true;
				}
				else
				{
						trigger_error('session::persist() the object you try to persist doesn\'t provide the persistence API, getId, get- and setSettings()');
				}
				
		}
		
}
?>