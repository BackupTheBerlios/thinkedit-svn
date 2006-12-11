<?php
require_once 'field.base.class.php'; 


class field_email extends field
{
	
	
	function validate()
	{
		// check if we need to test if it is a valid email adress :
		if (isset($this->config['validation']['is_email']))
		{
			if (!$this->isValidEmail($this->get()))
			{
				$error['type'] = 'is_email';
				$error['help'] = translate('field_is_not_an_email');
				$this->errors[] = $error;
			}
		}
		// don't break the validation chain
		return parent::validate();
		
	}
	
	function isValidEmail($email)
    {
		// from http://www.phpriot.com/d/code/url-parsing/email-validation/index.html
		// this is not fully valid (RFC compliant that is), but it should be sufficent for simple uses.
		return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email);
    }
	
	
	
}
?>
