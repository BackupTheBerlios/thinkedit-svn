<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<meta name="generator" content="Thinkedit" />

<link href="<?php echo te_design() ?>/style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>

<div id="container">
	<div id="header">
		<div id="logo"><img src="<?php echo te_design() ?>/sources/logo.gif" alt="" width="167" height="55" border="0"></div>
		<div id="menu">
		<?php if (isset($main_menu) && $main_menu->getArray()) : ?>
				<?php foreach ($main_menu->getArray() as $main_menu_item): ?>
				<a href="<?php echo te_link($main_menu_item->node);?>"><?php echo $main_menu_item->getTitle(); ?></a> 
				<?php if (!$main_menu_item->isEnd()):?><span class="menu_separator"></span><?php endif; ?>
				<?php endforeach; ?>
		<?php endif; ?>
		</div>
		
	</div>
<div id="submenu">
		<?php if (isset($context_menu) && $context_menu->getArray()) : ?>
				<?php foreach ($context_menu->getArray() as $context_menu_item): ?>
					
					<?php if ($context_menu_item->node->getLevel() == 3): ?>
					<div style="margin-left: 15px">
					<?php endif; ?>
					
					<?php if ($context_menu_item->isCurrent()): ?>
					<span class="submenu_current">
					<?php endif; ?>
					
				<a href="<?php echo te_link($context_menu_item->node);?>"><?php echo te_short($context_menu_item->getTitle(), 25); ?></a><br/>
					
					<?php if ($context_menu_item->isCurrent()): ?>
					</span>
					<?php endif; ?>
				
					<?php if ($context_menu_item->node->getLevel() == 3): ?>
					</div>
					<?php endif; ?>
					
				<?php endforeach; ?>
		<?php endif; ?>
	
</div>
<div id="content">

<?php if ($content->isMultilingual()): ?>
<div class="locale">
	<?php echo te_translate('page_available_in')?> : <?php echo te_locale_chooser(); ?>
</div>
<?php endif; ?>

<div class="title">
	<?php echo $content->getTitle(); ?>
</div>




