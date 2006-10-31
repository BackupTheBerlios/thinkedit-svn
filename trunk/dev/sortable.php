<?php
require_once('../thinkedit.init.php');
?>

<html>
<head>
<style>
.handle
{
	cursor: move;
	background-color: gray;
}

li
{
	padding: 5px;
	background-color: #eee;
}

ul
{
	width: 100px;
	list-style-type: none;
}

</style>

<?php echo te_jquery(); ?>
<script src="<?php echo ROOT_URL ?>/lib/interface/interface.js"></script>


<script>
$(document).ready(function () {
	$('ul').Sortable(
	{
		accept : 'node',
		activeclass : 'sortableactive',
		hoverclass : 'sortablehover',
		helperclass : 'sorthelper',
		handle : '.handle',
		opacity: 	0.5,
		fit :	false
	}
	);
});
</script>


</head>
<body>


<ul id="sort1">
<li class="node" id="node_1">test <span class="handle">Move</span></li>
<li class="node" id="node_2">test2 <span class="handle">Move</span></li>
<li class="node" id="node_3">test3 <span class="handle">Move</span></li>
<li class="node" id="node_4">test4 <span class="handle">Move</span></li>
<li class="node" id="node_5">test5 <span class="handle">Move</span></li>
</ul>


<?php
$root = $thinkedit->newNode();

$root->loadRootNode();

echo '<ul>';
//echo '<li class="node" id="node_'. $root->getId()  .'" onclisck="load_node(' . $root->getId() . ')">' . $root->getTitle() .  '<div class="child"></div></li>';
echo '<li class="node" id="node_'. $root->getId()  .'">' . $root->getTitle() .  '<div class="child"></div></li>';
echo '</ul>';

?>


</body>
</html>
