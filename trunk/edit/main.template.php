
<div class="content">

<?php if (is_array($out['item'])): ?>
<div class="box">
<?php foreach ($out['item'] as $item): ?>
<a href="<?php echo $item['action']?>">
<h1>

<?php if (isset($item['icon'])):?>
<img src="<?php echo($item['icon']) ?>">
<?php endif; ?>

<?php echo $item['title']?>

</h1>

<p>
<?php echo $item['help']?>
</p>
</a>
<?php endforeach; ?>
</div>
<?php endif; ?>

</div>
      

      <div class="content">
			
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					
					<!-- table sections -->
					
					<td valign="top">
					
						<table cellpadding="10" cellspacing="10" border="0">
									 <tr>

<!--					
					<td valign="top" class="module_help">
          <b><?php echo translate('hello') ?> <?php echo $out['user'] ?></b><br/>
          
          <br/>
                    
          <?php echo $out['welcome_message'] ?><br/>
           
          <hr/>
					<a class="help_button" href="#"><?php echo translate('help_button') ?>!</a>
				</td>
-->


				
			<?php $i=1 ?>
			
      <?php if (isset($out['table'])) : ?>
      
			<?php foreach ($out['table'] as $table): ?>
			
			<?php if ($table['type'] == 'list') : ?>
			
			<td valign="top" class="module" width="205">		
				 	 						<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td>
													<table class="module_header">
														<tbody>
															<tr>
																<td class="module_header"><a class="module_title" href="<?php echo $table['list_url']; ?>"><?php echo $table['title'] ?></a>
																	<p><?php echo $table['help'] ?></p>
																</td>
																<td><a class="module_title" href="<?php echo $table['list_url']; ?>"><img class="module_image" src="<?php echo $table['icon'] ?>" alt="" border="0"></a></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													<hr>
												</td>
											</tr>
											<tr>
												<td>
													<table width="100%" class="module_list">
														
														<?php if (isset($table['items'])) : ?>
           									<?php foreach ($table['items'] as $item): ?>
														
														<tr>
															<td><a href="edit.php?id=<?php echo $item['id'] ?>&table=<?php echo $table['id']?>&db_locale=<?php echo $item['locale'] ?>" ><?php echo $item['title'] ?></a></td>
															<td align="right"><a class="edit_link_button" href="edit.php?id=<?php echo $item['id'] ?>&table=<?php echo $table['id']?>&db_locale=<?php echo $item['locale'] ?>" >[<?php echo translate('edit_button') ?>]</a></td>
														</tr>
														
														 <?php endforeach?>
					 									 <?php else: ?>
														 
														 <tr>
														 		 <td><?php echo translate('nothing_in_list') ?></td>
														 </tr>
					 									 <?php endif; ?>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													<hr>
												</td>
											</tr>
											<tr height="15">
												<td height="15">
												<?php if (isset($table['buttons']) &&  $table['buttons'] <> 'false'): ?> 
												<a href="list.php?table=<?php echo $table['id']?>" class="action_button"  title="<?php echo $table['help'] ?>"><?php echo translate('list')?></a> <a href="add.php?module=<?php echo $table['id']?>&db_locale=<?php echo get_preferred_locale() ?>" class="action_button"><?php echo translate('add')?></a>
												<?php endif; ?>
												</td>
											</tr>
										</table>
			</td>
			<?php if (($i % 2)==0):?>
			</tr>
			<tr>
			<?php endif; ?>
			
			<?php $i++ ?>
	
			<?php endif; ?>
			
			
			

			
      <?php endforeach?>
			<?php endif?>
			
										</tr>
							
					</table>
					</td>
			
					<!-- fin  table sections-->
					
					<!-- separator -->
					<td valign="top" background="separator.gif">
						<img src="images/separator.gif" width="2px" height="100%" align="top">
					</td>
					<!-- fin separator -->
					
					<!-- table listes -->
					<td valign="top">
					
						<table cellpadding="0" cellspacing="10" border="0">
						<?php if (isset($out['filemanager_table'])) : ?>
							<tr height="152">		
								
								<td valign="top" height="152" background="images/sticker.gif">
								
								
								<?php foreach ($out['filemanager_table'] as $table): ?>
								
									<table cellpadding="0px" cellspacing="0" class="module_right" height="152">
										<tr height="28">
											<td height="28"><div class="module_right_title"><?php echo $table['title'] ?> >></div></td>
										</tr>
										<tr height="124">
											<td valign="top" height="124">
												<table width="100%" border="0" cellspacing="0" cellpadding="10" height="100%">
													<tr>
														<td valign="top" width="50%"><a href="file_manager.php?module=<?php echo $table['id']; ?>"  title="<?php echo $table['help'] ?>"><img src="images/armoire.jpg" alt="" width="95" height="102" border="0"></a></td>
														<td valign="top" width="50%">
														<a href="file_manager.php?module=<?php echo $table['id']; ?>"  title="<?php echo $table['help'] ?>"><?php echo $table['help'] ?></a><br/><br/>
														<a href="list.php?module=<?php echo $table['id']; ?>"  title="<?php echo translate('metadata_link_homepage') ?>"><?php echo translate('metadata_link_homepage') ?></a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									
								</td>
								<?php endforeach; ?>
								
								
								
							</tr>
							<?php endif; ?>					
							<?php if (isset ($out['minilist_table'])): ?>
							<tr>
								<td valign="top">
									<table cellpadding="0px" cellspacing="0" height="59">
										<tr height="29">
											<td height="29" background="images/sticker_top.gif">
												<div class="module_right_title">Divers >></div>
											</td>
										</tr>
										
										
										<?php $x = 0; ?>
										<?php foreach ($out['minilist_table'] as $table): ?>
										<tr>
											<td valign="top" bgcolor="white"><div class="module_right_list"><a class="module_list_button" href="list.php?module=<?php echo $table['id']; ?>" title="<?php echo $table['help'] ?>"><?php echo $table['title'] ?></a></div></td>
										</tr>
										
										<?php $x++ ?>
										<?php if ($x < count($out['minilist_table'])) : ?>
										<tr height="1">
											<td bgcolor="#999999" height="1"></td>
										</tr>
									
										<?php endif; ?>
										
										
										<?php endforeach; ?>
																
										
										<tr>
											<td valign="top" height="14px" background="images/sticker_bottom.gif"></td>
										</tr>
									</table>
								</td>				
							</tr>
							<?php endif; ?>
							
						</table>
				</td>
				
				<!-- fin table listes-->
					
			</tr>
			</table>
			
      </div>
