<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Yapaka</title>
<link href="<?php echo te_design() ?>/styles.css" rel="stylesheet" type="text/css" media="all">
<meta name="generator" content="Thinkedit" />

<script src="<?php echo te_design() ?>/script.js" type="text/javascript"></script>


<?php
// choix de la bonne CSS en fonction de la section dans laquelle on est
// sinon, on inclut la css accueil
$section_css = 'accueil.css';

$my_parents = $node->getParentUntilRoot();
if ($node->getLevel() == 1)
{
		$my_content = $node->getContent();
		$my_content->load();
		$section_css = strtolower($my_content->getTitle()) . '.css';
}
elseif (is_array($my_parents))
{
		foreach ($my_parents as $my_parent)
		{
				if ($my_parent->getLevel() == 1)
				{
						$my_content = $my_parent->getContent();
						$my_content->load();
						$section_css = strtolower($my_content->getTitle()) . '.css';
				}
		}
}
?>

<link href="<?php echo te_design() ?>/<?php echo $section_css?>" rel="stylesheet" type="text/css" media="all">

</head>


<body bgcolor="#ffffff">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td align="right" valign="top" width="15" background="<?php echo te_design() ?>/sources/shadow_left.gif">
</td>


<td align="left" valign="top" class="content_padding">
<table width="717" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top" bgcolor="#003366" width="717">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<img src="<?php echo te_design() ?>/sources/logo.gif" alt="" width="351" height="76" border="0"></td>
<td valign="top" width="168">
<input class="search" type="text" name="textfieldName" value="Rechercher..." size="24"></td>
</tr>
<tr>
<td colspan="2">
<a class="accueil" href="index.php?node_id=1">ACCUEIL</a>
<?php if (isset($main_menu)) : ?>
<?php foreach ($main_menu->getArray() as $main_menu_item) : ?>
<a class="<?php echo strtolower($main_menu_item->getTitle())?>" href="<?php echo $main_menu_item->getUrl(); ?>"><?php echo strtoupper($main_menu_item->getTitle())?></a>
<?php endforeach; ?>
<?php endif; ?>


</td>
</tr>
<tr class="bgcolor100">
<td class="breadcrumb" colspan="2">
<?php if (isset($breadcrumb)) : ?>
		<?php foreach ($breadcrumb->getArray() as $menuitem): ?>
				<?php if ($menuitem->isEnd()): ?>
					<?php echo $menuitem->getTitle();?>
				<?php else: ?>
					<a href="<?php echo $menuitem->getUrl();?>"><?php echo $menuitem->getTitle();?></a>&gt;
				<?php endif; ?>
		<?php endforeach; ?>
<?php endif; ?>
<!--Parents &gt; Lectures &gt; Les &quot;temps d'arr&ecirc;t&quot;-->
</td>
</tr>
</table>
</td>
</tr>
<tr height="15">
<td align="left" valign="top" width="717" height="15"></td>
</tr>
<tr height="12">
<td align="left" valign="top" width="717">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top" width="168">
<table width="168" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<img src="<?php echo te_design(); ?>/sources/maman.jpg" alt="" width="168" height="118" border="0"></td>
</tr>
<tr height="15">
<td height="15"></td>
</tr>
<tr>
<td>



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



</td>
</tr>
</table>
</td>
<td align="left" valign="top" width="15"></td>
<td align="left" valign="top">

<?php if ($node->getLevel() == 4): ?>

<?php if (isset($sibling_menu)) : ?>
<select size="1" onChange="jump('parent',this,0)">
<option value="#">Choisissez dans le menu ci-dessous:</option>

<?php foreach ($sibling_menu->getArray() as $sibling_menu_item) : ?>
<option value="<?php echo $sibling_menu_item->getUrl(); ?>" <?php if ($sibling_menu_item->isCurrent()): ?>selected="selected"<?php endif; ?>><?php echo $sibling_menu_item->getTitle()?></option>
<?php endforeach; ?>
</select>
<?php endif; ?>

<!--
<?php if (isset($sibling_menu)) : ?>
<ul>
<?php foreach ($sibling_menu->getArray() as $sibling_menu_item) : ?>
<li>
<?php if ($sibling_menu_item->isCurrent()): ?>
<?php echo $sibling_menu_item->getTitle()?>
<?php else: ?>
<a class="" href="<?php echo $sibling_menu_item->getUrl(); ?>"><?php echo $sibling_menu_item->getTitle()?></a>
<?php endif; ?>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
-->

<?php endif; ?>


