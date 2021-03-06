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
		$url = new url();
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
				
				// todo move style sheet somewhere, but this one is common to all designs, and designs author can what they want
				$out .= '
				<style>
				.admin_toolbox
				{
						position: absolute;
						position: fixed;
						top: 1em;
						right: 1em;
						width: 8em;
						background-color : white;
						padding: 1em;
				}
				
				.admin_toolbox_button
				{
						background-color : #0080ff;
						/*margin: 5px;*/
						padding: 5px;
						display: block;
						text-decoration: none;
						color: white;
				}
				
				</style>
				';
				
				$out .= '<div class="admin_toolbox">';
				$url = new url();
				$url->keep('node_id');
				$url->set('refresh', 1);
				$out .= '<br/>';
				$out .= '<a href="' . $url->render() . '" class="admin_toolbox_button">'. te_translate('refresh') .'</a>';
				
				$url = new url();
				$url->keep('node_id');
				$url->set('clear_cache', 1);
				$out .= '<br/>';
				$out .= '<a href="' . $url->render() . '" class="admin_toolbox_button">'. te_translate('clear_cache') .'</a>';
				
				$url = new url();
				$url->keep('node_id');
				$out .= '<br/>';
				$out .= '<a href="' . $url->render('./edit/structure.php') . '" target="_blank" class="admin_toolbox_button">'. te_translate('edit') .'</a>';
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
function te_short($string, $size)
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

?>
