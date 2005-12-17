<?php
require_once 'field.base.class.php'; 

class field_id extends field
{
		
		function renderUI()
		{
				
				$out = '';
				
				//$out .= sprintf('<input type="text" value="%s" name="%s">', $this->getRaw(), $this->getName());
				$out .= $this->getName() . ' : ' . $this->get();
				$out .= ' (' . translate('edit_id_is_not_editable') .')';
				$out .='<input type="hidden" name="' . $this->getName() . '" value="' . $this->get() . '">';
				return $out;
		}
		
		
		function isPrimary()
		{
				return true;
		}
		
		function get()
		{
				
				if (!empty($this->data))
				{
						
						if (is_numeric($this->data))
						{
								return $this->data;
						}
						else
						{
								//trigger_error('field_id::get() :
								//trigger_error(__METHOD__ . ' id is not numeric');
						}
				}
				else
				{
						return false;
				}
				
		}
		
		
		
}
?>
