<?php
require_once 'field.base.class.php'; 


class field_image extends field
{
		
		function renderUI($prefix = false)
		{
				$out = '';
				
				$out .= sprintf('<input type="text" value="%s" name="%s", size="64">', $this->getRaw(), $this->getName());
				require_once(ROOT . '/class/url.class.php');
				$url = new url();
				$url->set('class', 'file');
				$url->set('mode', 'field');
				$url->set('field', $this->getName());
				
				$out .= ' <a class="action_button" href="' . $url->render('browser.php') .'" target="_blank" onClick="popup(\'' . $url->render('browser.php') .'\');return false">' . translate('browse_button') . '</a>';
				
				
				if ($this->getRaw() <>'')
				{
						$out .= '<div>';
						global $thinkedit;
						$filesystem = $thinkedit->newFilesystem();
						$filesystem->setPath($this->getRaw());
						$out .= '<img src="' . $filesystem->getIcon(50) . '"/> ';
						$out .= '</div>';
				}
				
				return $out;
				
		}
		
		
}
?>
