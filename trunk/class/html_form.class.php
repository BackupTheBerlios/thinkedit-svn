<?php

require_once 'url.class.php';

class html_form
{
	
	function isSent()
	{
		if (isset($_REQUEST['save']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function isCancel()
	{
		if (isset($_REQUEST['cancel']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	function add($data)
	{
		$this->data[] = $data;
	}
	
	
	function render()
	{
		$out = '';
		$url = new url();
		$url->keepAll();
		$out .= sprintf('<form action="%s" method="post">', $url->render());
		
		if (is_array($this->data ))
		{
			foreach ($this->data as $data)
			{
				$out .= $data;
			}
		}
		else
		{
			trigger_error('form::data no data found in this form, cannot render form');
		}
		$out .= sprintf('<input type="submit" value="%s" name="save"> ', translate('save_button'));
		$out .= sprintf('<input type="submit" value="%s" name="cancel">', translate('cancel_button'));
		$out .= '</form>';
		return $out;
		
	}
	
	
	
}

?>
