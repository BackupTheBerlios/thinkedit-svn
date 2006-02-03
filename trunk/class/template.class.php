<?php

class template
{
		
		function template($node=false)
		{
				if ($node)
				{
						$this->node = $node;
				}
				else
				{
						global $node;
						$this->node = $node;
				}
						
		}
		
		function mainMenu()
		{
				// bof ...
		}
		
		
}

?>
