											<table border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td align="left" valign="top" width="366">
													<div class="title_accueil">Introduction</div>
													</td>
													<td align="left" valign="top" width="183"></td>
													<td align="left" valign="top" width="168">
													<div class="title_accueil">A voir...</div>
													</td>
												</tr>
												<tr>
													<td align="left" valign="top" width="366">
														<div class="text_accueil">
														<?php echo $content->get('body'); ?>
														
														</div>
													</td>
													<td align="left" valign="top" width="183">
													<div class="text_accueil">
													<?php echo $content->get('intro'); ?>	
													
														<br>
														<a href=""><img src="<?php echo te_design() ?>/sources/pdf_medium.gif" alt="" width="55" height="59" border="0"></a>
													</div>
													</td>
													<td align="left" valign="top" width="168">
													
													<a class="parents_sub" href="#"><img src="<?php echo te_design() ?>/sources/fleche.gif" border="0px"> Premier</a>
													<a class="enfants_sub" href="#"><img src="<?php echo te_design() ?>/sources/fleche.gif" border="0px"> Second</a>
													<a class="ados_sub" href="#"><img src="<?php echo te_design() ?>/sources/fleche.gif" border="0px"> Troisi&egrave;me</a>
													<a class="professionnels_sub" href="#"><img src="<?php echo te_design() ?>/sources/fleche.gif" border="0px"> Quatri&egrave;me</a>
													<a class="professionnels_sub" href="#"><img src="<?php echo te_design() ?>/sources/fleche.gif" border="0px"> Cinqui&egrave;me</a></td>
												</tr>
												<tr>
													<td align="left" valign="top" width="366">
													<div class="title_accueil">Actualit&eacute;s</div>
													</td>
													<td align="left" valign="top" width="183"></td>
													<td align="left" valign="top" width="168"></td>
												</tr>
												<tr>
													<td colspan="3" align="left" valign="top" width="717">
													
													
													
													<?php
													//sélection des news dans ce dossier (accueil)
													$news_nodes = $node->getChildren(array('class' => 'record', 'type' => 'news')); 
													?>
													
													<?php if (is_array($news_nodes)): ?>
															<?php foreach ($news_nodes as $news_node): ?>
																	<div class="news">
																	<?php $news_content = $news_node->getContent(); ?>
																	<?php $news_image = $news_content->field['image']->getFilesystem(); ?>
																		<?php if ($news_image): ?>
																		<img class="news_image" src="<?php echo $news_image->getThumbnail(array('w'=> 168, 'h'=>140) ); ?>">
																		<?php endif; ?>
																		<?php echo $news_content->get('body'); ?>
																		<br>
																		<br>
																		
																		<?php 
																		// maintenant, on sélectionne les relations :
																		$relation = $thinkedit->newRelation();
																		$news_relations = $relation->getRelations($news_content);
																		?>
																		<?php if (is_array($news_relations)): ?>
																				<?php foreach ($news_relations as $news_relation): ?>
																					<a class="news_<?php echo te_get_section_name($news_relation); ?>" href="<?php echo te_link($news_relation); ?>"><?php echo $news_relation->getTitle(); ?></a>
																				<?php endforeach; ?>
																		<?php endif; ?>
																	
																	</div>
															<?php endforeach; ?>
													<?php else: ?>
													Pas de news
													<?php endif;?>
													</td>
												</tr>
											</table>
										
