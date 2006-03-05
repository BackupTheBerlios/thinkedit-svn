<?php
// xdebug_start_profiling();
require_once '../thinkedit.init.php';


$root = $thinkedit->newNode();
$root->loadRootNode();


$folder = $thinkedit->newRecord('folder');
$folder->set('title', 'Root');
$folder->save();
$root->add($folder);


$node = $thinkedit->newNode();
$node->setId(236);
$node->load();

for ($x=0;$x<500;$x++)
{
		$folder = $thinkedit->newRecord('folder');
		$folder->set('title', 'Test folder nr. ' . $x);
		$folder->save();
		$node->add($folder);
		
		
}


//xdebug_dump_function_profile(4);
?>
