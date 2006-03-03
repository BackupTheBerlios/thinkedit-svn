<?php
/* 
Thinkedit template functions
*/


// this is a sample
/*
function te_link($ressource)
{
		return ROOT_URL . $ressource;
}
*/


function te_title()
{
		global $content;
		return $content->getTitle();
}

function te_design()
{
		global $thinkedit;
		$configuration = $thinkedit->newConfig();
		$design = $configuration->getDesign();
		return ROOT_URL . '/design/' . $design;
		
		
}


function te_link($object)
{
		$url = new url();
		if ($object->getType() == 'node')
		{
				$url->set('node_id', $object->getId());
				return $url->render();
		}
		else
		{
				trigger_error('te_link : object is not a node, not yet supported');
		}
}


?>
