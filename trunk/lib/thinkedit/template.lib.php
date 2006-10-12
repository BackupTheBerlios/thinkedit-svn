<?php
/* 
Thinkedit template functions
*/


/************************ Content related functions **********************/


function te_title()
{
		global $content;
		return $content->getTitle();
}

function te_get($id)
{
		global $content;
		return $content->get($id);
}



function te_translate($id)
{
		return $id;
}


/*************************** Paths, urls, links *******************/
/*
Returns the url of the current design (usefull for linking to css or design images)
*/
function te_design()
{
		global $thinkedit;
		$configuration = $thinkedit->newConfig();
		$design = $configuration->getDesign();
		return ROOT_URL . '/design/' . $design;
}


// returns root node
function te_root()
{
		global $thinkedit;
		if (isset($thinkedit))
		{
				$node = $thinkedit->newNode();
				if (isset($node))
				{
						if ($node->loadRootNode())
						{
								return $node;
						}
				}
		}
		return false;
}


// returns a link to the root node
function te_root_link()
{
		return te_link(te_root());
}


// returns a link to the administrative view of the current page
function te_admin_link()
{
		global $node;
		if ($node)
		{
				return ROOT_URL . '/edit/structure.php?node_id=' . $node->getId();
		}
		else
		{
				return ROOT_URL . '/edit/structure.php';
		}
}


// returns a link to the edit view of the current page
function te_edit_link()
{
		global $node;
		if ($node)
		{
				return ROOT_URL . '/edit/edit.php?node_id=' . $node->getId();
		}
		else
		{
				return ROOT_URL . '/edit/structure.php';
		}
}



/*
Returns the local path of the current design (usefull for including design specific php files)
*/
function te_design_path()
{
		global $thinkedit;
		$configuration = $thinkedit->newConfig();
		$design = $configuration->getDesign();
		return ROOT . '/design/' . $design;
}


function te_link($object)
{
		global $thinkedit;
		$url = $thinkedit->newUrl();
		if ($object->getType() == 'node')
		{
				$url->set('node_id', $object->getId());
				return $url->render();
		}
		elseif ($object->getClass() == 'filesystem')
		{
				$url->keep('node_id');
				return $url->render($object->getUrl());
		}
		else
		{
				trigger_error('te_link() : object is not a node or a filesystem, not yet supported');
				return false;
		}
}

/*********** Menu handling template tags ***************/
/*
This functions returns an array if a menu exists or false if no menu is found.
The array is an array of menuitems objects, providing some methods
*/

// returns an array of menu items of the main menu
function te_main_menu()
{
		require_once ROOT . '/class/menu.main.class.php';
		//global $node;
		$menu = new menu_main();
		return $menu->getArray();
}

// returns a contextual menu
function te_context_menu()
{
		require_once ROOT . '/class/menu.context.class.php';
		global $node;
		$menu = new menu_context($node);
		return $menu->getArray();
}


// returns a child menu
function te_child_menu()
{
		require_once ROOT . '/class/menu.child.class.php';
		global $node;
		$menu = new menu_child($node);
		return $menu->getArray();
}


function te_breadcrumb_menu()
{
		require_once ROOT . '/class/menu.breadcrumb.class.php';
		global $node;
		$menu = new menu_breadcrumb($node);
		return $menu->getArray();
}

/**************************** UI widgets ***********************/

/*
Will render a locale chooser link list
*/
function te_locale_chooser()
{
		global $thinkedit;
		global $content;
		$out = '';
		if ($content->isMultilingual())
		{
				$url = $thinkedit->newUrl();
				$url->keep('node_id');
				$locales = $content->getLocaleList();
				foreach ($locales as $locale)
				{
						$url->set('locale', $locale);
						$out .= '[<a href="' . $url->render() . '">' . $locale . '</a>]';
						$out .= ' ';
				}
				return $out;
		}
		else
		{
				return false;
		}
}




function te_admin_toolbox()
{
		global $thinkedit;
		if ($thinkedit->user->isAdmin())
		{
				$out = '';
				
				// todo move style sheet somewhere, but this one is common to all designs, and designs author can do what they want with it
				$out .= '
				<style>
				
				.te_toolbar
				{
						margin: 0px;
						color: white;
						font-family: Verdana, Helvetica, Arial;
						font-size: 10px;
						background: #999;
						border: 1px solid;
						border-color: #FFFFFF #555454 #555454 #FFFFFF;
						border-right: 0px;
						height: 20px;
						bottom: 0;
						position: fixed;
				}
				.te_toolbar_logo
				{
						padding: 4px;
						padding-left: 8px;
						padding-right: 10px;
						float: left;
				}
				a.te_toolbar_button
				{
						color: white;
						text-decoration: none;
						float: right;
						padding: 4px;
						padding-left: 10px;
						padding-right: 10px;
						border-left: 1px solid;
						border-right: 1px solid;
						border-left-color: #CFCACA;
						border-right-color: #555454;
				}
				a.te_toolbar_button:hover
				{
						color: white;
						text-decoration: none;
						background-color: #777;
				}
				
				
				</style>
				';
				
				/*
				<div class="te_toolbar">
				<div class="te_toolbar_logo">
				<b>ThinkEDIT 1.9.1</b>
				</div>
				<a href=""  class="te_toolbar_button">Refresh</a>
				<a href=""  class="te_toolbar_button">Refresh all</a>
				<a href=""  class="te_toolbar_button">Edit</a>
				<a href=""  class="te_toolbar_button">Logout</a>
				</div>
				*/
				
				
				$out .= '<div class="te_toolbar">';
				
				$out .= '<div class="te_toolbar_logo">';
				$out .= '<b>ThinkEDIT</b>'; // todo add version number automagically
				$out .= '</div>';
				
				$url = new url();
				$url->keep('node_id');
				$url->set('refresh', 1);
				$out .= '<a href="' . $url->render() . '" class="te_toolbar_button">'. translate('refresh_page') .'</a>';
				
				$url = new url();
				$url->keep('node_id');
				$url->set('clear_cache', 1);
				$out .= '<a href="' . $url->render() . '" class="te_toolbar_button">'. translate('refresh_site') .'</a>';
				
				$url = new url();
				$url->keep('node_id');
				$out .= '<a href="' . $url->render('./edit/structure.php') . '" target="_blank" class="te_toolbar_button">'. translate('edit') .'</a>';
				$out .= '</div>';
				
				
				$out .= 'Total Queries : ' . $thinkedit->db->getTotalQueries();
				$out .= '<br/>';
				$out .= 'Total time : ' . $thinkedit->timer->render();
				
				
				
				global $db_debug;
				if (isset($db_debug))
				{
						if (!$thinkedit->isInProduction())
						{
								foreach ($db_debug as $sql)
								{
										$out .= "<li>{$sql}</li>";
								}
						}
						else
						{
								$out .= "<li>SQL not shown in production mode</li>";
						}
				}
				
				
				return $out;
		}
		else
		{
				return false;
		}
}


/************************ Tools / helpers *********************/

/*
Returns a short version of the string passed with [...] apended to it if the stirng is longer than size
*/
function te_short($string, $size=30)
{
		if (strlen($string) > $size)
		{
				return strip_tags((substr($string, 0, $size -4) . '...'));
		}
		return strip_tags($string);
}



function te_every($size)
{
		static $i;
		$i++;
		if (($i % $size) == 0)
		{
				return true;
		}
		else
		{
				return false;
		}
}

/*
Todo

function te_get_caller_context($levels='', $die=FALSE) 
{
		$debug = debug_backtrace();
		if ($levels == '') 
		{
				$levels = count($debug);//print count($debug);die();
		}
		$caller_context = '';
		$ctr = -1;
		while ($ctr < ($levels-1)) 
		{
				$ctr++;
				$caller_context = $debug[$ctr]["file"] . '::' . $debug[$ctr]["function"] . '::' . $debug[$ctr]["line"] . '==>' . "\n" . $caller_context;
		}
		$caller_context = trim($caller_context);
		$caller_context = preg_replace("/==>$/", '', $caller_context);
		$caller_context = preg_replace("/^::::==>/", '', $caller_context);
		$caller_context = preg_replace("/\/var\/www\/[a-z]+\.ookles\.net/", '.', $caller_context);
		print "\n\n\n\n$caller_context\n\n\n\n";
		if ($die) 
		{
				die('Died in function te_get_caller_context');
		}
}
*/


?>
