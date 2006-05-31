<?php if ($menuitem->node->hasChildren()): ?>

		<?php if ($menuitem->node->isAncestorOf($node) || $menuitem->isCurrent() ): ?>
		<img src="<?php echo te_design() ?>/sources/minus.gif" border="0px">
		<?php else: ?>
		<img src="<?php echo te_design() ?>/sources/plus.gif" border="0px">
		<?php endif;?>

<?php else: ?>
<img src="<?php echo te_design() ?>/sources/empty.gif" border="0px">
<?php endif;?>

