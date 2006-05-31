<?php

require_once 'session.class.php';

class user
{
		
		function user()
		{
				//auto load from session
				global $thinkedit;
				$session = $thinkedit->newSession();
				
		}
		
		function login($login, $password)
		{
				if (empty($login) || empty($password))
				{
						trigger_error('user::login() password or login empty');
						return false;
				}
				else
				{
						global $thinkedit;
				  	$session = $thinkedit->newSession();
						
						$user = $thinkedit->newRecord('user'); // todo custom user table
						//$user->set('login', $login); // login and password must be primary keys (todo)
						//$user->set('password', $password);
						
						if ($user->find(array('login'=>$login, 'password'=>$password)))
						{
								$session = $thinkedit->newSession();
								$session->set('thinkedit_user', $login);
								return true;
						}
						else
						{
								$this->logout();
								//trigger_error('user::login() login failed');
								return false;
						}
				}
				
				
				
		}
		
		function logout()
		{
				global $thinkedit;
				$session = $thinkedit->newSession();
				return $session->delete('thinkedit_user');
				
		}
		
		function isLogged()
		{
				global $thinkedit;
				$session = $thinkedit->newSession();
				if ($session->get('thinkedit_user'))
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		function isAnonymous()
		{
				global $thinkedit;
				$session = $thinkedit->newSession();
				
				if ($session->get('thinkedit_user'))
				{
						return false;
				}
				else
				{
						return true;
				}
		}
		
		function hasPermission($permission, $object = false)
		{
				// todo : implement permission checking
				$debug['permission'] = $permission;
				$debug['uid'] = $object->getUid();
				$debug['result'] = true;
				//debug($debug, 'user::hasPermission'); 
				return true;
				//return false;
		}
		
		function isAdmin()
		{
				// todo security : implement permission system and update this.
				
				if ($this->isLogged())
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		
		
		function getLocale()
		{
				return 'fr';
		}
		
		
		
}


?>