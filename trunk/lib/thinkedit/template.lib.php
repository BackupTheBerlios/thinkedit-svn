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
				trigger_error('te_link() : object is not a node, not yet supported');
				return false;
		}
}

function te_admin_toolbox()
{
		global $thinkedit;
		if ($thinkedit->user->isAdmin())
		{
				$out = '';
				
				$out .= '<div class="admin_toolbox">';
				$out .= 'Total Queries : ' . $thinkedit->db->getTotalQueries();
				$out .= '<br/>';
				$out .= 'Total time : ' . $thinkedit->timer->render();
				
				$url = new url();
				
				$url->keep('node_id');
				$url->set('refresh', 1);
				$out .= '<br/>';
				$out .= '<a href="' . $url->render() . '">Refresh</a>';
				
				$url = new url();
				$url->keep('node_id');
				$url->set('clear_cache', 1);
				$out .= '<br/>';
				$out .= '<a href="' . $url->render() . '">Clear cache</a>';
				$out .= '</div>';
				return $out;
		}
		else
		{
				return false;
		}
}


?>
