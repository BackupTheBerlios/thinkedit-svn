<?php
require_once 'field.base.class.php'; 


class field_template extends field
{
		/*
		function renderUI()
		{
				return true;
				if ($this->config['source']['type'] == 'table' && isset($this->config['source']['name']))
				{
						global $thinkedit;
						$source = $thinkedit->newRecord($this->config['source']['name']);
						$records = $source->find();
						
						if ($records)
						{
								$out='<select name="' . $this->getName() . '">';
								foreach ($records as $record)
								{
										if ($this->get() == $record->getId())
										{
												$selected = ' selected="selected" ';
										}
										else
										{
												$selected = '';
										}
										$out .= '<option value="' . $record->getId() . '"' . $selected . '>';
										
										$out .= $record->getTitle() . ' ';
										$out .= '</option>';
								}
								
								$out .='</select>';
								return $out;
								
						}
						else
						{
								return translate('source_table_is_empty');
						}
						
				}
				else
				{
						trigger_error('field_lookup::renderUI() source type not defined in config or unknown source type, must be a valid table for now');
						return false;
				}
				
		}
		*/
		
		
}
?>
