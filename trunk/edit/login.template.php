



<div class="login">
			
			<table width="732px" height="*" border="0" cellspacing="0" cellpadding="0">
					<tr>
						 <td valign="top"><div class="login_table_padding">
						 <H2>
						 <?php echo translate('login_welcome_title') ?>
						 </H2>
								<p/>
								<?php echo translate('login_welcome_message') ?>
								</div>
							</td>
							<td><div class="login_table_padding"><img src="clefs.gif"></div></td>
							<td bgcolor="#cccccc" width="1"></td>
							
							<td valign="top" width="204">
							<div class="login_table_padding">
							<H4><?php echo translate('login') ?></H4>		
					<br/>
					

					
					<form action="login.php" method="post">
					<input type="text" name="login" value="" class="input">
					<p/>
					<H4><?php echo translate('password') ?></H4>
					<br/>
					<input type="password" name="password" value="" class="input">
					<P/>
					
					<input type="submit" class="action_button" value="<?php echo translate('sign_in') ?>">
					
					
					</form>
					</div>
							</td>
							
							<td bgcolor="#cccccc" width="1"></td>
							
							<td valign="top" width="204">
							<div class="login_table_padding">
							<H4><?php echo translate('forgot_password') ?></H4>
					 		<br/><H3><?php echo translate('forgot_password_message') ?></H3>
							
							
							<form action="login.php" method="post">
							<p/>
							<input type="text" name="email" value="" class="input">
							<p/>
							<input type="submit" value="<?php echo translate('send_my_login') ?>" class="action_button">
							</form>

							
							</div>
							</div>
							</td>
							
						 </tr>
			</table>
			
			</div>






