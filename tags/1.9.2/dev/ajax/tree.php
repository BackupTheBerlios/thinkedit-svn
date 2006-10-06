<?php include '../../thinkedit.init.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<h1>Dynamic Tree</h1>


<?php
$root = $thinkedit->newNode();
$root->loadRootNode();

$nodes = $root->getAllChildren();
?>

<?php $level = $root->getLevel(); ?>

<ul class="mktree">
<?php foreach ($nodes as $node): ?>

<?php if ($node->getLevel() > $level): ?>
<ul>
<?php endif;?>

<?php if ($node->getLevel() < $level): ?>
<?php $times = $level - $node->getLevel(); ?>
<?php for ($i=0; $i<$times; $i++): ?>
</ul>
<?php endfor; ?>
<?php endif;?>

<li><?php echo $node->getTitle(); ?> (<?php echo $node->getLevel(); ?>)</li>



<?php $level = $node->getLevel(); ?>

<?php endforeach;?>
</ul>

<?php
include ROOT . '/lib/thinkedit/template.lib.php';
$url = $thinkedit->newUrl();
echo te_admin_toolbox();
?>

</body>
</html>
