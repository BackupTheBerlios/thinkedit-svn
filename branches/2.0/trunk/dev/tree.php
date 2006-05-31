<?php include '../../thinkedit.init.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />

<!--
<script type="text/javascript" src="dojo.js"></script>

<script type="text/javascript">
	dojo.require("dojo.lang.*");
	//dojo.require("dojo.widget.*");
	dojo.require("dojo.widget.Tree");
	// dojo.require("dojo.widget.TreeRPCController");
</script>
-->
</head>
<body>

<!--
<h1>Static Tree</h1>

<div dojoType="Tree">

<div dojoType="TreeNode" title="Home">
<div dojoType="TreeNode" title="B">
<div dojoType="TreeNode" title="B">
</div>
<div dojoType="TreeNode" title="B1">
</div>
<div dojoType="TreeNode" title="B2">
</div>
<div dojoType="TreeNode" title="B3">
</div>

</div>
<div dojoType="TreeNode" title="B1">
</div>
<div dojoType="TreeNode" title="B2">
</div>
<div dojoType="TreeNode" title="B3">
</div>
</div>
<div dojoType="TreeNode" title="Home2">
</div>
<div dojoType="TreeNode" title="Home3">
</div>

</div>
-->



<h1>Dynamic Tree</h1>
<div>
<?php
$root = $thinkedit->newNode();
$root->loadRootNode();
$nodes = $root->getAllChildren();
?>

<?php $level = $root->getLevel(); ?>


<?php foreach ($nodes as $node): ?>

<div title="<?php echo $node->getTitle(); ?> (<?php echo $node->getLevel(); ?>)">
<?php echo $node->getTitle(); ?> (<?php echo $node->getLevel(); ?>)
</div>

<?php if ($node->hasChildren()): ?>

<?php endif; ?>

<?php if ($level > $node->getLevel()): ?>

<?php endif; ?>

<?php $level = $node->getLevel(); ?>

<?php endforeach;?>
</div>


<!--
<h1>Dynamic Tree</h1>

<div dojoType="Tree">
<?php
$root = $thinkedit->newNode();
$root->loadRootNode();
$nodes = $root->getAllChildren();
?>

<?php $level = $root->getLevel(); ?>


<?php foreach ($nodes as $node): ?>

<div dojoType="TreeNode" title="<?php echo $node->getTitle(); ?> (<?php echo $node->getLevel(); ?>)">

<?php if ($node->hasChildren()): ?>
</div>
<?php endif; ?>

<?php if ($level > $node->getLevel()): ?>
</div>
<?php endif; ?>

<?php $level = $node->getLevel(); ?>

<?php endforeach;?>
</div>
-->

<?php
include ROOT . '/lib/thinkedit/template.lib.php';
$url = $thinkedit->newUrl();
echo te_admin_toolbox();
?>


</body>
</html>


		
</div>
