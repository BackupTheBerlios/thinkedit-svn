<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier
*/

include_once('common.inc.php');
include_once('file_manager.config.php'); // defines the file extensions for images, normal files, and reserved files.

//check_user
check_user();

//we can use another filemanager id from the config if needed.
if (! $_REQUEST['module'])
{
error('I need a module id');
}
else
{
$filemanager_id = $_REQUEST['module'];
$module = $filemanager_id ;
}


if ($debug) print_a($_SESSION);

$element = $_REQUEST['element'];

$out['element'] = $_REQUEST['element'];

// path is the current folder we are

if ($_REQUEST['path'])
{
$path = $_REQUEST['path'];
$_SESSION[$module][$element]['path'] = $path;
}
elseif ($_SESSION[$module][$element]['path'])
{
$path = $_SESSION[$module][$element]['path'];
}
else
{
$path = '/';
}





// base path is the root of this ftp server
$base_path = $config['config']['module'][$filemanager_id]['base_path'];

// current path is the working path
$current_ftp_path = $base_path . $path;


$out['path'] =  $path;

// $table is used in sql queries to sync the db with local filesystem
$table = $config['config']['module'][$filemanager_id]['table'];



// build a list of folders (excluding cache and thumbnails folders / files)

$folders = $db->get_results("select distinct path from $table order by path");
if ($debug) $db->debug();

if ($debug) print_a ($folders);

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

/*
print_a($icons);

die();
*/

// todo




// build a list of files in the current folder (excluding cache and thumbnails folders / files)

$files = $db->get_results("select * from $table where path='$path' order by filename");
if ($debug) $db->debug();

if ($debug) print_a ($files);

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




if ($debug) print_a($out);
include('image_browser.template.php');

?>
