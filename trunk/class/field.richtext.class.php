<?php
require_once 'field.base.class.php'; 

class field_richtext extends field
{
	
	function renderUI()
	{
		$out = '';
		//$out .= '<script language="javascript" type="text/javascript" src="./javascript/tiny_mce/tiny_mce.js"></script>';
		
		// this is an ugly hack but well... :
		// we hope at this stage that there is already a global $page defined, 
		// so we can ask it to put some javascript includes into the head 
		// and not at the point this field will be rendered (which is too late, after the body html tag, the js won't work)
		
		global $page;
		
		if (isset ($page))
		{
			$page->addHead('<script language="javascript" type="text/javascript" src="./javascript/tiny_mce/tiny_mce.js"></script>');
			$page->addHead('<!-- tinyMCE -->');
			$page->addHead('<script language="javascript" type="text/javascript">');
			$page->addHead('   tinyMCE.init({');
			$page->addHead('      mode : "specific_textareas", ');
			$page->addHead('      theme_advanced_toolbar_align : "left", ');
			$page->addHead('      theme_advanced_toolbar_location : "top"');
			$page->addHead('   });');
			$page->addHead('</script>');
			$page->addHead('<!-- /tinyMCE -->');
		}
		/*
		'<script language="javascript" type="text/javascript">';
		'   tinyMCE.init({';
			'      mode : "specific_textareas"';
		'   });';
		'</script>';
		'<!-- /tinyMCE -->';
		*/
		
		// adaptive textarea rows lenght
		$rows = round(strlen($this->get()) / 80) + 8;
		if ($rows > 30) $rows = 30;
		
		$out .= sprintf('<textarea name="%s" cols="80" rows="%s" mce_editable="true">%s</textarea>', $this->getName(), $rows, $this->getRaw());
		return $out;
	}
	
	function getNice()
	{
		return strip_tags($this->get());
	}
	
}
?>
