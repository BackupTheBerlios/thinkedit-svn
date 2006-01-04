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

$url = new url();

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

$list = '';

/********************* home **********************/

if ($paths[0] == '')
{
		// we are home
		//echo 'home';
		//$item['title'] = translate('content');
		$item['title'] = translate('content');
		$item['path'] = '/content';
		$list[] = $item;
		
		$item['title'] = translate('structure');
		$item['path'] = '/structure';
		$list[] = $item;
		
		$item['title'] = translate('options');
		$item['path'] = '/options';
		$list[] = $item;
		
		$item['title'] = translate('help');
		$item['path'] = '/help';
		$list[] = $item;
		
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
										$list[] = $item;
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
						$list[] = $item;
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
		
		
		$content = $node->getContent();
		$content->load();
		//$url->set('path', '/structure/' . $node->getId());
		//$breadcrumb->add($content->getTitle(), $url->render());
		$breadcrumb->add($content->getTitle());
		
		
		if ($node->hasChildren())
		{
				$children = $node->getChildren();
				foreach ($children as $child)
				{
						$content = $child->getContent();
						$content->load();
						$item['title'] = $content->getTitle();
						
						$item['path'] = '/structure/' . $child->getId();
						
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
						$list[] = $item;
				}	 
		}
		
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

echo $breadcrumb->render();
/*
if (is_array($paths))
{
		foreach ($paths as $path_item)
		{
				$url->set('path', $path_item);
				echo '<a href="' . $url->render() . '">' . $path_item . '</a> / ';
		}
}
*/
// show content
echo '<hr>';

if (is_array($list))
{
		echo '<table>';
		foreach ($list as $item)
		{
				echo '<tr>';
				foreach ($item as $key=>$data)
				{
						if ($key=='title')
						{
								echo '<td>';
								if (isset($item['path']))
								{
										$url->set('path', $item['path']);
										echo '<a href="' . $url->render() . '">' . $data . '</a>';
								}
								else
								{
										echo $data;
								}
								echo '</td>';
						}
						
						if ($key=='actions')
						{
								echo '<td>';
								echo $data;
								echo '</td>';
						}
						
				}
				echo '</tr>';
		}
		echo '</table>';
}
else
{
		echo "empty";
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

echo $add_new; 


?>
