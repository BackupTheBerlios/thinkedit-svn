<?php
require_once('../thinkedit.init.php');


$root = $thinkedit->newNode();

$root->loadRootNode();

$tree = $root->getAllChildren();

$previous_level = 0;
echo '<ul>';
foreach ($tree as $node)
{
		
		$level = $node->getLevel();
		
		if ($level > $previous_level)
		{
				echo '<ul>';
		}
		
		if ($level < $previous_level)
		{
				echo '</ul>';
		}
		echo '<li>' . $node->getTitle() . '</li>';
		
		$previous_level = $level;
		
}
echo '</ul>';


echo te_admin_toolbox();
?>
