<?php

require_once 'url.class.php';

class html_form
{
		
		function html_form($id = 'default')
		{
				$this->url = new url();
				$this->url->keepAll();
				$this->id = $id;
		}
		
		function isSent()
		{
				if (isset($_REQUEST[$this->id . '_save']))
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
				if (isset($_REQUEST[$this->id . '_cancel']))
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
				
				
				$out .= sprintf('<form action="%s" method="post" id="%s">', $this->url->render(), $this->id);
				
				
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
				
				$out .= sprintf('<input type="submit" value="%s" name="%s"> ', $confirm_label, $this->id . '_save');
				$out .= sprintf('<input type="submit" value="%s" name="%s">', $cancel_label, $this->id . '_cancel');
				$out .= '</form>';
				return $out;
				
		}
		
		
		
}

?>
