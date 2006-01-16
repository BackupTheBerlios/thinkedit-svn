<?php
/*
See licence.txt for licence


The browser let's you browse anything from Thinkedit

With it you can easily select something and append it to a parent window

It will be used for 
- relations
- image fields
- add existing node


input : 

- start point / start content type
- limit to some content types ? 

- class
- type


other
- pages
- path (for filemanager)


What to do?
- execute javascript on parent window with UID
- return to / reload new page

*/

include_once('common.inc.php');

//check_user
check_user();

// check class
//$class = $url->get('class') or $session->get('class');
$class = $url->get('class');

// check type
$type = $url->get('type');

// display dropdown

$out['dropdown']['class']['data'][0]['title'] = ucfirst(translate('file'));
$url->set('class', 'file');
$out['dropdown']['class']['data'][0]['url'] = $url->render();
if ($class=='file')
{
		$out['dropdown']['class']['data'][0]['selected'] = true;
}

$out['dropdown']['class']['data'][1]['title'] = ucfirst(translate('table'));
$url->set('class', 'table');
$out['dropdown']['class']['data'][1]['url'] = $url->render();
if ($class=='table')
{
		$out['dropdown']['class']['data'][1]['selected'] = true;
}



$out['dropdown']['class']['data'][2]['title'] = ucfirst(translate('node'));
$url->set('class', 'node');
$out['dropdown']['class']['data'][2]['url'] = $url->render();
if ($class=='node')
{
		$out['dropdown']['class']['data'][2]['selected'] = true;
}



if ($class=='table')
{
		$config = $thinkedit->newConfig();
		$tables = $config->getTableList();
		foreach ($tables as $table)
		{
				$table_object = $thinkedit->newTable($table);
				$out['dropdown']['type']['data'][$table]['title'] = $table_object->getTitle();
				$url->set('class', 'table');
				$url->set('type', $table);
				$out['dropdown']['type']['data'][$table]['url'] = $url->render();
				if ($type==$table)
				{
						$out['dropdown']['type']['data'][$table]['selected'] = true;
				}
		}
}


debug($out, 'OUT');


if ($class=='table' && $type)
{
		$record = $thinkedit->newRecord($type);
		$records = $record->find();
		
		if ($records)
		{
				foreach ($records as $content)
				{
						$item['title'] = $content->getTitle();
						
						$item['url'] = $url->render('relation.php');
						
						$out['items'][] = $item;
				}
		}
}

// if class and type, display list

// execute

/*

$out['path'] =  'Test path';


if ($folders)
{
		$out['folders'] = $folders;
		$out['filters']['path'] = $folders;
		$out['filters']['path']['filter_name'] = 'path';
		$out['filters']['path']['data'][]['value'] = '/';
		$out['filters']['path']['data'][]['label'] = '/';
}


// handle icons for each file

$dir = dirname($_SERVER['PATH_TRANSLATED']) . "/icons/extensions";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) 
{
		$icon_name = get_file_filename($filename);
		if ($icon_name <> '') 	 $icons[] = $icon_name;
		
}


if ($files)
{
		
		
		$i=0;
		foreach ($files as $file)
		{
				$out['files'][$i]['filename'] = $file->filename;
				$out['files'][$i]['id'] = $file->id;
				
				$out['files'][$i]['extension'] = get_file_extension($file->filename);
				
				
				// handle image / non image file types (makes a link to thumbnail or not)
				if (in_array(get_file_extension($file->filename), $image_extensions))
				{
						$out['files'][$i]['is_image'] = true;
				}
				else
				{
						$out['files'][$i]['is_image'] = false;
						
						// if not an image, handle icon type
						if (in_array(get_file_extension($file->filename), $icons))
						{
								$out['files'][$i]['icon'] = get_file_extension($file->filename) . ".gif";
						}
						else
						{
								$out['files'][$i]['icon'] = "unknown.gif";
						}
						
				}
				
				
				
				
				$i++;
		}
}

*/


include('browser.template.php');

?>
