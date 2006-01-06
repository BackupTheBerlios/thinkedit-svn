<?php
// handle cache if allowed to cahce page.
// this feature is experiemental and could lead to inconsistencies in database if used in a wrong way, like setting 
// the $enable_cache to true when saving something or changing order or wathever. 
if (isset($enable_cache) && $enable_cache)
{
//header("Cache-Control: public, max-age=3600");
}

/*
header("Cache-Control: public, max-age=3600");
header("HTTP/1.0 304 Not Modified");

// calc an offset of 24 hours
  $offset = 3600;	
// calc the string in GMT not localtime and add the offset
  $expire = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
//output the HTTP header
  header($expire);
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>

    <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />

    <meta name="generator" content="La Petite Usine &reg;"/>

		<?php if (isset($out['title'])): ?>
		<title><?php echo $out['title']; ?></title>
		<?php else: ?>
    <title>Thinkedit</title>
		<?php endif; ?>

    <link type="text/css" href="style.css" rel="stylesheet"
    media="screen"/>

		
		
		
<?php if (isset($enable_power_edit) && $enable_power_edit): ?>	
<script>
var user_changed = 0;

function protect_links()
{
var links = document.getElementsByTagName("a");
for (i = 0; i < links.length; i++) 
  {
  //links[i].style.display = "none";
	links[i].setAttribute('onclick', "return is_page_saved();");
  } 
}

function is_page_saved()
{
if (user_changed == 1)
  {
	if (window.confirm('Cliquez sur OK pour quitter cette page sans sauver votre travail'))
    {
    // alert('ok');
    return true;
    }
  else
    {
    //alert('Cancel');
    return false;
    }
  }
else
{
return true;
}
}

// use this to request a save confirm dialog on change of content on the poweredit
function set_user_changed()
{
user_changed = 1;
}

</script>
<?php endif; ?>	
		
		
			
	<?php if (isset($out['calendar_needed']) && $out['calendar_needed']) : ?>
	<style type="text/css">@import url(./calendar/calendar-win2k-1.css)</style>
	<link href="./calendar/calendar-usine.css" rel="stylesheet" media="screen"/>
<script type="text/javascript" src="./calendar/calendar.js"></script>
<script type="text/javascript" src="./calendar/lang/calendar-<?php echo $out['interface_locale'] ?>.js"></script>
<script type="text/javascript" src="./calendar/calendar-setup.js"></script>
	<?php endif; ?>

		
		
		
		
		
<?php if (isset($out['wysiwyg_editor_needed']) && $out['wysiwyg_editor_needed']): ?>
<!-- To decrease bandwidth, change the src to richtext_compressed.js //-->
<script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
	
<script language="JavaScript" type="text/javascript">
<!--
function submitForm() {
	//make sure hidden and iframe values are in sync before submitting form
	//to sync only 1 rte, use updateRTE(rte)
	//to sync all rtes, use updateRTEs
	//updateRTE('rte1');
	updateRTEs();
	alert(document.RTEDemo.rte1.value);
	
	//change the following line to true to submit form
	return false;
}

initRTE("images/", "", "");
</script>
<?php endif; ?>
		
		
		
<script type="text/javascript" language="JavaScript">
function page_loaded() 
{
document.getElementById('loading').style.display='none';
<?php if ($enable_power_edit): ?>	
protect_links();
<?php endif; ?>
//alert('page loaded');
}
</script>

  </head>
  <body onLoad="page_loaded()">
	
	<table align="center" width="732px">
	<tr>
	<td>
    <div class="main">
      <div class="header">
        <a href="main.php"><img src="logo.gif" alt="" border="0"/></a>			
				
			
				
				<br>
				
				
      </div>

			
			

<div class="breadcrumb">
<table width="100%" cellpadding="0" border="0" cellspacing="0"><tr><td><?php include ('breadcrumb.template.php') ?></td><td align="right"><?php include_once('choose_locale.inc.php'); ?></td></tr></table>
</div>



			
<?php if (isset($out['error'])) : ?>
<div class="error">

<table width="*" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="error.gif"></td>
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
<td><img src="info.gif"></td>
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
<td VALIGN=middle><img src="loading_bar.gif"></td>
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
				
<?php include ('banner.template.php') ?>

					<td width="100%" height="96"></td>
					
				</tr>
			</table>
			 
</div>

<?php endif; ?>