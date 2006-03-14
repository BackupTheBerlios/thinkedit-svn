<?php 
$relations = $relation->getRelations($content);
?>

<?php if (is_array($relations)): ?>
<hr>
<h3>En lien avec cette page</h3>


<?php foreach($relations as $my_relation): ?>


<?php if ($my_relation->getClass() == 'filesystem'): ?>
<a href="<?php echo $my_relation->getUrl(); ?>">
<?php if ($my_relation->getExtension() == 'pdf'): ?>
<li>Vous pouvez télécharger le fichier <?php echo $my_relation->getFilename(); ?> ici (<?php echo $my_relation->getSize(); ?>)</li>
<?php else: ?>
<img src="<?php echo $my_relation->getIcon(100); ?>"/>
<?php endif; ?>
<!--<?php echo $my_relation->getTitle(); ?>-->
</a>
<?php else: ?>
<a href="<?php echo te_link($my_relation); ?>">
<?php echo $my_relation->getTitle(); ?>
</a>
<?php endif; ?>


<?php endforeach; ?>
<?php endif; ?>
