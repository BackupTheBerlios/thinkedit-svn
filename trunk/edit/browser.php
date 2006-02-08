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

- mode : mode defiens the way the browser will send back results.
if mode = relation :
will reload relation iframe


field : the field to update from caller, using javascript



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

if ($url->get('mode') == 'edit')
{
		$mode = 'edit';
		$url->keep('mode');
		$out['mode'] = 'edit';
}


if ($url->get('mode') == 'relation')
{
		$mode = 'relation';
		$url->keep('mode');
		$out['mode'] = 'relation';
}


// check type
$type = $url->get('type');


/*************************** First dropdown ***********/
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


/*************************** Table dropdown ***********/
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

/*************************** File dropdown ***********/

if ($class=='file')
{
		$filesystem = $thinkedit->newFilesystem();
		$folders = $filesystem->getFolderListRecursive();
		debug($folders, 'folders');
		if ($folders)
		{
				foreach ($folders as $folder)
				{
						$folder_out = '';
						$url->set('path', $folder->getPath());
						$url->set('class', 'file');
						$folder_out['title'] = $folder->getPath();
						$folder_out['url'] = $url->render();
						if ($folder->getPath() == $url->get('path'))
						{
								$folder_out['selected'] = 1;
						}
						$out['dropdown']['path']['data'][] = $folder_out;
				}
		}
}

/*************************** Files items ***********/

if ($class=='file' && $url->get('path'))
{
		$filesystem = $thinkedit->newFilesystem();
		$filesystem->setPath($url->get('path'));
		
		$childs = $filesystem->getFiles();
		
		if ($childs)
		{
				foreach ($childs as $child)
				{
						$item['title'] = $child->getFilename();
						$item['icon'] = $child->getIcon();
						$item['url'] = $url->render('browser.php'); // todo default (?)
						
						if ($mode == 'relation')
						{
								$url->addObject($child, 'target_');
								$url->set('action', 'relate');
								$item['url'] = $url->render('relation.php');
						}
						
						$out['items'][] = $item;
				}
		}
		
		
}


/*************************** Record items dropdown ***********/
if ($class=='table' && $type)
{
		$record = $thinkedit->newRecord($type);
		$records = $record->find();
		
		if ($records)
		{
				foreach ($records as $content)
				{
						$item['title'] = $content->getTitle();
						$url->addObject($content, 'target_');
						$item['url'] = $url->render('relation.php');
						if ($mode == 'relation')
						{
								$url->addObject($content, 'target_');
								$url->set('action', 'relate');
								$item['url'] = $url->render('relation.php');
						}
						
						
						$out['items'][] = $item;
				}
		}
}


debug($out, 'OUT');
include('browser.template.php');

?>
