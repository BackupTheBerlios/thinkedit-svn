<?php

require_once 'session.class.php';

class user
{
		
		function user()
		{
		}
		
		function login($login, $password)
		{
				global $thinkedit;
				
				// select from DB
				
				$user = $thinkedit->newRecord('user'); // todo custom user table
				$user->set('login', $login); // login and password must be primary keys (todo)
				$user->set('password', $password);
				
				if ($user->load())
				{
						return true;
				}
				else
				{
				return false;
				}
				
				
		}
		
		function logout()
		{
		}
		
		
		function hasPermission($permission, $object = false)
		{
				// todo : implement permission checking
				$debug['permission'] = $permission;
				$debug['uid'] = $object->getUid();
				$debug['result'] = true;
				//debug($debug, 'user::hasPermission'); 
				return true;
		}
		
		
		
		
		function getLocale()
		{
				return 'fr';
		}
		
		function isLogged()
		{
		}
		
}


?>