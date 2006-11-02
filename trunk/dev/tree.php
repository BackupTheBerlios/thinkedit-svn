<?php
require_once('../thinkedit.init.php');
?>

<html>
<head>
<?php echo te_jquery(); ?>
<script src="<?php echo ROOT_URL ?>/lib/interface/interface.js"></script>

<script src="tree.js"></script>


<style>
.node
{
	cursor: pointer;
}

</style>

</head>
<body>
<div id="loader">loading</div>

<?php
$root = $thinkedit->newNode();

$root->loadRootNode();

$tree = $root->getAllChildren();

echo '<ul>';
//echo '<li class="node" id="node_'. $root->getId()  .'" onclisck="load_node(' . $root->getId() . ')">' . $root->getTitle() .  '<div class="child"></div></li>';
//echo '<li class="node" id="node_'. $root->getId()  .'">' . $root->getTitle() .  '<div class="child"></div></li>';
echo '<li class="node" id="node_'. $root->getId()  .'">' . $root->getTitle() .  '</li>';
echo '</ul>';

die;

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
		//echo '<li id="node_'. $node->getId()  .'" onclick="load_node(' . $node->getId() . ')">' . $node->getTitle() .  '<div class="child"></div></li>';
		echo '<li id="node_'. $node->getId()  .'" onclick="load_node(' . $node->getId() . ')">' . $node->getTitle() .  '</li>';
		
		$previous_level = $level;
		
}
echo '</ul>';


echo te_admin_toolbox();
?>
</body>
</html>
