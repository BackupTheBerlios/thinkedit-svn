<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<meta name="generator" content="Thinkedit" />
</head>
<body>

Menu principal:
<?php if (isset($menu)) : ?>
<?php if ($menu->getMainMenu()) : ?>
<ul>
<?php foreach ($menu->getMainMenu() as $child): ?>
<li>
<?php echo $child?>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php endif; ?>


Menu contextuel : 
<?php if (isset($menu)) : ?>
<?php if ($menu->getChildren()) : ?>
<ul>
<?php foreach ($menu->getChildren() as $child): ?>
<li>
<?php echo $child?>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php endif; ?>
