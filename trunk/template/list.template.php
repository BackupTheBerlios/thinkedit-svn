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


<?php if (is_array($out['data'])) : ?>
<?php foreach ($out['data'] as $item): ?>

<h2><?php echo $item['title']; ?></h2>

<div class="action"><a href="edit.php?id=<?php echo $item['id']; ?>">Edit</a> | <a href="delete.php?">Delete</a></div>

<?php endforeach; ?>
<?php else: ?>
<?php echo translate('no_table_in_config')?>
<?php endif; ?>
<?php
debug($out, 'out');
?>


</div>
