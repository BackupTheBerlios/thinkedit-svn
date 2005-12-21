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
	
	function setConfirmLabel($label)
	{
	  $this->confirm_label = $label;
	}
	
	
	function setCancelLabel($label)
	{
	  $this->cancel_label = $label;
	}
	
	function render()
	{
		$out = '';
		$url = new url();
		$url->keepAll();
		$out .= sprintf('<form action="%s" method="post">', $url->render());
		
		
		if (isset($this->data) && is_array($this->data ))
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
		
		if (isset($this->confirm_label))
		{
		  $confirm_label = $this->confirm_label;
		}
		else
		{
		   $confirm_label = translate('save_button');
		}
		
		if (isset($this->cancel_label))
		{
		  $cancel_label = $this->cancel_label;
		}
		else
		{
		   $cancel_label = translate('cancel_button');
		}
		
		$out .= sprintf('<input type="submit" value="%s" name="save"> ', $confirm_label);
		$out .= sprintf('<input type="submit" value="%s" name="cancel">', $cancel_label);
		$out .= '</form>';
		return $out;
		
	}
	
	
	
}

?>
