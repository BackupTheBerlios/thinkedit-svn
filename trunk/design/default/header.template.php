<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<meta name="generator" content="Thinkedit" />

<link href="<?php echo te_design() ?>/style.css" rel="stylesheet" type="text/css" media="all">


</head>
<body>


<?php if (isset($main_menu)) : ?>
<div class="main_menu">
<?php echo $main_menu->render() ?>
</div>
<?php endif; ?>


<?php if (isset($breadcrumb)) : ?>
<div class="breadcrumb">
<?php echo $breadcrumb->render() ?>
</div>
<?php endif; ?>



<?php if (isset($child_menu)) : ?>
<div class="child_menu">
<?php echo $child_menu->render() ?>
</div>
<?php endif; ?>


<?php if (isset($context_menu)) : ?>
<div class="context_menu">
<?php echo $context_menu->render() ?>
</div>
<?php endif; ?>


<div class="page">
