<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF8" />

    <meta name="generator" content="Thinkedit">

    <title>
      <?php echo translate('image_browser_title') ?>
    </title>

    <link type="text/css" href="style.css" rel="stylesheet"
    media="screen">	
		
		
		
<script LANGUAGE="JavaScript">
<!--

function jump(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>


<script language="javascript"><!--
    	
			function change_url(url)
      {
      parent.frames['relation'].location.href=url
      }  
			
  //-->
</script>
		
		
</head>



<body>


	
<div class="image_browser_banner">
<table cellpadding="0" border="0" cellspacing="0">
<tr>
<td>
<H2><?php echo translate('image_browser_title') ?></H2>
<p><H3><?php echo translate('image_browser_help_select') ?></p></H3>
</td>
<td>
<img class="module_image" src="ressource/icon_browser.jpg">
</td>
</tr>
</table>
</div>

<div class="image_browser_content">

<?php if (isset($out['info'])): ?>
<?php echo $out['info'] ?>
<?php endif; ?>


<br/>
	
	
	
	
	
<div>
<?php if (isset($out['dropdown'])) : ?>
		<?php foreach ($out['dropdown'] as $dropdown): ?>
				<select size="1" onChange="jump('document',this,0)">
						<?php foreach ($dropdown['data'] as $data): ?>
						
						<?php 
						if (isset ($data['selected']))
						{
								$selected="selected";
						}
						else
						{
								$selected="";
						} 
						?>
						
						<option value="<?php echo $data['url'] ?>" <?php echo $selected ?> ><?php echo $data['title'] ?></option>
						
						<?php endforeach; ?>
				</select>
		<?php endforeach; ?>

<?php endif; ?>
</div>





<div class="image_browser_margin">


	



<table class="image_browser_table" cellspacing="0" cellpadding="0">




<tr><td colspan="2" padding="0" margin="0">
<!--
<table cellspacing="0" cellpadding="0" width="100%">


<tr>
   <th width="50%"><?php echo translate('by_name') ?></th><th width="50%"><?php echo translate('by_date') ?></th>
</tr>


</table>
-->
</td></tr>
<?php if (isset($out['items'])): ?>
<?php $i=0; ?>
<?php foreach ($out['items'] as $item) : ?>

<?php
// used to alternate rows, of course)
if (($i % 2)==0)
{
$class = "tr_off_browser";
}
else
{
$class = "tr_on_browser";
}

$i++;
?>

<tr class="<?php echo $class?>">

<td class="td_browser">

<img src="<?php echo $item['icon'] ?>">

</td>
<td>
<a href="#" onClick="change_url('<?php echo $item['url'] ?>');"><?php echo $item['title'] ?></a>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<?php echo translate('nothing_in_list') ?>
<?php endif; ?>

</table>
</div>
</div>
</html>
