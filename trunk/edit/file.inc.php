<?php



function get_file_list($dirname, $sort, $extensions = FALSE)
{

global $debug;

  if(!$extensions)
  {
    //EXTENSIONS OF FILE YOU WANNA SEE IN THE ARRAY
    $extensions = array("jpg", "png", "jpeg", "gif");
  }

  $d = dir($dirname);
  //$files = array();
  $x=0;
  while($entry = $d->read()) {
    if ($entry != "." && $entry != "..")
    {
      if (!is_dir($dirname."/".$entry))
      {
        for ($i = 0; $i < count($extensions); $i++)
        {
          if (eregi("\.". $extensions[$i] ."$", $entry))
          {

            $filedate = filemtime($dirname."/".$entry);

            if ($sort=='name')
            {
              $files[$entry] = $entry;
            }
            if ($sort=='date')
            {
              $files[$entry] = $filedate;
            }

            //$files[]['filename']= $entry;
            //$files[]= $entry;
          }
        }
      }


    }
  }

  $d->close();


if ($debug) print_a($files);
	
  //if ($debug) print_a($files);
  if ($sort=='name')
  {
    asort($files);
  }

  if ($sort=='date')
  {
    arsort($files);
  }

if ($debug) print_a($files);

  return $files;

}


/*

//currently from php.net -> filemanagement functions -> users comments
function get_file_list($dirname, $extensoes = FALSE, $reverso = FALSE)
{
if(!$extensoes) //EXTENSIONS OF FILE YOU WANNA SEE IN THE ARRAY
$extensoes = array("jpg", "png", "jpeg", "gif");

$files = array();

$dir = opendir($dirname);

while(false !== ($file = readdir($dir)))
{
//GET THE FILES ACCORDING TO THE EXTENSIONS ON THE ARRAY
for ($i = 0; $i < count($extensoes); $i++)
{
if (eregi("\.". $extensoes[$i] ."$", $file))
{
$files[] = $file;
}
}
}

//CLOSE THE HANDLE
closedir($dir);

//ORDER OF THE ARRAY
if ($reverso) {
rsort($files);
} else {
sort($files);
}

return $files;
}

*/


?>
