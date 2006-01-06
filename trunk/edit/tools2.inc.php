<?php


function redirect($page)
{
header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/".$page);
}

function get_file_extension($filename)
{
return strtolower(end(explode('.', $filename)));
}
			
			
function get_file_filename($filename)
{
$tmp = explode('.', $filename);
return strtolower($tmp[0]);
}

							 
?>
