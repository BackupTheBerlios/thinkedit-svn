<?php
// xdebug_start_profiling();
require_once '../thinkedit.init.php';


$root = $thinkedit->newNode();
$root->load(236);

echo $root->computePath();


/*
for ($i=0; $i < 100; $i++)
{
		$test = $thinkedit->newRecord('page');
		//$test->load();
}
*/


/*
$root = $thinkedit->newNode();
$root->loadRootNode();


$folder = $thinkedit->newRecord('page');
$folder->set('title', 'Test page');
$folder->save();
$test = $root->add($folder);


for ($x=0;$x<10;$x++)
{
		$folder = $thinkedit->newRecord('page');
		$folder->set('title', 'Test page nr. ' . $x);
		$folder->save();
		$sub_test = $test->add($folder);
		
		for ($y=0;$y<10;$y++)
		{
				$folder = $thinkedit->newRecord('page');
				$folder->set('title', 'Sub Test page nr. ' . $x . ' ' . $y);
				$folder->save();
				$sub_test->add($folder);
		}
		
}

*/


xdebug_dump_function_profile(4);
?>
