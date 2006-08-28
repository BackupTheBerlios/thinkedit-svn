<div id="sidebar">

<!-- Cover -->
<?php if (isset($sidebar_image)): ?>
<div id="cover">
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
<?php
// contenu de l'actu :
$actu_content = $actu->getContent(); 
?>


<?php
// relation éventuelles :
$actu_relation = $thinkedit->newRelation(); 
$actu_relations =  $actu_relation->getRelations($actu_content);

// determination du lien de l'actu :
if ($actu_relations)
{
		$actu_link = te_link($actu_relations[0]);
}
else
{
		$actu_link = te_link($actu);
}
?>


<div class="actu_title"><?php echo te_short($actu_content->get('title'), 50); ?></div>


<?php if ($actu_content->get('image')): ?>
<div class="actu_image">
<?php $actu_image = $actu_content->field['image']->getFilesystem(); ?>
<a href="<?php echo $actu_link?>">
<img src="<? echo $actu_image->getThumbnail(array('w' => 50) )?>"/>
</a>
</div>
<?php endif; ?>




<div class="actu_intro">
<?php echo te_short($actu_content->get('body'), 200); ?>
<br/>

<a href="<?php echo $actu_link; ?>" class="color100 bold">Suite...</a>

</div>


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





<!-- Articles à lire (pour "question parents") -->
<?php if ($content->getType() =='question_parent') :?>
		<?php 
		$articles = $node->getChildren(array('type'=>'page'));
		?>
		
		<?php if (is_array($articles)): ?>
				<div id="articles">
				<div class="title color100">Articles à lire...</div>
						<?php foreach($articles as $my_article): ?>
						<div>
						<a class="<?php echo te_get_section_name($my_article) ?>_sub" href="<?php echo te_link($my_article); ?>" title="<?php echo $my_article->getTitle(); ?>">
						<img src="<?php echo te_design() ?>/sources/fleche.gif">
						<?php echo te_short($my_article->getTitle(), 25); ?>
						</a>
						</div>
						<?php endforeach; ?>
				</div>
		<?php endif; ?>

<?php endif; ?>


</div>
