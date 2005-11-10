<?php
require_once 'field.base.class.php'; 

class field_text extends field
{
	
	function renderUI()
	{
		// adaptive textarea rows lenght
		$rows = round(strlen($this->get()) / 80) + 8;
		if ($rows > 40) $rows = 40;
		$out = '';
		$out .= sprintf('<textarea name="%s" cols="80" rows="%s">%s</textarea>', $this->getName(), $rows, $this->getRaw());
		return $out;
	}
	
}
?>
