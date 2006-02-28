<?php

/*

Publish field : this is a simple radio button menu with two options : 

o published
o unpublished

*/

require_once 'field.base.class.php'; 

class field_publish extends field
{
function renderUI()
		{
				$out='';
				
				$out .= '<label><input type="radio" name="' . $this->getName() . '" value="1">' . translate('published') . '</label><br/>';
				$out .= '<label><input type="radio" name="' . $this->getName() . '" value="0">' . translate('not_published') . '</label><br/>';
				
				return $out;
				
				// if 
				if ($this->get() == 1)
				{
						
				}
				else
				{
				}
				return $out;
				
		}

}
?>
