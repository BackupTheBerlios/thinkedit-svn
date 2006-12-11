<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
		
		<title>
		<?php if (isset($out['title'])): ?>
		<?php echo $out['title']; ?>
		<?php else: ?>
    Thinkedit
		<?php endif; ?>
		</title>

    <link type="text/css" href="<?php echo ROOT_URL?>/edit/ressource/css/login.css" rel="stylesheet" media="screen"/>
   	<?php echo te_jquery(); ?>	

	<!--[if lt IE 7.]>
	<script defer type="text/javascript" src="pngfix.js"></script>
	<![endif]-->
</head>
	
<body>

<div id="global">
			<div id="container">
				<img class="logoEnter" src="<?php echo ROOT_URL?>/edit/ressource/image/general/thinkenter.gif">
				<form action="login.php" method="post">
					<div align="center">
					
						<?php if (isset($out['error'])) : ?>
						<div class="error panel">
						<img src="ressource/image/icon/error.gif"/>
						<?php echo translate('error') ?> - </b><?php echo $out['error'] ?>
						</div>
						<?php endif; ?>
						
						
						<?php echo translate('login') ?><br>
						<input type="text" name="login" value="" size="24"><br>
						<?php echo translate('password') ?><br>
						<input type="password" name="password" size="24"><br>
						<span class="submit"><input type="submit" value="<?php echo translate('sign_in') ?>"></span>
						
						
						
					</div>
				</form>
			</div>
</div>



<div class="tools">

<?php
echo te_admin_toolbox(); // todo
// echo te_error_log(); // todo
?>
</div>

</div>

</body>
</html>
