<?php 
$relations = $relation->getRelations($content);
?>

<?php if (is_array($relations)): ?>
<hr>
<h3>En lien avec cette page</h3>
<?php foreach($relations as $my_relation): ?>
<h4><?php echo $my_relation->getTitle(); ?></h4>

<?php endforeach; ?>
<?php endif; ?>
