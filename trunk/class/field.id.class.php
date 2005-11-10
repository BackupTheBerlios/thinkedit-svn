<?php
require_once 'field.base.class.php'; 

class field_id extends field
{
	
	function renderUI()
	{
		
		$out = '';
		
		//$out .= sprintf('<input type="text" value="%s" name="%s">', $this->getRaw(), $this->getName());
		$out .= $this->getName() . ' : ' . $this->getRaw();
		$out .= ' (' . translate('edit_id_is_not_editable') .')';
		$out .='<input type="hidden" name="' . $this->getName() . '" value="' . $this->getRaw() . '">';
		return $out;
	}
	
	
	function isPrimary()
	{
		return true;
	}
	
	
}
?>
