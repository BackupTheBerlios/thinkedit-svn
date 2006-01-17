
<script LANGUAGE="JavaScript">
<!--

function jump(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>



<div class="content">


<div class="path_chooser">

<?php if (isset($out['folders'])) : ?>
<select size="1" onChange="jump('parent',this,0)">
<?php foreach ($out['folders'] as $folder): ?>

<?php 
if (isset($folder['current']))
{
$selected='selected = "selected"';
}
else
{
$selected='';
} 

?>

<option value="<?php echo $folder['url'] ?>" <?php echo $selected ?> ><?php echo  $folder['path'] ?></option>

<?php endforeach; ?>
</select>
<?php endif; ?>

</div>




<div class="power_margin">

<?php if (isset($out['files'])) : ?>

<table class="power_table" border="0" cellspacing="0" cellpadding="0">
<?php  $i=0 ?>

<?php foreach ($out['files'] as $file): ?>


<?php 
// used to alternate rows, of course)
if (($i % 2)==0)
{
$class = "tr_off";
}
else
{
$class = "tr_on";
}
$i++;

?>

<tr class="<?php echo $class?>">

<td class="power_cell power_cell_border">
<img class="preview" src="<?php echo $file['icon']; ?>">
</td>

<td class="power_cell power_cell_border">
<?php echo  $file['filename'] ?>
</td>

<td class="power_cell power_cell_border" style="cursor:pointer">
<a href="<?php echo $file['delete_url']?>"><?php echo translate('file_delete'); ?></a>
<?php /* <a href="edit.php?id=<?php echo  $file['id'] ?>&module=<?php echo $filemanager_id?>">[edit details]</a> */?>
</td>

</tr>
<?php endforeach; ?>

</table>
<?php else: ?>
<?php echo translate('folder_empty')?>
<?php endif; ?>

</div>


<div class="file_actions">

<p>
<form action="<?php echo $out['upload_file_url']?>" enctype="multipart/form-data" method="post">
<input type="file" name="uploaded_file" class="action_button" size="30">
<button class="action_button" type="submit"><?php echo translate('upload_file_button') ?></button>
</form>
</p>

<p>
<form action="<?php echo $out['add_folder_url']?>" method="post">
<input type="text" name="folder_name"  size="30">
<button class="action_button" type="submit"><?php echo translate('create_folder_button') ?></button>
</form>
</p>


</div>




</div>
