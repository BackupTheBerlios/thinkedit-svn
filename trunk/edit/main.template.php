<div class="content panel">

<?php if (is_array($out['item'])): ?>

<div class="spacer"></div>

<?php foreach ($out['item'] as $item): ?>
<div class="main_item pannel">
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
</div>
<?php endforeach; ?>

<div class="spacer">
 &nbsp;
</div>

<?php endif; ?>

</div>


      

