<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="168" valign="top" id="menu">


<?php
$filesystem = $thinkedit->newFilesystem();
$filesystem->setPath('/ressources/photos/');
$intro_photo = $filesystem->getRandomFile();

?>

<?php if ($intro_photo): ?>
<img class="intro_photo" src="<?php echo $intro_photo->getThumbnail(array('w'=>168, 'h'=>118, 'zc'=>1, 'q'=>90));?>">
<?php endif; ?>

<?php include_once 'context_menu.php' ?>


</td>

<td width="15"></td>


<td valign="top">


<?php if ($node->getLevel() == 4): ?>
		<?php if (isset($sibling_menu)) : ?>
				<select size="1" onChange="jump('parent',this,0)">
				<option value="#">Choisissez dans le menu ci-dessous:</option>
						<?php if (is_array($sibling_menu->getArray(true) )): ?>
								<?php foreach ($sibling_menu->getArray(true) as $sibling_menu_item) : ?>
								<option value="<?php echo $sibling_menu_item->getUrl(); ?>" <?php if ($sibling_menu_item->isCurrent()): ?>selected="selected"<?php endif; ?>><?php echo te_short($sibling_menu_item->getTitle(), 50)?></option>
								<?php endforeach; ?>
						<?php endif;?>
				</select>
				<div style="margin-bottom: 30px;"></div>
		<?php endif; ?>
<?php endif; ?>





