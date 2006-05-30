<?php
/*
Thinkedit clipboard

It will keep in a session the node id that is in the clipboard and will paste it when requested (add a new emplacement, or change parent)

Input :
- source_node (for cut and copy)
- target_node (for paste)
- action (cut,copy,paste)
- node_id

Output :
Simple translated messages in clear text, to be shown inside an iframe (status bar)

*/

include_once('common.inc.php');

//check_user
check_user();


$session = $thinkedit->newSession();

if ($url->get('action') == 'cut')
{
		if ($url->get('source_node'))
		{
				$session->set('clipboard_source_node', $url->get('source_node'));
				$session->set('clipboard_action', 'cut');
				$out['info'] = translate('node_cut_ok');
		}
		else
		{
				$out['info'] = translate('node_cut_failed');
		}
		
}


if ($url->get('action') == 'paste' && $url->get('target_node'))
{
		
		$session = $thinkedit->newSession();
		if ($session->get('clipboard_source_node'))
		{
				$source_node = $thinkedit->newNode();
				$source_node->set('id', $session->get('clipboard_source_node'));
		}
		else
		{
				$out['info'] = translate('no_node_in_clipboard');
				echo $out['info'];
				die();
		}
		
		$target_node = $thinkedit->newNode();
		$target_node->set('id', $url->get('target_node'));
		
		if ($session->get('clipboard_action') == 'cut')
		{
				// we have to change the parent of source node to target_node
				
				if ($source_node->changeParent($target_node->getId()))
				{
						$out['info'] = translate('node_paste_ok');
				}
				else
				{
						$out['info'] = translate('node_paste_failed');
				}
		}
		else
		{
				$out['info'] = translate('unknown_clipboard_action');
				echo $out['info'];
				die();
		}
		
		
}



echo $out['info'];

?>


