<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<meta name="generator" content="Thinkedit" />
</head>
<body>

<?php if (isset($main_menu)) : ?>
Menu principal:
<?php echo $main_menu->render() ?>
<?php endif; ?>


<hr/>


<?php if (isset($breadcrumb)) : ?>
Breadcrumb :
<?php echo $breadcrumb->render() ?>
<?php endif; ?>

<hr/>

<?php if (isset($child_menu)) : ?>
Sous menu :
<br/>
<?php echo $child_menu->render() ?>
<?php endif; ?>

<hr/>



<?php if (isset($context_menu)) : ?>
Menu contextuel:
<br/>
<?php echo $context_menu->render() ?>
<?php endif; ?>

<hr/>



<?php if (isset($sitemap)) : ?>
Sitemap : 
<?php // echo $sitemap->render() ?>
<?php endif; ?>

<hr/>


