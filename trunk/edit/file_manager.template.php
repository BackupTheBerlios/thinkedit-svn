
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

<option value="file_manager.php?path=<?php echo $folder->path ?>&module=<?php echo $filemanager_id?>" <?php echo $selected ?> ><?php echo  $folder->path ?></option>

<?php endforeach; ?>
</select>
<?php endif; ?>

</div>




<div class="power_margin">

<?php if ($out['files']) : ?>

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

<td class="power_cell power_cell_border" style="cursor:pointer">
<?php if ($file['is_image']): ?>

<img class="preview" src="resize/phpthumb.php?src=<?php echo $file['url']; ?>&w=<?php echo $file['width']; ?>&h=<?php echo $file['height']; ?>">

<!--
<img class="preview" src="<?php echo thumbnail_path($filemanager_id, $file['id']) ?>">
-->


<?php else: ?>
<img src="./icons/extensions/<?php echo  $file['icon'] ?>">
<?php endif; ?>
</td>

<td class="power_cell power_cell_border" style="cursor:pointer">
<?php echo  $file['filename'] ?>
</td>

<td class="power_cell power_cell_border" style="cursor:pointer">
<a href="file_manager.php?path=<?php echo $path ?>&file_to_delete=<?php echo  $file['filename'] ?>&action=delete&module=<?php echo $filemanager_id?>">[delete]</a>
<?php /* <a href="edit.php?id=<?php echo  $file['id'] ?>&module=<?php echo $filemanager_id?>">[edit details]</a> */?>
</td>

</tr>
<?php endforeach; ?>

</table>
<?php else: ?>
No files yet
<?php endif; ?>

</div>


<div class="file_actions">


<form action="file_manager.php?path=<?php echo $path?>&module=<?php echo $filemanager_id?>" enctype="multipart/form-data" method="post">
<input type="file" name="uploaded_file" class="action_button" size="10">
<button class="action_button" type="submit">Add this file</button>
</form>

<p>

<a class="action_button" href="file_manager.php?action=sync&path=<?php echo $path?>&module=<?php echo $filemanager_id?>">Sync with ftp server</a>

</div>




</div>
