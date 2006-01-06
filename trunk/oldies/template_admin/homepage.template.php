<div class="content">


<?php if (is_array($out['table'])) : ?>
<?php foreach ($out['table'] as $table): ?>

<h2><?php echo $table['title']; ?></h2>
<div><?php echo $table['help']; ?></div>
<div class="action"><a href="list.php?table=<?php echo $table['table']?>">List</a> | <a href="add.php?table=<?php echo $table['table']?>">Add</a></div>

<?php endforeach; ?>
<?php else: ?>
<?php echo translate('no_table_in_config')?>
<?php endif; ?>
<?php
debug($out, 'out');
?>


</div>
