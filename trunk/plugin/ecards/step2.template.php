<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="style.css" rel="stylesheet" type="text/css" media="all">


</head>
<body>

<div class="ui">

<div class="ui_box white">
<h2>Apperçu : </h2>

<img src="render_ecard.php?random=<?php echo rand(10, 1000);?>"/>

</div>




<div class="ui_box">
<h2>Corrections</h2>
<div>Vous pouvez corriger votre message si il ne vous convient pas</div>
<div><form action="index.php"><input type="submit" value="<- Corriger"/></form></div>
</div>

<div class="ui_box">
<form action="step03.php">
<h2>Vérification et envoi</h2>
<div class="field_title">Entrez le code ci-dessous pour vérifier que vous êtes un humain:</div>
<div>
<img src="<?php echo $captcha->render();?>"/>
</div>
<div>
Code : <br/><input type="text" size="12" name="captcha"/>
</div>

	<div class="field_title">Cliquez ci-dessous pour envoyer votre carte</div>
<input type="submit" value="Envoyer ->">
</form>
</div>


</div>



</body>
</html>
