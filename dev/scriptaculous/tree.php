<?php include '../../thinkedit.init.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script src="<?php echo ROOT_URL?>/lib/scriptaculous/lib/prototype.js" type="text/javascript" language="javascript" charset="utf-8"></script>
<script src="<?php echo ROOT_URL?>/lib/scriptaculous/src/scriptaculous.js" type="text/javascript" language="javascript" charset="utf-8"></script>

<style type="text/css">
      ul  
			{
			padding 5px;
			border: 1px solid #ccf;
			margin: 3px;
			}
			
      li
			{
			border: 1px solid #fcc;
			margin: 3px;
			}
</style>

</head>
<body>
<h1>Dynamic Tree</h1>


<?php
$root = $thinkedit->newNode();
$root->loadRootNode();

$nodes = $root->getAllChildren();
?>

<?php $level = $root->getLevel(); ?>

<ul id="tree_test">
<?php foreach ($nodes as $node): ?>

<?php if ($node->getLevel() > $level): ?>
<ul><li>
<?php endif;?>


<ul><li><?php echo $node->getTitle(); ?> (<?php echo $node->getLevel(); ?>)</li></ul>

<?php if ($node->getLevel() < $level): ?>
<?php $times = $level - $node->getLevel(); ?>
<?php for ($i=0; $i<$times; $i++): ?>
</li></ul>
<?php endfor; ?>
<?php endif;?>





<?php $level = $node->getLevel(); ?>

<?php endforeach;?>
</ul>

<script type="text/javascript">
    //<![CDATA[
    Sortable.create('tree_test', {tree:true,scroll:window});
    //]]>
    </script>


<?php
include ROOT . '/lib/thinkedit/template.lib.php';
$url = $thinkedit->newUrl();
echo te_admin_toolbox();
?>

</body>
</html>
