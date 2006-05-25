<?php
include '../../thinkedit.init.php';
require_once ROOT . '/lib/json/JSON.php';

$json = new Services_JSON();
$url = $thinkedit->newUrl();

if($url->get('parent_id'))
{
	
	$node = $thinkedit->newNode();
	$node->setId($url->get('parent_id'));
	$children = $node->getChildren();
	
	if ($children)
	{
		$out['results'] = true;
		foreach ($children as $child)
		{
			$node_data['id'] = $child->getId();
			$node_data['title'] = $child->getTitle();
			$node_data['test'] = 'test';
			$out['nodes'][] = $node_data;
		}
	}
	
}
else
{
	$out['results'] = false;
}

$output = $json->encode($out);
print($output);


?>
