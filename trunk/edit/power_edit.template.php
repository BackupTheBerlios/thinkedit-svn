<?php
//print_a ($out['power_edit']);
//print_a ($out);
// print_a ($input);
//echo $preferred_locale;
//
?>




	
	
	

<?php if ($out['data']) : ?>



<form action="list.php?module=<?php echo $module ?>" method="post">

<table border="0" width="100%" class="power_table">
<tr>
<?php foreach($out['power_edit']['elements'] as $element) : ?>
<th class="table_header">
<?php echo $element['title'] ?>
</th>
<?php endforeach; ?>
</tr>




<?php foreach($out['data'] as $id=>$data) : ?>
<tr class="">
<?php foreach($out['power_edit']['elements'] as $key=>$element) : ?>
<td class="power_cell power_cell_border">


<?php if ($element['type'] == 'list'): ?>

<select name="input[<?php echo $id ?>][<?php echo $key ?>]" onchange="set_user_changed()">
<?php foreach ($out['filters'][$key]['data'] as $list_item) : ?>

<?php 
if ($data[$preferred_locale][$key]==$list_item['value'])
{
$selected="selected";
}
else
{
$selected="";
}
?>

<option value="<?php echo $list_item['value'] ?>" name="input[<?php echo $id ?>][<?php echo $key ?>]" <?php echo $selected?> >
<?php echo $list_item['label'] ?>
</option>
<?php endforeach; ?>
</select>









<?php elseif ($element['type'] == 'date'): ?>

<input type="text" id="<?php echo $key ?>_<?php echo $id ?>" name="input[<?php echo $id ?>][<?php echo $key ?>]" value="<?php echo $data[$preferred_locale][$key] ?>" size="10" onchange="set_user_changed()"/>

<button id="<?php echo $key ?>_<?php echo $id ?>_trigger">...</button>
	
<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "<?php echo $key ?>_<?php echo $id ?>",      // ID of the input field
      ifFormat    : "y-mm-dd",    // the date format
      button      : "<?php echo $key ?>_<?php echo $id ?>_trigger"    // ID of the button
    }
  );
</script>









<?php else: // we default to simple input box ?>
<input type="text" name="input[<?php echo $id ?>][<?php echo $key ?>]" value="<?php echo $data[$preferred_locale][$key] ?>" size="<?php echo $out['power_edit']['element_html_width'] ?>%" onchange="set_user_changed()">
<?php endif; ?>

</td>
<?php endforeach; ?>

</tr>
<?php endforeach; ?>






</table>
<div class="list_add_button">
<input type="submit" class="action_button" value="<?php echo translate('power_edit_save')?>">
</div>
</form>

<?php else: ?>
<?php echo translate('nothing_in_list') ?>
<?php endif;?>

