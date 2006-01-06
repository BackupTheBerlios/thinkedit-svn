<?php
/*
Yet another attempt ;-)

We work with grids and paths

if we receive a path, it is splitted
we act accordingly
and generate a list of items

Required :
$list[0]['title']


Optional :
$list[0]['path'] (if set, item is "visitable" or folderish if you prefer)
$list[0]['actions'] (if set, will add an action column or context menu)
$list[0]['icon'] (full path to icon)

Free form is also possible :
$list[0]['published']
$list[0]['author']

User can choose which column to display from the free form list
User can also sort (and filter?)




*/

// init
require_once 'thinkedit.init.php';
require_once ROOT . '/class/url.class.php';
require_once ROOT . '/class/breadcrumb.class.php';
require_once ROOT . '/class/grid.class.php';
require_once ROOT . '/class/html.class.php';


$url = new url();
$grid = new grid();

// init grid
$grid->addColumn('title', array('title'=>'Name'));
$grid->addColumn('type', array('title'=>'Type'));
$grid->addColumn('actions', array('title'=>'Actions'));

// init path
if (!$path = $url->get('path'))
{
		$path = '';
}
$path = trim($path, '/');
$paths = split('/', $path);
debug($paths, 'Paths found');

$breadcrumb = new breadcrumb();
$url->set('path', '/');
$breadcrumb->add(translate('homepage'), $url->render());

$out['list'] = '';

/********************* home **********************/

if ($paths[0] == '')
{
		// we are home
		//echo 'home';
		//$item['title'] = translate('content');
		$url->set('path', '/content');
		$item['title'] = $url->renderHref(translate('content'));
		$grid->add($item);
		
		
		$url->set('path', '/structure');
		$item['title'] = $url->renderHref(translate('structure'));
		$grid->add($item);
		
		
		$url->set('path', '/options');
		$item['title'] = $url->renderHref(translate('options'));
		$grid->add($item);
		
		$url->set('path', '/help');
		$item['title'] = $url->renderHref(translate('help'));
		$grid->add($item);
		
		
}
/********************* Content **********************/

elseif ($paths[0] == 'content')
{
		
		
		require_once(ROOT . '/class/config.class.php');
		$config = new config();
		if (isset($paths[1]))
		{
				$url->set('path', '/content');
				$breadcrumb->add(translate('content'), $url->render());
				$table_name = $paths[1];
				$breadcrumb->add($table_name);
				if ($config->tableExists($table_name))
				{
						$my_record = $thinkedit->newRecord($table_name);
						$records = $my_record->find();
						if (is_array($records))
						{
								foreach ($records as $record)
								{
										$item['title'] = $record->getTitle();
										$url->set('class', 'record');
										$url->set('type', $record->getTableName());
										$url->set('id', $record->getId());
										$item['actions'] = '<a href="' . $url->render('edit_record.php') . '" target="_blank">' . 'edit' . '</a>';
										//$item['path'] = '/content/' . $table->getTableName();
										$out['list'][] = $item;
								}	 
						}
				}
		}
		else
		{
				
				$breadcrumb->add(translate('content'));
				require_once(ROOT . '/class/config.class.php');
				
				$config = new config();
				$table_list = $config->getTableList();
				foreach ($table_list as $table)
				{
						$tables[] = $thinkedit->newTable($table);
				}
				
				foreach ($tables as $table)
				{
						$item['title'] = $table->getTitle();
						$item['path'] = '/content/' . $table->getTableName();
						$out['list'][] = $item;
				}
		}
}

/********************* structure **********************/
elseif ($paths[0] == 'structure')
{
		$url->set('path', '/structure');
		$breadcrumb->add(translate('structure'), $url->render());
		
		
		
		$node = $thinkedit->newNode();
		if (isset($paths[1]))
		{
				$node->load($paths[1]);
		}
		else
		{
				$node->loadRootNode();
		}
		
		
		
		
		// add parents node in breadcrumb
		$parents = $node->getParentUntilRoot();
		if (is_array($parents))
		{
				$parents = array_reverse($parents);
				foreach ($parents as $parent)
				{
						$content = $parent->getContent();
						$content->load();
						$url->set('path', '/structure/' . $parent->getId());
						$breadcrumb->add($content->getTitle(), $url->render());
						
						
				}
		}
		
		// last item in breadcrumb is current item
		$content = $node->getContent();
		$content->load();
		$breadcrumb->add($content->getTitle());
		
		
		if ($node->hasChildren())
		{
				$children = $node->getChildren();
				foreach ($children as $child)
				{
						$content = $child->getContent();
						$content->load();
						
						$url->set('path', '/structure/' . $child->getId());
						$item['title'] = $url->renderHref($content->getTitle());
										
						
						// todo check if item is foldersih
						/*
						if ($child->hasChildren())
						{
								$item['path'] = '/structure/' . $child->getId();
						}
						*/
						
						$url->set('node_id', $child->getId());
						$item['actions'] = '<a href="' . $url->render('edit_node.php') . '" target="_blank">' . 'edit' . '</a>';
						//$item['path'] = '/content/' . $table->getTableName();
						$grid->add($item);
				}	 
		}
		
		
		// build add dropdown
		
		
		$add_new = '<select OnChange="location.href=this.options[this.selectedIndex].value">';
		$add_new .= '<option>' . translate('add') . '</option>';
		
		$config = $thinkedit->newConfig();
		$tables = $config->getTableList();
		foreach ($tables as $table_id)
		{
				$url = new url();
				$table = $thinkedit->newTable($table_id);
				$url->set('class', 'record');
				$url->set('type', $table_id);
				$url->set('action', 'browse');
				$url->set('node_id', $node->getId());
				
				$add_new .= '<option value="'. $url->render('list.php') .'">' . $table->getTitle() . '</option>';
		}  
		$add_new .= '</select>';
		$out['add_dropdown'] = $add_new; 
		
		
		
}
/********************* help **********************/
elseif ($paths[0] == 'help')
{
		//echo 'help';
}

/********************* options **********************/
elseif ($paths[0] == 'options')
{
		//echo 'options';
}
else
{
		die ('not found');
}

/********************* breadcrumb **********************/

$out['breadcrumb'] = $breadcrumb->render();


debug($out, 'OUT');

include ROOT . '/template_admin/header.template.php';
include ROOT . '/template_admin/browser.template.php';
include ROOT . '/template_admin/footer.template.php';





?>
