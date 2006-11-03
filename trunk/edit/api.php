<?php
/*
Thinkedit API


Input :
- action
- node_publish
- node_unpublish
- node_move
- node_rename

- format (json, xml, php, ...)
- + any others 


Output :
- will return a php/xml/json structure in the asked format

Root tag/aray key/ is <thinkedit> 

True is converted to 1
False is converted to 0

*/

require_once 'common.inc.php';
check_user();

$action = $url->get('action');
$format = $url->get('format');
$results = false;
$out = false;

// all actions are placed here :
if ($action == 'node_publish')
{
	$node = $thinkedit->newNode();
	if ($url->get('node_id'))
	{
		$node->load($url->get('node_id'));
		
		if ($node->publish())
		{
			$out['result'] = true;
			$out['message'] = translate('api_node_published');
		}
		else
		{
			$out['result'] = false;
			$out['message'] = translate('api_node_not_published');
		}
	}
	else
	{
		$out['result'] = false;
		$out['message'] = translate('api_no_node_id_defined');
	}
	
}
elseif ($action == 'node_unpublish')
{
	$node = $thinkedit->newNode();
	if ($url->get('node_id'))
	{
		$node->load($url->get('node_id'));
		
		if ($node->unpublish())
		{
			$out['result'] = true;
			$out['message'] = translate('api_node_unpublished');
		}
		else
		{
			$out['result'] = false;
			$out['message'] = translate('api_node_not_unpublished');
		}
	}
	else
	{
		$out['result'] = false;
		$out['message'] = translate('api_no_node_id_defined');
	}
	
}
else
{
	$out['message'] = translate('api_unknown_action requested');
	$out['result'] = false;
}


// output results
header("Content-Type: text/xml");
echo array_to_xml($out);





function array_to_xml($array, $level=1) 
{
	if (is_array($array))
	{
		
		$xml = '';
		if ($level==1)
		{
			$xml .= '<?xml version="1.0" encoding="UTF-8"?>'.
			"\n<thinkedit>\n";
		}
		foreach ($array as $key=>$value) 
		{
			$key = strtolower($key);
			if (is_array($value))
			{
				$multi_tags = false;
				foreach($value as $key2=>$value2)
				{
					if (is_array($value2))
					{
						$xml .= str_repeat("\t",$level)."<$key>\n";
						$xml .= array_to_xml($value2, $level+1);
						$xml .= str_repeat("\t",$level)."</$key>\n";
						$multi_tags = true;
					} 
					else
					{
						if (trim($value2)!='') 
						{
							if (htmlspecialchars($value2)!=$value2)
							{
								$xml .= str_repeat("\t",$level).
								"<$key><![CDATA[$value2]]>".
								"</$key>\n";
							} else {
								$xml .= str_repeat("\t",$level).
								"<$key>$value2</$key>\n";
							}
						}
						else
						{
							$xml .= str_repeat("\t",$level).
							"<$key>0</$key>\n";
						}
						$multi_tags = true;
					}
				}
				if (!$multi_tags and count($value)>0)
				{
					$xml .= str_repeat("\t",$level)."<$key>\n";
					$xml .= array_to_xml($value, $level+1);
					$xml .= str_repeat("\t",$level)."</$key>\n";
				}
			} 
			else
			{
				if (trim($value)!='')
				{
					if (htmlspecialchars($value)!=$value)
					{
						$xml .= str_repeat("\t",$level)."<$key>".
						"<![CDATA[$value]]></$key>\n";
					}
					else
					{
						$xml .= str_repeat("\t",$level).
						"<$key>$value</$key>\n";
					}
				}
				else
				{
					$xml .= str_repeat("\t",$level).
					"<$key>0</$key>\n";
				}
			}
		}
		if ($level==1)
		{
			$xml .= "</thinkedit>\n";
		}
		return $xml;
	}else
	{
		return false;
	}
	
}
?>
