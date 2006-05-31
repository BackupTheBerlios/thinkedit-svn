<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php if ($content->get('intro')): ?> 
<meta name="description" content="<?php echo htmlentities(te_short($content->get('intro'), 400)) ?>"/>
<?php endif; ?>

<?php if ($content->get('body')): ?> 
<meta name="description" content="<?php echo htmlentities(te_short($content->get('body'), 400)) ?>"/>
<?php endif; ?>


<title><?php echo $content->getTitle(); ?></title>
<link href="<?php echo te_design() ?>/accueil_template.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo te_design() ?>/styles.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" media="print" href="<?php echo te_design() ?>/print.css" />

<meta name="generator" content="Thinkedit" />

<script src="<?php echo te_design() ?>/script.js" type="text/javascript"></script>


<?php 
// inclusion des fonctions spécifiques à yapaka

include_once 'template.lib.php';

?>

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


<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-204371-2";
urchinTracker();
</script>



</head>


<body bgcolor="#ffffff">


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td align="center" valign="top">

<table width="717" border="0" style="margin-bottom: 20px" id="cfwb">
<tr>

<td>
<a href="http://www.cfwb.be/" target="_blank">
<img src="<?php echo te_design()?>/cfwb/bandeau_01.gif"/>
</a>
</td>


<td>
<a href="http://www.cfwb.be/portail/" target="_blank">
<img src="<?php echo te_design()?>/cfwb/bandeau_on_02.gif"/>
</a>
</td>

<td>
<a href="http://www.cfwb.be/portail/guichet" target="_blank">
<img src="<?php echo te_design()?>/cfwb/bandeau_on_03.gif"/>
</a>
</td>

<td>
<a href="http://www.cfwb.be/presentation/recherche/pg001.htm" target="_blank">
<img src="<?php echo te_design()?>/cfwb/bandeau_on_04.gif"/>
</a>
</td>

<td>
<a href="http://www.cfwb.be/actu/" target="_blank">
<img src="<?php echo te_design()?>/cfwb/bandeau_on_05.gif"/>
</a>
</td>

</tr>
</table>


</td>
</tr>


<tr class="layout">
<td align="center" valign="top"><img src="<?php echo te_design(); ?>/sources/shadow_top.gif" alt="" width="777" border="0">
</td>
</tr>




<tr>
<td align="center" valign="top">


<table border="0" cellspacing="0" cellpadding="0">


<tr>

<td align="right" valign="top" width="15" background="<?php echo te_design() ?>/sources/shadow_left.gif" class="layout">
</td>


<td align="left" valign="top" class="content_padding" >
<table width="717" border="0" cellspacing="0" cellpadding="0">

<!-- Header -->

<tr id="header">
<td align="left" valign="top" bgcolor="#003366" width="717">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<img src="<?php echo te_design() ?>/sources/logo.gif" alt="" width="351" height="76" border="0" id="logo"></td>
<td valign="top" width="168">
<!--
<input class="search" type="text" name="textfieldName" value="Rechercher..." size="24">
-->

</td>

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
					<?php echo te_short($menuitem->getTitle(), 40);?>
				<?php else: ?>
					<a href="<?php echo $menuitem->getUrl();?>"><?php echo te_short($menuitem->getTitle(), 20);?></a>&gt;
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
<td align="left" valign="top" width="717" id="content">



