											<table border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td align="left" valign="top" width="300">
													<div class="title_accueil">La vie sans mode d’emploi...</div>
													</td>
													<td align="left" valign="top"></td>
													<td align="left" valign="top">
													<!--<div class="title_accueil">A voir...</div>-->
													</td>
												</tr>
												<tr>
													<td align="left" valign="top">
														<div class="text_accueil">
														<?php echo $content->get('intro'); ?>
														</div>
													</td>
													<td align="left" valign="top" width="20">
													
													<!--
													<div class="text_accueil">
													<?php echo $content->get('intro'); ?>	
													
														<br>
														<a href=""><img src="<?php echo te_design() ?>/sources/pdf_medium.gif" alt="" width="55" height="59" border="0"></a>
													</div>
													-->
													</td>
													<td align="left" valign="top" width="300">
													
													<div class="text_accueil">
														<?php echo $content->get('body'); ?>
														</div>
													
												</tr>
												<tr>
													<td align="left" valign="top">
													<div class="title_accueil">Actualit&eacute;s</div>
													</td>
													<td align="left" valign="top"></td>
													<td align="left" valign="top"></td>
												</tr>
												<tr>
													<td colspan="3" align="left" valign="top">
													<?php
													//sélection des news dans ce dossier (accueil)
													$news_nodes = $node->getChildren(array('class' => 'record', 'type' => 'news')); 
													?>
													
													<?php if (is_array($news_nodes)): ?>
															<table border="0">
															<tr>
															<?php foreach ($news_nodes as $news_node): ?>
															<td valign="top">
															<table border="0">		
															<tr>
															<td width="168" valign="top" height="120" align="center">
																	<?php $news_content = $news_node->getContent(); ?>
																	<?php $news_image = $news_content->field['image']->getFilesystem(); ?>
																		<?php if ($news_image): ?>
																		<img src="<?php echo $news_image->getThumbnail(array('hl'=> 140, 'hp'=>140, 'wl'=> 168, 'wp'=>168, 'q' => 90) ); ?>">
																		<!--<center><img src="<?php echo $news_image->getThumbnail(array('h'=> 150, 'w'=>150, 'zc' => 1) ); ?>"></center>-->
																		<?php endif; ?>
															</td>
															</tr>
															<tr>
															<td>
															<br/>
															<br/>
															<b><?php echo $news_content->get('title'); ?></b>
															<br/>
															<?php echo $news_content->get('body'); ?>
															<br/>
															<br/>
																		
																	<?php 
																		// maintenant, on sélectionne les relations :
																		$news_relations_object = $thinkedit->newRelation();
																		$news_relations = $news_relations_object->getRelations($news_content);
																	?>
																	<?php if (is_array($news_relations)): ?>
																		<?php foreach ($news_relations as $news_relation): ?>
																			<a class="news_<?php echo te_get_section_name($news_relation); ?>" href="<?php echo te_link($news_relation); ?>"><?php echo $news_relation->getTitle(); ?></a>
																		<?php endforeach; ?>
																	<?php endif; ?>
																	
															</td>
															</tr>
																	
															</table>
															</td>		
															<td width="20">&nbsp;</td>
															<?php if (te_every(3)): ?></tr><tr><td height="20"></tr></td><tr><?php endif; ?>
															
															<?php endforeach; ?>
															</tr>
															</table>
													<?php else: ?>
													Pas de news
													<?php endif;?>
													
													
													</td>
												</tr>
											</table>
										
