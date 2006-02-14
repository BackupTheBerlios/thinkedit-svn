<?php
require_once 'field.base.class.php'; 


class field_image extends field
{
		
		function renderUI()
		{
				return 'not yet';
				/*
				$out = '';
				$out .= sprintf('<input type="text" value="%s" name="%s", size="32">', $this->getRaw(), $this->getName());
				require_once(ROOT . '/class/url.class.php');
				$url = new url();
				$url->set('class', 'file');
				$url->set('mode', 'edit');
				$url->set('field', $this->getName());
				
				$out .= ' <a class="action_button" href="' . $url->render('browser.php') .'" target="_blank" onClick="popup(\'' . $url->render('browser.php') .'\');return false">' . translate('browse_button') . '</a>';
				return $out;
				*/
		}
		
		
}
?>
