<?php
// xdebug_start_profiling();
require_once '../thinkedit.init.php';



$node = $thinkedit->newNode();

for ($y=0;$y<10;$y++)
{
		$node->setId(115 + $y);
		
		$node->load();
		
		for ($x=0;$x<10;$x++)
		{
				$folder = $thinkedit->newRecord('folder');
				$folder->set('title', 'Test folder nr. ' . $x);
				$folder->save();
				$node->add($folder);
		}
}

xdebug_dump_function_profile(4);
?>
