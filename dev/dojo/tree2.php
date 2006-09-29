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

<h1>Dynamic Tree</h1>
<div>
<?php
$root = $thinkedit->newNode();
$root->loadRootNode();
$nodes = $root->getAllChildren();
?>

<?php $level = $root->getLevel(); ?>

<?php foreach ($nodes as $node): ?>

<div style="border: 1px solid black; margin: 10px; padding: 10px;" title="<?php echo $node->getTitle(); ?> (<?php echo $node->getLevel(); ?>)">
<?php echo $node->getTitle(); ?> (<?php echo $node->getLevel(); ?>)


<?php if ($level > $node->getLevel()): ?>
</div>
<?php endif; ?>




<?php $level = $node->getLevel(); ?>

<?php endforeach;?>
</div>



<?php
include ROOT . '/lib/thinkedit/template.lib.php';
$url = $thinkedit->newUrl();
echo te_admin_toolbox();
?>


</body>
</html>


		
</div>
