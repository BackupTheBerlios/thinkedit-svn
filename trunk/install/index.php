<?php
/*
Thinkedit Install Wizard

This wizard can be called more than once (in case of db schema upgrade for instance)

There are some mandatory actions that are to be done in a certain order. 
Each time a test passes, we go to the next without showin test resutl to user. 


This one will be purely procedural code for now, as the scope and use of it is not clearly defined


What the install template uses :

- info (form previous step most of the time)
- title
- help
- content
- form
- next_url
- previous_url

Input :
- step ?

*/
// reduce error reporting : the installer will generate notices by thinkedit, because it is not yet fully installed
// this is an egg and chicken problem
//error_reporting(E_ALL ^ E_NOTICE ^ E_USER_NOTICE); 

// init (note that init should work in all situations (even if db is down))
require_once '../thinkedit.init.php';


$url = $thinkedit->newUrl();

// Ask for simple admin password

// todo : security


// check general php and server environment
// if fatal problem, show info screen


// Is there a config file for db ?
// If not, show DB config screen

if (!isset($thinkedit->config['site']['database']['main']))
{
		// if form has been sent, update config
		if ($url->get('db_database'))
		{
				$config['site']['database']['main']['host'] = $url->get('db_host');
				$config['site']['database']['main']['database'] = $url->get('db_database');
				$config['site']['database']['main']['login'] = $url->get('db_login');
				$config['site']['database']['main']['password'] = $url->get('db_password');
				
				require_once ROOT . '/class/php_parser.class.php';
				$parser = new php_parser();
				
				$parser->save(ROOT . '/config/db.php', $config);
				$out['info'] = 'config file saved';
				include_once 'install.template.php';
				exit;
		}
		else
		{
				$out['title'] = 'Database setup';
				$out['help'] = 'Enter your database settings here';
				$out['content'] = '
				<form method="post">
				Host : <input type="text" name="db_host"> <br/>
				Database name : <input type="text" name="db_database"> <br/>
				Login : <input type="text" name="db_login"> <br/>
				Password : <input type="text" name="db_password"> <br/>
				
				<input type="submit">
				
				</form>
				';
				
				// include template :
				include_once 'install.template.php';
				exit;
		}
		
}


// Can we connect to DB ?
// If not, show DB config screen + connect error info

if (!$thinkedit->db->canConnect())
{
		// if form has been sent, update config
		if ($url->get('db_database'))
		{
				$config['site']['database']['main']['host'] = $url->get('db_host');
				$config['site']['database']['main']['database'] = $url->get('db_database');
				$config['site']['database']['main']['login'] = $url->get('db_login');
				$config['site']['database']['main']['password'] = $url->get('db_password');
				
				require_once ROOT . '/class/php_parser.class.php';
				$parser = new php_parser();
				
				$parser->save(ROOT . '/config/db.php', $config);
				$out['info'] = 'config file saved';
				include_once 'install.template.php';
				exit;
		}
		else
		{
				
				$out['title'] = 'I cannot connect to DB';
				$out['help'] = '(re)enter your database settings here, and ensure that the database exists and the login and password are ok';
				$out['content'] = '
				<form method="post">
				Host : <input type="text" name="db_host"> <br/>
				Database name : <input type="text" name="db_database"> <br/>
				Login : <input type="text" name="db_login"> <br/>
				Password : <input type="text" name="db_password"> <br/>
				
				<input type="submit">
				
				</form>
				';
		}
		// include template :
		include_once 'install.template.php';
		exit;
}




// is the DB schema up to date ?
// if not, show info message about what can be done + button to update schema

// Is there a user in the DB ?
// if not, show user add screen + button to add a user


// Is there a root Node ?
// if not, ask for a title for the root node, and add it

// is there something else to do ?
// if yes show it.
// if no : show congratulation screen

$out['title'] = 'Congratulations';
$out['help'] = 'It seems everything is ready to roll!';
$out['content'] = '
You can now start using thinkedit. Go to your root folder and see your site. You can also go to the admin interface.
Don\'t forget to return here if you change your database schema, your config files or if you upgrade. The process will be the same each time.
<p>Currently, it is better to delete the install folder. This is alpha software ;-)</p>		
		
';

// include template :
include_once 'install.template.php';
exit;





?>
