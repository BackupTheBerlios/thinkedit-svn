<?php
/**
*Based on original work by (?) (tbd, check author)
*Modified by Philippe Jadin
*
*A simple xml parser class (xml -> php arrays) based on php's expat xml parser.
*
*Limited feature set
*(Un)suported intentionnaly :
*
*- no attributes
*- only one element of the same name at the same level
*- if more than one element, use "id" attribute to differentiate them
*
*Caching support, config files are stored as "filename.xml.cache".
*It's a serialized version of the array.
*
*/

/**
	* Used internally only
	*/
class xml_parser {
  
	//var $config; // stores the config array 
	var $result; // will contain the resulting array
	var $depth = 0; // current depth in the xml file
  var $data;

	// those two elements are an array of elements depending of the current depth :
	// var id_found; // true if an id attribute is found in the current parsed tag
	// var id_found_in_element; // name of the element where an id attribute has been found


	//var tree; // contain a breadcrumb of the xml elements currently parsed

	
	
	function get($filename)
	{
	return $this->parse_file($filename);
	}
	

	function open_element_handler($parser, $element_name, $attributes) {
		$this->depth++;
		array_push ($this->tree, $element_name);


		if (isset($attributes['id']))
		{
			// if an id attribute has been found, we consider that we have to increase the array by one level (one more depth level)

			$this->id_found[$this->depth] = true;
			$this->id_found_in_element[$this->depth] = $element_name;
			$this->depth++;
			array_push ($this->tree, $attributes['id']);
		}

		// debugging :
		/*
		echo ("element : $element_name   /   depth : $this->depth <br>");
		print_a ($this->tree);
		echo (" <br>");
		*/
	}

	function close_element_handler($parser, $element_name) {
		$this->depth--;
		array_pop ($this->tree);

		// when closing an element, if we close the element with a specific id (id_found)
		// and we check if this element is the element whose id belongs to it (id_found_in_element)
		// -> we close one more depth in the array

		if (isset($this->id_found[$this->depth]) and $this->id_found_in_element[$this->depth] == $element_name)
		{
			$this->depth--;
			array_pop ($this->tree);
			$this->id_found[$this->depth] = false;

			/*
			echo '<hr>' . $this->id_found_in_element[$this->depth];
			print_a($this->tree);
			echo '<hr>';
			*/

			$this->id_found_in_element[$this->depth] = '';
		}

		// echo ("close element : $element_name   /   depth : $this->depth <br>");
		// echo (" <br>");

		$this->data = '';
	}

	// this function "eval" an array
	function character_data_handler($parser, $data) 
	{
	
		// $this->data .= htmlentities(trim($data));
		$this->data .= trim($data);
		//$this->data .= $data;
		if ($this->data != '')
		{
			$evalme = '$this->result';
			foreach ($this->tree as $tree)
			{
				$evalme .="['" . $tree . "']";
			}
			$evalme.= '=' . "'" . addslashes($this->data) . "'";
			$evalme.=';';
			/*
			echo 'eval : ' . $evalme . '<br>';
			print_a($this->tree);
			*/
			eval ($evalme);
		}
		
	}


	/*
	function default_handler($parser, $data) {
	if( trim($data) ) {
	preg_match_all('/ (\w+=".+")/U', $data, $matches);
	foreach($matches[1] as $match) {
	list($attribute_name, $attribute_value) = (explode('=',$match));
	$attribute_value = str_replace('"','',$attribute_value);
	$this->x2a_array[0]['attributes'][$attribute_name] = $attribute_value;
	}
	}
	}
	*/


	function xml2array($xml) {
		$this->parser = xml_parser_create();
		$this->tree = array();

		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, 'open_element_handler', 'close_element_handler');
		xml_set_character_data_handler($this->parser, 'character_data_handler');
		//xml_set_default_handler($this->parser, 'default_handler');
		xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, FALSE);

		foreach($xml as $line) {
			if (!xml_parse($this->parser, $line)) {
				die(sprintf('XML error: %s at line %d', xml_error_string(xml_get_error_code($this->parser)), xml_get_current_line_number($this->parser)));
			}
		}

		xml_parser_free($this->parser);

		return $this->result;
	}


	function parse_file($filename) 
  {
		if (file_exists($filename))
		{

			$cache_filename = $filename . '.cache';

			if ( file_exists($cache_filename) and filemtime($cache_filename) > filemtime($filename))
			{
				$handle = fopen($cache_filename, 'r');
				// echo 'from cache';
				return unserialize(fread($handle, filesize ($cache_filename)));
			}
			else
			{
				$datafile = file($filename);
				$result = $this->xml2array($datafile);
				$cache_file = fopen($cache_filename, 'w');
				fwrite($cache_file, serialize($result));
				fclose($cache_file);
				// echo 'from xml';
				// for security reasons, we chmod the config file and it's cache (serialized) copy. If it fails, the system is insecure. Don't try this on windows system...
				chmod($cache_filename, 0600) or die('cannot protect config file, please chmod manually config.xml.cache');
				chmod($filename, 0600) or die('cannot protect config file, please chmod manually config.xml');
				trigger_error('config file changed, I parsed it and wrote a cache file');
				return $result;
			}
		}
		else
		{
			trigger_error('XML Config file not found', E_USER_ERROR);
			return false;
		}

	}





/*
function make_attribute_string($attributes) {
if(is_array($attributes)) {
foreach($attributes as $attribute_name => $attribute_value) {
$attribute_string .= ' '.$attribute_name.'="'.$attribute_value.'"';
}
}
return $attribute_string;
}
*/

/*
function array2xml($array) {
		$this->a2x_xml_string = '<?xml'.$this->make_attribute_string($array[0]['attributes']).' ?>'."\n";
		$this->xml_output($array[0]['data']);
		return $this->a2x_xml_string;
	}

	function xml_output($sub_array) {
		foreach($sub_array as $element) {
			$no_data_flag = $element['data'] == '' ? TRUE : FALSE; #Leeres Element? z.B.: <x id="2" />
			$only_cdata_flag = !is_array($element['data']);
			$this->a2x_depth++;
			$this->a2x_xml_string.= str_repeat("\t", $this->a2x_depth -1);

			$this->a2x_xml_string.= '<'.$element['element_name'].$this->make_attribute_string($element['attributes']).( $no_data_flag ? ' /' : '' ).'>'.($only_cdata_flag ? '' : "\n").( $no_data_flag ? "\n" : '' );
			$only_cdata_flag and $this->a2x_xml_string .= $element['data'];
			if(is_array($element['data'])) {
				$this->xml_output($element['data']);
			}
			if(!$no_data_flag) {
				$only_cdata_flag or $this->a2x_xml_string.= str_repeat("\t", $this->a2x_depth -1);
				$this->a2x_xml_string .= '</'.$element['element_name'].'>'."\n";
			}
			$this->a2x_depth--;
		}
	}
	  */

	}

?>