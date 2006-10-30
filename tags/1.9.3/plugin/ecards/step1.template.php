
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

				<link href="style.css" rel="stylesheet" type="text/css" media="all"></head>
				<body>


						<div class="ui">


								<div class="formulaire ui_box">
								<div class="photo">
										<img src="<?php echo $image->getThumbnail(array('w'=>350, 'h'=>350)) ?>"/>
								</div>
								
								<div class="formulaire">
										<h1>Fabriquez votre carte électronique ici</h1>

										<form action="step02.php" method="post">

												<div class="field">
														<div class="field_title">Votre nom:</div>
														<div class="field_ui">
																<input type="text" name="from_name" value="<?php echo $from_name ?>"/>
														</div>
												</div>


												<div class="field">
														<div class="field_title">Votre email:</div>
														<div class="field_ui">
																<input type="text" name="from_email" value="<?php echo $from_email ?>"/>
														</div>
												</div>

												<div class="field">
														<div class="field_title">Votre message:</div>
														<div class="field_ui">
																<textarea cols="20" rows="5" name="message"><?php echo $message?></textarea>
														</div>
												</div>


												<div class="field">
														<div class="field_title">L'email du destinataire:</div>
														<div class="field_ui">
																<input type="text"  name="to_email" value="<?php echo $to_email ?>"/>
														</div>
												</div>

												<div class="field">
														<div class="field_ui">
																<input type="submit" value="Prévisualiser ->"></div>
														</div>

												</form>

										</div>

										</div>
								</div>

						</body>
				</html>
