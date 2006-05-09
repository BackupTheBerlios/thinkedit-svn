<?php
include '../../thinkedit.init.php';

require_once ROOT . '/lib/json/JSON.php';

// expected answer is : [{title:"test",isFolder:true,objectId:"myobj"},{title:"test2"}]

$url = $thinkedit->newUrl();


$json = new Services_JSON();
$data = $json->decode(stripslashes($_GET["data"]));

if (isset($data->node->objectId))
{
		$node_id = $data->node->objectId;
}
else
{
		$node_id = 1;
}

/*
echo 'hop  ';
print_r ($data);
*/

if ($url->get('action') == 'getChildren')
{
		$node = $thinkedit->newNode();
		$node->setId($node_id);
		$children = $node->getChildren();
		
		if ($children)
		{
				
				foreach ($children as $child)
				{
						$child_data['title'] = $child->getTitle();
						$child_data['objectId'] = $child->getId();
						
						if ($child->hasChildren())
						{
								$child_data['isFolder'] = true;
						}
						else
						{
									$child_data['isFolder'] = false;
						}
						
						$out[] = $child_data;
				}
				//print_r ($out);
		}
		else
		{
				$out = false;
		}
}
else
{
		$out = false;
}


$output = $json->encode($out);
print($output);

/*
echo '<hr/>';
echo ('[{title:"test",isFolder:true,objectId:"myobj"},{title:"test2"}]');
echo '<hr/>';
*/





?>
