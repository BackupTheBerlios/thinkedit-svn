<div class="content">

<h1>List of </h1>

<div class="breadcrumb">
<?php echo $out['breadcrumb']; ?>
</div>



<div class="select">
Select: <a href="">All</a>, <a href="">None</a>
</div>


<div class="select">
With selection : Edit | Delete | Move | Publish | Unpublish | Plugin...
</div>


<?php if (is_array($out['items'])) : ?>
<?php foreach ($out['items'] as $item): ?>

<h2><?php echo $item['title']; ?></h2>

<div class="action"><a href="list.php?table=<?php echo $table['table']?>">List</a> | <a href="add.php?table=<?php echo $table['table']?>">Add</a></div>

<?php endforeach; ?>
<?php else: ?>
<?php echo translate('no_table_in_config')?>
<?php endif; ?>
<?php
debug($out, 'out');
?>


</div>
