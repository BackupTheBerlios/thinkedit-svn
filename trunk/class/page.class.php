<?php

class page
{
	
	var $title;
	var $footer;
	var $header;
	var $content;
	
	
	function page()
	{
		// todo: use server root
		$this->addStyleSheet('./ressource/css/style2.css');
	}
	
	
	function setTitle($title)
	{
		$this->title = $title;
	}
	
	
	
	function setHeader($header)
	{
		$this->header = $header;
	}
	
	function setFooter($footer)
	{
		$this->footer = $footer;
	}
	
	
	function add($content)
	{
		$this->content.=$content . "\n";
	}
	
	
	
	function addStyleSheet($filename)
	{
		$this->stylesheet[] = $filename;
	}
	
	function startPanel($id, $class="")
	{
		$this->add("\n<!-- start panel $id -->");
		$this->add("<div class=\"panel $class\" id=\"$id\">\n");
		
	}
	
	function endPanel($id)
	{
		$this->add("\n</div>");
		$this->add("<!-- end panel $id -->\n\n");
	}
	
	function getHeader()
	{
		$out = '<html><head><title>' . $this->title . '</title>';
		
		
		if (is_array($this->stylesheet))
		{
			foreach ($this->stylesheet as $style)
			{
				$out .= '<link rel="stylesheet" type="text/css" href="' . $style . '" />';
			}
		}
		
		$out .= '<link rel="stylesheet" type="text/css" href="style.css" /><script src="browser.js"></script>';
		
		if (isset($this->head))
		{
			foreach ($this->head as $head)
			{
				$out.= $head . "\n";
			}
		}
		
		$out .= '</head><body>';
		//$out .= '<div class="shadow">';
		$out .= '<div class="thinkedit">';
		
		return $out;
	}
	
	
	function addHead($head)
	{
		$this->head[] = $head;
	}
	
	function addSeparator()
	{
		$this->add("\n<div class=\"separator\"></div>\n");
	}
	
	function getFooter()
	{
		$out = '</div>';
		//$out .= '</div>';
		$out .= '</body></html>';
		
		return $out;
	}
	
	
	function render()
	{
		$out = $this->getHeader();
		$out .= $this->content;
		$out .= $this->getFooter();
		
		return $out;
	}
	
	
}
?>