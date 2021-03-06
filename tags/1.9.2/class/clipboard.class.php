<?php

/*
Clipboard
Use case:

We have a node, we put it in the clipboard : 

$clipboard->cut($node);
$clipboard->paste($other_node)


cut() puts the item reference in a session

paste() will add() the items cutted, and will change parents 


*/


class clipboard
{
		
		
		function clipboard()
		{
				global $thinkedit;
				$this->session = $thinkedit->newSession();
		}
		
		
		/**
		* Adds the item to the clipboard, and marks it for "move" (deletion) if (and only if) it is pasted somewhere
		*/
		function cut($source)
		{
				if ($source->getUid())
				{
						$clipboard_cut = $this->session->get('clipboard_cut');
						$clipboard_cut[] = $source->getUid();
						$this->session->set('clipboard_cut', $clipboard_cut);
						return true;
				}
				else
				{
						trigger_error('clipboard::cut() : $source has no getUid() method');
						return false;
				}
				
		}
		
		/**
		* Adds an item to the clipboard. It won't be moved (nor deleted), but copied, when pasted
		*/
		function copy($source)
		{
				if ($source->getUid())
				{
						$clipboard_copy = $this->session->get('clipboard_copy');
						$clipboard_copy[] = $source->getUid();
						$this->session->set('clipboard_copy', $clipboard_copy);
						return true;
				}
				else
				{
						trigger_error('clipboard::copy() : $source has no getUid() method');
						return false;
				}
		}
		
		/**
		* Move cuted items
		* Add a new parent to copied items
		*/
		function paste($target)
		{
				// check if $target is a node
				if ($target->getType() == 'node')
				{
						
						$clipboard_cut = $this->session->get('clipboard_cut');
						$clipboard_copy = $this->session->get('clipboard_copy');
				}
				else
				{
						trigger_error('clipboard::paste() $target must be a node');
						return false;
				}
		}
		
		
		/**
		* Clear the clipboard
		*/
		function clear()
		{
				$this->session->delete('clipboard_cut');
				$this->session->delete('clipboard_copy');
				return true;
		}
		
		
		/**
		* Returns an array of clipboard content items
		* or false if empty
		*/
		function getContent()
		{
				global $thinkedit;
				
				$clipboard_cut = $this->session->get('clipboard_cut');
				$clipboard_copy = $this->session->get('clipboard_copy');
				$clipboard_content = array_merge((array)$clipboard_cut, (array)$clipboard_copy);
				
				if (is_array($cliboard_content))
				{
						foreach ($clipboard_content as $clipboard_item)
						{
								$content[] = $thinkedit->newObject($content);
						}
						return $content;
				}
				else
				{
						return false;
				}
		}
		
}

?>
