<?php 
$relations = $relation->getRelations($content);
?>
<?php if (is_array($relations)): ?>
				<?php foreach($relations as $my_relation): ?>
						<?php if ($my_relation->getClass() == 'filesystem'): ?>
								<?php if ($my_relation->isImage()): ?>
										<a href="<?php echo $my_relation->getUrl(); ?>">
										<img class="content_image" src="<?php echo $my_relation->getThumbnail(array('w'=>168, 'h'=>127, 'zc' => '1')); ?>"/>
										</a>
								<?php elseif ($my_relation->getExtension() == 'pdf'): ?>
										<li>
										Vous pouvez télécharger le fichier <?php echo $my_relation->getFilename(); ?> <a href="<?php echo $my_relation->getUrl(); ?>">ici</a> (<?php echo $my_relation->getSize(); ?>)
										</li>
								<?php else: ?>
										<a href="<?php echo te_link($my_relation); ?>">
										<?php echo te_short($my_relation->getTitle(), 30); ?>
										</a>
								<?php endif; ?>
						<?php elseif ($my_relation->getType() == 'node'):?>
										<?php if (!isset($voir_aussi)): ?>Voir aussi :<?php $voir_aussi = true; endif; ?>
										<a class="news_<?php echo te_get_section_name($my_relation); ?>" href="<?php echo te_link($my_relation); ?>" title="<?php echo $my_relation->getTitle(); ?>">
										<?php echo te_short($my_relation->getTitle(), 30); ?>
										</a>
										
						<?php endif; ?>
						
				<?php endforeach; ?>
<?php endif; ?>
