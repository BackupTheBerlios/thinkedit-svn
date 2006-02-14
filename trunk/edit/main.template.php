
<div class="content">

<?php if (is_array($out['item'])): ?>
<div class="white bigbox">
<?php foreach ($out['item'] as $item): ?>
<a href="<?php echo $item['action']?>">
<h1>

<?php if (isset($item['icon'])):?>
<img src="<?php echo($item['icon']) ?>">
<?php endif; ?>

<?php echo $item['title']?>

</h1>

<p>
<?php echo $item['help']?>
</p>
</a>
<?php endforeach; ?>
</div>
<?php endif; ?>

</div>
      

