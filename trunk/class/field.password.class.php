<?php
require_once 'field.base.class.php'; 


class field_password extends field
{
	
	function renderUI()
	{
		$out = '';
		$out .= sprintf('<input type="password" value="%s" name="%s">', $this->getRaw(), $this->getName());
		return $out;
	}
	
	
	function getNice()
	{
		return '*********';
	}
	
	
}
?>
