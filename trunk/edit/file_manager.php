<?php
/*
See licence.txt for licence

File manager manages files stored locally or not, dependig on the class used
*/

include_once('common.inc.php');

//check_user
check_user();

$filesystem = $thinkedit->newFilesystem();

// path is the current folder we are

if ($url->get('path'))
{
		$path = $url->get('path');
		$filesystem->setPath($path);
}


$out['path'] =  $filesystem->path;

// handle adding of a new file from http upload

// Check if we have afile uploaded

if ($_FILES['uploaded_file']['size'] > 0)
{
		
		if ($debug) echo $_FILES['uploaded_file']['tmp_name'];
		
		//safe filename
		$safe_filename = ereg_replace("[^a-z0-9._]", "",str_replace(" ", "_",str_replace("%20", "_", strtolower($_FILES['uploaded_file']['name']))));
		
		
		$server->put( $_FILES['uploaded_file']['tmp_name'], $safe_filename);
		
		// we added a file, we need to sync
		$sync = true;
		
}


// handle deletion of a file on the ftp server

if ($_REQUEST['action'] == 'delete')
{
		$server->rm($_REQUEST['file_to_delete']);
		
		// we deleted a file, we need to sync
		$sync = true;
}


// build a list of folders (excluding cache and thumbnails folders / files)


$folders = $filesystem->getFolderListRecursive();

debug($folders, 'folders');

if ($folders)
{
		$url = new url();
		foreach ($folders as $folder)
		{
				$folder_out['path'] = $folder->getPath();
				$url->set('path', $folder->getPath());
				$folder_out['url'] = $url->render();
				$out['folders'][] = $folder_out;
		}
		
}



// handle icons for each file

$dir = dirname($_SERVER['PATH_TRANSLATED']) . "/icons/extensions";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh)))
{
		$icon_name = get_file_filename($filename);
		if ($icon_name <> '') 	 $icons[] = $icon_name;
		
}

/*
print_a($icons);

die();
*/

// todo




// build a list of files in the current folder (excluding cache and thumbnails folders / files)

//$files = $db->get_results("select * from $table where path='$path' group by 'id' order by filename");
if ($debug) $db->debug();

if ($debug) print_a ($files);

if ($files)
{
		
		
		$i=0;
		foreach ($files as $file)
		{
				$out['files'][$i]['filename'] = $file->filename;
				$out['files'][$i]['id'] = $file->id;
				$out['files'][$i]['path'] = $file->path;
				
				$out['files'][$i]['url'] = $config['config']['module']['media']['public_path'] . $file->path . '/' . $file->filename;
				
				$out['files'][$i]['width'] = $config['config']['site']['thumbnails']['width'];
				$out['files'][$i]['height'] = $config['config']['site']['thumbnails']['height'];
				
				
				
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



// handle add folder


// handle remove folder

// handle sync with folder



// add breadcrumb

$out['breadcrumb'][1]['title'] = $config['config']['module'][$module]['title'][$interface_locale];
$out['breadcrumb'][1]['url'] = 'file_manager.php?module=' . $module;



debug($out, 'OUT');

//print_a($out);

// include template :
include('header.template.php');
include('file_manager.template.php');
//include('list.template.php');
include('footer.template.php');
?>
