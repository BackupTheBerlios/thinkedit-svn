<?php
require_once 'field.base.class.php'; 

class field_date extends field
{
		
		function renderUI($prefix = false)
		{
				$out = '';
				$out .= sprintf('<input type="text" value="%s" name="%s", size="32">', $this->getHtmlSafe(), $prefix . $this->getName());
				return $out;
				
				$date_array = explode("-", $this->get());
				if (is_array($date_array))
				{
						$year = $date_array[0];
						$month = $date_array[1];
						$day = $date_array[2];
				}
		}
		
		
		
}
?>
