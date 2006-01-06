<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
  <head>

    <meta http-equiv="content-type" content=
    "text/html;charset=ISO-8859-1">

    <meta name="generator" content="La Petite Usine &reg;">

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
<img class="module_image" src="icon_browser.jpg">
</td>
</tr>
</table>
</div>

<div class="image_browser_content">

<?php echo $out['info'] ?>


<br/>
	
	
	
	
	
<div>
<?php if ($out['folders']) : ?>
<select size="1" onChange="jump('parent',this,0)">
<?php foreach ($out['folders'] as $folder): ?>

<?php 
if ($folder->path==$path)
{
$selected="selected";
}
else
{
$selected="";
} 

?>

<option value="image_browser.php?path=<?php echo $folder->path ?>&module=<?php echo $module?>&element=<?php echo $element?>" <?php echo $selected ?> ><?php echo  $folder->path ?></option>

<?php endforeach; ?>
</select>
<?php endif; ?>
</div>





<div class="image_browser_margin">

<script language="javascript"><!--
    function fill(the_item_path) 
      {
      opener.document.edit_form.<?php echo $out['element']; ?>.value=the_item_path
      }   
    
    function test_it()
      {
      edit.relations.item_path.value="test"
      }  
  //-->
	</script>
	



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

<?php foreach ($out['files'] as $file) : ?>

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

<img src="<?php echo thumbnail_path($filemanager_id, $file['id']) ?>">

</td>
<td>
<a href="#" onClick="javascript:fill('<?php echo $file['id'] ?>');"><?php echo $file['filename'] ?></a>
</td>
</tr>
<?php endforeach; ?>

</table>
</div>
</div>
</html>