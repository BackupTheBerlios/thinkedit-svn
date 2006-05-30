<?php

require_once 'record.class.php'; 

class record_multilingual extends record
{
		
		function record_multilingual($table) 
		{
				parent::record($table);
		}
		
		/**
		* Returns the field id describing the locale of this record
		* Usually this is simply "locale"
		*
		*/
		function getLocaleFieldId()
		{
				foreach ($this->field as $field)
				{
						if ($field->getType() == 'locale')
						{
								return $field->getId();
								
						}
				}
				trigger_error('record_multilingual::getLocaleFieldId() : very strange : you are using a multilingual record but there is no locale field defined. Check your config file'); 
				return false;
		}
		
		/**
		* Set the locale of this record
		* 
		*
		*/
		function setLocale($locale)
		{
				return $this->field[$this->getLocaleFieldId()]->set($locale);
				
		}
		
		
		/**
		* Returns the locale of this record
		* 
		*
		*/
		function getLocale()
		{
				return $this->field[$this->getLocaleFieldId()]->get();
		}
		
		/**
		* Returns true if this record is multilingual
		* of course, this record_multilingual object will allways return true
		*
		*/
		function isMultilingual()
		{
			return true;
		}
		
		/**
		* Returns a list of translations for this record
		* 
		*
		*/
		function getTranslationsList()
		{
		}
}

?>
