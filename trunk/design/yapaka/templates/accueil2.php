<table>
<tr valign="top">

<td width="10">

</td>

<td width="300">
<div class="title_accueil">La vie sans mode d’emploi...</div>

<div class="text_accueil">
<?php echo $content->get('intro'); ?>
<?php echo $content->get('body'); ?>
</div>

</td>

<td width="100">

</td>

<td width="300">
<div class="title_accueil">Actualit&eacute;s</div>

<?php
//sélection des news dans ce dossier (accueil)
$news_nodes = $node->getChildren(array('class' => 'record', 'type' => 'news')); 
?>

<?php if (is_array($news_nodes)): ?>
		<?php foreach ($news_nodes as $news_node): ?>
				<?php $news_content = $news_node->getContent(); ?>
				<?php $news_image = $news_content->field['image']->getFilesystem(); ?>
				
				<div class="accueil_actu">
				
				<div class="accueil_actu_title"><?php echo $news_content->get('title'); ?></div>
				
				<?php if ($news_image): ?>
				<div class="accueil_actu_image">
						<img src="<?php echo $news_image->getThumbnail(array('w'=>70, 'q' => 90) ); ?>" >
				</div>
				<?php endif; ?>
				
				
				
				<div class="accueil_actu_content">
				<?php echo $news_content->get('body'); ?>
				</div>
				
				<?php 
				// maintenant, on sélectionne les relations :
				$news_relations_object = $thinkedit->newRelation();
				$news_relations = $news_relations_object->getRelations($news_content);
				?>
				<?php if (is_array($news_relations)): ?>
				
				
						<?php if (count($news_relations) == 1): ?>
								<a class="color100 accueil_actu_suite" href="<?php echo te_link($news_relations[0]); ?>">Suite...</a>
						<?php else: ?>
						<div class="accueil_actu_relations">
								<?php foreach ($news_relations as $news_relation): ?>
								<a class="news_<?php echo te_get_section_name($news_relation); ?>" href="<?php echo te_link($news_relation); ?>"><?php echo $news_relation->getTitle(); ?></a>
								<br/>
								<?php endforeach; ?>
						</div>
						<?php endif; ?>
				
				<?php endif; ?>
				
				</div>
				
				<div class="accueil_actu_clear"></div>
				
		<?php endforeach; ?>
<?php else: ?>
		Pas de news
<?php endif;?>
</td>

<td width="10">

</td>

</tr>

</table>



