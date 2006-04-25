<div id="sidebar">

<!-- Cover -->
<?php if (isset($sidebar_image)): ?>
<div id="image">
<img src="<?php echo $sidebar_image->getThumbnail(array('w' => 170) ); ?>"/>
</div>
<?php endif; ?>



<!-- Actu -->
<?php if ($news = $node->getChildren(array('type'=>'news'))): ?>
<div id="news">
<div class="title color100">Actualités</div>
<hr>
<?php foreach ($news as $actu): ?>
<div class="actu">
<?php $actu_content = $actu->getContent(); ?>

<a href="<?php echo te_link($actu); ?>">
<div class="actu_title"><?php echo te_short($actu_content->get('title'), 25); ?></div>
<div class="actu_intro">
<?php echo te_short($actu_content->get('body'), 80); ?>
 
<span class="color100 bold">Lire</span>
</div>
</a>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>



<!-- related files -->

<?php 
$relations = $relation->getRelations($content, array('class'=>'filesystem'));
?>

<?php if (is_array($relations)): ?>
<div id="downloads">
<div class="title color100">Téléchargements</div>
<hr>
<?php foreach($relations as $my_relation): ?>
			<div>						
								<?php if ($my_relation->isImage()): ?>
										<a href="<?php echo $my_relation->getUrl(); ?>">
										<img class="content_image" src="<?php echo $my_relation->getThumbnail(array('w'=>170)); ?>"/>
										</a>
								<?php elseif ($my_relation->getExtension() == 'pdf'): ?>
								  <img src="<?php echo $my_relation->getIcon(); ?>"/><a href="<?php echo $my_relation->getUrl(); ?>"> <?php echo te_short($my_relation->getFilename(), 25); ?></a>
									<hr>
								<?php else: ?>
										<a href="<?php echo te_link($my_relation); ?>">
										<?php echo te_short($my_relation->getTitle(), 30); ?>
										</a>
										<hr>
								<?php endif; ?>
			</div>
				<?php endforeach; ?>
				</div>
<?php endif; ?>



<!-- Related nodes -->
<?php 
$relations = $relation->getRelations($content, array('class'=>'node'));
?>

<?php if (is_array($relations)): ?>
<div id="relations">
<div class="title color100">Voir aussi...</div>
<?php foreach($relations as $my_relation): ?>
			<div>
			<a class="<?php echo te_get_section_name($my_relation) ?>_sub" href="<?php echo te_link($my_relation); ?>" title="<?php echo $my_relation->getTitle(); ?>">
<img src="<?php echo te_design() ?>/sources/fleche.gif">
<?php echo te_short($my_relation->getTitle(), 25); ?>
</a>

			</div>

<?php endforeach; ?>
</div>
<?php endif; ?>




</div>
