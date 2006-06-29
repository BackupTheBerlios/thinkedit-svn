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
		
		/**
		* Adds the item to the clipboard, and marks it for "move" (deletion) if (and only if) it is pasted somewhere
		*/
		function cut($source)
		{
				
		}
		
		/**
		* Adds an item to the clipboard. It won't be moved (nor deleted), but copied, when pasted
		*/
		function copy($source)
		{
		}
		
		/**
		* Move cuted items
		* Add a new parent to copied items
		*/
		function paste($target)
		{
		}
		
		
		/**
		* Clear the clipboard
		*/
		function clear()
		{
		}
		
		
		/**
		* Returns an array of clipboard content items
		* or false if empty
		*/
		function getContent()
		{
		}
		
}

?>
