<?php
require_once 'field.base.class.php'; 


class field_url extends field
{
	
	
	function validate()
	{
		// check if we need to test if it is a valid email adress :
		if (isset($this->config['validation']['is_url']))
		{
			if (!$this->isValidUrl($this->get()))
			{
				$error['type'] = 'is_url';
				$error['help'] = translate('field_is_not_an_url');
				$this->errors[] = $error;
			}
		}
		// don't break the validation chain
		return parent::validate();
		
	}
	
	function isValidUrl($url)
    {
		//from http://www.phpriot.com/d/code/url-parsing/url-validation/index.html
		return preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }
	
}
?>
