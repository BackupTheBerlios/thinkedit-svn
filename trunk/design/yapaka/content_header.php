<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="168" valign="top">
<img class="intro_photo" src="<?php echo te_design(); ?>/sources/maman.jpg">

<?php include_once 'context_menu.php' ?>

</td>

<td width="15"></td>


<td valign="top">


<?php if ($node->getLevel() == 4): ?>
<?php if (isset($sibling_menu)) : ?>
<select size="1" onChange="jump('parent',this,0)">
<option value="#">Choisissez dans le menu ci-dessous:</option>

<?php foreach ($sibling_menu->getArray() as $sibling_menu_item) : ?>
<option value="<?php echo $sibling_menu_item->getUrl(); ?>" <?php if ($sibling_menu_item->isCurrent()): ?>selected="selected"<?php endif; ?>><?php echo te_short($sibling_menu_item->getTitle(), 70)?></option>
<?php endforeach; ?>
</select>
<?php endif; ?>
<?php endif; ?>





