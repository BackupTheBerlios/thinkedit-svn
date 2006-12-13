<div class="content">

<div class="filemanager_panels">


<div class="filemanager_panel">
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


<div class="filemanager_panel">
<form action="<?php echo $out['upload_file_url']?>" enctype="multipart/form-data" method="post">
<input type="file" class="filemanager_panels_input" name="uploaded_file" >
<button type="submit"><?php echo translate('upload_file_button') ?></button>
</form>
</div>

<div class="panel">
<form action="<?php echo $out['add_folder_url']?>" method="post">
<input type="text">
<button type="submit"><?php echo translate('create_folder_button') ?></button>
</form>
</div>


</div>




<!-- ///////////// File listing ///////////// -->



<?php if (isset($out['files'])) : ?>

<table class="list">
<?php  $i=0 ?>

<?php foreach ($out['files'] as $file): ?>


<?php 
// used to alternate rows, of course)
if (($i % 2)==0)
{
$class = "off";
}
else
{
$class = "on";
}
$i++;

?>

<tr class="<?php echo $class?>">

<td>
<img class="preview" src="<?php echo $file['icon']; ?>">
</td>

<td width="100%">
<div class="filename"><?php echo  $file['filename'] ?></div>
</td>

<td class="last_column">

<a href="<?php echo $file['delete_url']?>" onClick="JavaScript:confirm_link('<?php echo translate('confirm_delete') ?>', '<?php echo $file['delete_url']?>'); return false;">
<img class="trash" src="ressource/image/icon/small/edit-delete.png" border="0" alt="<?php echo translate('file_delete'); ?>">
</a>
</td>

</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<?php echo translate('folder_empty')?>
<?php endif; ?>


</div>
