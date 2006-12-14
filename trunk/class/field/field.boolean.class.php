<?php
require_once 'field.base.class.php'; 

class field_boolean extends field
{
	
	function renderUI($prefix = false)
	{
		$out = '';
		if ($this->get())
		{
			$checked = ' checked="checked" ';
		}
		else
		{
				$checked = '';
		}
		// this hack has been documented here : http://www.onlamp.com/pub/a/php/2003/03/13/php_foundations.html
		$out .= sprintf('<input type="hidden" value="0" name="%s">', $prefix . $this->getName());
		// we allways define the checkbox to be false with an hidden form.
		// if the checkbox is checked, the value is overwritten
		// this is because the browser only sends something if the checkbox is checked.
		// My form logic is screwed by this. But a solution will exists in $field->handleFormPost() (todo)
		
		$out .= sprintf('<input type="checkbox" name="%s" %s>', $prefix . $this->getName(), $checked);
		return $out;
	}
	
	
	
	function set($data)
	{
		if ($data)
		{
			$this->data = 1;
		}
		else
		{
			$this->data = 0;
		}
		
	}
	
	function get()
	{
		if ($this->data)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	function validate()
	{
	if ($this->isRequired() && $this->get() == 0)
		{
			$error['type'] = 'required';
			$error['help'] = translate('field_checkbox_must_be_checked');
			$this->errors[] = $error;
		}
		return parent::validate();
	}
}
?>
