<?php

class html_table
{

  var $out;
  var $rows;
  
  function add($row)
  {
	$this->rows[] = $row;
  }
  
  function render()
  {
	$out = '';
	if (is_array($this->rows))
	{
	  $out.= '<table class="datagrid" border="1">';
	  foreach ($this->rows as $row)
	  {
		$out.= '<tr class="datagrid">';
		foreach ($row as $field)
		{
		  $out.= '<td class="datagrid">';
		  $out.= $field;
		  $out.= '</td>';
		}
		
		$out.= '</tr>';
	  }
	  $out.= '</table>';
	  return $out;
	}
	else
	{
	  return translate('empty_datagrid');
	}
	  
  }
  
  
}

?>
