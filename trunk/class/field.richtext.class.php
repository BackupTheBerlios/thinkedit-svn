<?php
require_once 'field.base.class.php'; 

class field_richtext extends field
{
		
		function renderUI($prefix = false)
		{
				// te_ mean thinkedit, and is used to prevent global namespace collision (which is quite unlikely)
				global $te_wysiwyg_is_init;
				
				
				$out = '';
				
				// we can init tinymce only once for a page.
				if (!isset($te_wysiwyg_is_init))
				{
				$out .= '<script language="javascript" type="text/javascript" src="' . ROOT_URL . '/lib/tiny_mce/tiny_mce.js"></script>';
				$out .=  '<!-- tinyMCE -->';
				$out .= '<script language="javascript" type="text/javascript">';
				$out .= '   tinyMCE.init({';
						$out .= '      mode : "specific_textareas", ';
						$out .= '      theme_advanced_toolbar_align : "left", ';
						$out .= '      theme_advanced_toolbar_location : "top"';
				$out .= '   });';
				$out .= '</script>';
				$out .= '<!-- /tinyMCE -->';
				
				$te_wysiwyg_is_init = true;
				}
				
						
				/*
				require_once ROOT . '/lib/fckeditor/fckeditor.php';
				$fckeditor = new FCKeditor($this->getName()) ;
				$fckeditor->BasePath = ROOT_URL . '/lib/fckeditor/';
				$fckeditor->Value = $this->getRaw();
				$fckeditor->Height = '400' ;
				return $fckeditor->CreateHtml();
				*/
				
				// adaptive textarea rows lenght
				$rows = round(strlen($this->get()) / 80) + 20;
				if ($rows > 40) $rows = 40;
				
				$out .= sprintf('<textarea name="%s" cols="80" rows="%s" mce_editable="true">%s</textarea>', $prefix . $this->getName(), $rows, $this->getRaw());
				return $out;
		}
		
		function getNice()
		{
				return strip_tags($this->get());
		}
		
}
?>
