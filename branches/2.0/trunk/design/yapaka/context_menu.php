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
<a class="<?php echo $class; ?>" href="<?php echo $menuitem->getUrl();?>" title="<?php echo $menuitem->getTitle();?>">

<?php if ($menuitem->getLevel() == 3): ?>
<span style="padding-left: 5px"></span>
<?php endif; ?>



<?php echo te_short($menuitem->getTitle(), 25);?>
</a>
<?php endforeach; ?>
<?php endif; ?>

