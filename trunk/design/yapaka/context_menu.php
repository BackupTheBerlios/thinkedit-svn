<?php $context_menu_items = $context_menu->getArray()?>
<?php if ($context_menu_items): ?>
<?php foreach ($context_menu_items as $menuitem): ?>
<?php
if ($menuitem->getLevel() == 3)
{
		$class = 'navigation bgcolor50';
}
elseif ($menuitem->getLevel() == 4)
{
		$class = 'navigation bgcolor25';
}
else
{
		$class = 'navigation bgcolor100';
}

if ($menuitem->isCurrent())
{
		$class .= " current_navigation";
}
?>
<a class="<?php echo $class; ?>" href="<?php echo $menuitem->getUrl();?>">
<?php if ($menuitem->node->hasChildren()): ?>

		<?php if ($menuitem->node->isAncestorOf($node) || $menuitem->isCurrent() ): ?>
		<img src="<?php echo te_design() ?>/sources/minus.gif" border="0px">
		<?php else: ?>
		<img src="<?php echo te_design() ?>/sources/plus.gif" border="0px">
		<?php endif;?>

<?php else: ?>
<img src="<?php echo te_design() ?>/sources/empty.gif" border="0px">
<?php endif;?>

<?php echo $menuitem->getTitle();?>
</a>
<?php endforeach; ?>
<?php endif; ?>

