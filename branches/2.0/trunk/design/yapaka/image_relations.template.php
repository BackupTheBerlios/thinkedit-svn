<?php 
$relations = $relation->getRelations($content);
?>

<?php if (is_array($relations)): ?>
		<?php foreach($relations as $my_relation): ?>
				<?php if ($my_relation->getClass() == 'filesystem'): ?>
						<?php if ($my_relation->isImage()): ?>
								<a href="<?php echo $my_relation->getUrl(); ?>">
								<img class="content_image" src="<?php echo $my_relation->getThumbnail(array('w'=>168, 'h'=>127, 'zc' => '1')); ?>"/>
						<?php endif; ?>
				<?php endif; ?>
		<?php endforeach; ?>
<?php endif; ?>
