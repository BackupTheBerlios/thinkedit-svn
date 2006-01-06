<?php


/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier

File manager manages files stored on an ftp server and takes care of synching files to/form a db table
Uses pear's ftp class

example from config.xml :


outdated :
<filemanager id="main">
<host>localhost</host>
<user>*****</user>
<password>****</password>
<base_path>/htdocs/clients_projects/ollivero/images</base_path>
<table>media</table>
</filemanager>

New config taken from current config file :

<module id="medias">

<title>
<fr>Medias</fr>
</title>
<icon>oeuvre.gif</icon>
<help>
<fr>Medias utilisés sur le site</fr>
</help>

<title_row>filename</title_row>

<type>filemanager</type>
<host>localhost</host>
<user>***</user>
<password>***</password>
<base_path>/htdocs/clients_projects/ollivero/images</base_path>
<table>media</table>

<element id='filename'>
<type>filename</type>
</element>

</module>


minimal table structure (in the example above, in the table called "media" :

id (autoincrement)
filename
path
*/

include_once('common.inc.php');
include_once('file_manager.config.php'); // defines the file extensions for images, normal files, and reserved files.
//require_once 'Net_FTP.php';
require_once 'FTP.php';

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
}

// path is the current folder we are
if (! $_REQUEST['path']) $path = '/';

// base path is the root of this ftp server
$base_path = $config['config']['module'][$filemanager_id]['base_path'];

// current path is the working path
$current_ftp_path = $base_path . $path;



$out['path'] =  $path;

// $table is used in sql queries to sync the db with local filesystem
$table = $config['config']['module'][$filemanager_id]['table'];



if ($_REQUEST['action'] == 'sync') $sync=true;


// if we need to sync or add or delete a file, we need an ftp connection.
// this probably speeds up the interface, because we open an ftp conneciton only if needed
if ($sync or ($_FILES['uploaded_file']['size'] > 0) or ($_REQUEST['action'] == 'delete'))
{
  $server = new Net_FTP($config['config']['module'][$filemanager_id]['host']);
  $server->connect();
  $server->login($config['config']['module'][$filemanager_id]['user'], $config['config']['module'][$filemanager_id]['password']);

  if ($debug) echo $current_ftp_path;
  $server->cd($current_ftp_path);
}


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




// handle sync between ftp repository and sql db


if ($sync)
{

  $ftp_files = $server->ls('',NET_FTP_FILES_ONLY);

  $sql_files = $db->get_results("select filename from $table where path='$path' order by filename");

  foreach ($ftp_files as $ftp_file)
  {
    $file_is_reserved = false;
    foreach ($reserved_files as $reserved_file)
    {

      if (stristr ($ftp_file['name'], $reserved_file))
      {
        if ($debug) echo 'found reserved file : ' . $reserved_file . ' ' .$ftp_file['name'] . '<br>';
        $file_is_reserved = true;
      }
    }

    if (!$file_is_reserved)	$ftp_files_list[] =  $ftp_file['name'];


  }


  if (!$ftp_files_list) $ftp_files_list[0] = "dummy";



  foreach ($sql_files as $sql_file)
  {
    $sql_files_list[] =  $sql_file->filename;
  }

  if (!$sql_files_list) $sql_files_list[0] = "dummy";


  if ($debug) print_a ($sql_files_list);
  if ($debug) print_a ($ftp_files_list);


  foreach ($ftp_files_list as $ftp_file)
  {
    if (!in_array($ftp_file, $sql_files_list))
    {
      if ($debug) echo "$ftp_file not in sql <br>";
      $db->query("insert into $table (filename, path) values ('$ftp_file', '$path')");
    }
  }

  foreach ($sql_files_list as $sql_file)
  {
    if (!in_array($sql_file, $ftp_files_list))
    {
      if ($debug) echo "$sql_file not on ftp server <br>";
      $db->query("delete from $table where filename = '$sql_file' and path = '$path'");
    }
  }

}



// build a list of folders (excluding cache and thumbnails folders / files)

$folders = $db->get_results("select distinct path from $table order by path");
if ($debug) $db->debug();

if ($debug) print_a ($folders);

if ($folders)
{
  $out['filters']['path']['filter_name'] = 'path';
  $i=0;
  // $out['folders'] = $folders;

  // $out['filters']['path'] = $folders;
  foreach ($folders as $folder)
  {

    $out['filters']['path']['data'][$i]['value'] = $folder->path;
    $out['filters']['path']['data'][$i]['label'] = $folder->path;
    $i++;
  }
}


//
$out['element']['filename'] = 1;

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
    $out['data'][$i]['filename'] = $file->filename;
    $out['data'][$i]['id'] = $file->id;

    $out['data'][$i]['extension'] = get_file_extension($file->filename);


    // handle image / non image file types (makes a link to thumbnail or not)
    if (in_array(get_file_extension($file->filename), $image_extensions))
    {
      $out['data'][$i]['is_image'] = true;
    }
    else
    {
      $out['data'][$i]['is_image'] = false;

      // if not an image, handle icon type
      if (in_array(get_file_extension($file->filename), $icons))
      {
        $out['data'][$i]['icon'] = get_file_extension($file->filename) . ".gif";
      }
      else
      {
        $out['data'][$i]['icon'] = "unknown.gif";
      }

    }




    $i++;
  }
}



// handle add folder


// handle remove folder





if ($debug) print_a($out);

//print_a($out);

// print_a($_SERVER);

// include template :
include('header.template.php');
// include('file_manager.template.php');

include('list.template.php');

include('footer.template.php');
?>
