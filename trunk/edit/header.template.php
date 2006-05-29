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

    <link type="text/css" href="style.css" rel="stylesheet" media="screen"/>
		
		<script type="text/javascript" src="<?php echo ROOT_URL?>/lib/prototype/prototype.js"></script>				
		<script src="thinkedit.js" type="text/javascript"></script>
		
		
		
		
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="pngfix.js"></script>
<![endif]-->


	<style>
	table
	{
			/*border: 1px solid red !important;*/
	}
	</style>
		
		
  </head>
	
  <body onLoad="page_loaded()">
	
	<table align="center" width="732px">
	<tr>
	<td>
    <div class="main">
      <div class="header">
        <a href="main.php"><img src="ressource/image/general/thinkedit_logo.gif" alt="" border="0"/></a>			
      </div>

			
			

<div class="breadcrumb">
<table width="100%" cellpadding="0" border="0" cellspacing="0">
<tr>
<td>
<?php include ('breadcrumb.template.php') ?>
</td>
<td align="right">
<?php /*include_once('choose_locale.inc.php');*/ ?>
</td>
</tr>
</table>



</div>



			
<?php if (isset($out['error'])) : ?>
<div class="error">

<table width="*" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="ressource/image/icon/error.gif"/></td>
<td><div class="error_text">
<b><?php echo translate('error') ?> - </b><?php echo $out['error'] ?>
</div></td>
</tr>
</table>

</div>
<?php endif; ?>


<?php if (isset($out['info'])) : ?>
<div class="info">

<table width="*" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="ressource/image/icon/info.gif"></td>
<td><div class="info_text">
<b><?php echo translate('info') ?> - </b><?php echo $out['info'] ?>
</div></td>
</tr>
</table>

</div>
<?php endif; ?>



<div class="loading" id="loading">

<table width="*" border="0" cellspacing="0" cellpadding="0">
<tr>
<td VALIGN=middle><img src="ressource/image/icon/loading_bar.gif"></td>
<td><div class="loading_text">
<b><?php echo translate('loading_in_progress') ?></b>
</div></td>
</tr>
</table>

</div>

<?php if (isset($out['banner']['needed'])) : ?>
<div class="banner">
       
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr height="96">
					<td valign="top" height="96">
						<div class="banner_help">
							<H2><?php echo $out['banner']['title'] ?></H2><br>
							<br>
							<?php echo $out['banner']['message'] ?>
						</div>
					</td>
					<td valign="middle"><img class="banner_image" src="<?php echo $out['banner']['image'] ?>" alt="" border="0"></td>
				
<?php
// include ('banner.template.php');
?>

					<td width="100%" height="96"></td>
					
				</tr>
			</table>
			 
</div>

<?php endif; ?>