<?php
require_once 'field.base.class.php'; 


class field_string extends field
{

function renderUI($prefix = false)
	{
		$out = '';
		$out .= sprintf('<input type="text" value="%s" name="%s", size="64">', $this->getRaw(), $prefix . $this->getName());
		return $out;
	}
	


}
?>
