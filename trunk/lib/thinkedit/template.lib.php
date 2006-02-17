<?php
/* 
Thinkedit template functions
*/


// this is a sample
function te_link($ressource)
{
		return ROOT_URL . $ressource;
}


function te_title()
{
		global $content;
		return $content->getTitle();
}

function te_design()
{
		// global $thinkedit;
		return ROOT_URL . '/design/yapaka';
		
}



?>
