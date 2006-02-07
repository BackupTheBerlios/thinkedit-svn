<?php /****************** alpha batch ***************/ ?>
<?php if (isset($out['alpha']['enable'])): ?>
<div class="content_alpha">
<?php else: ?>
<div class="content">
<?php endif; ?>
<table cellpadding="0px" cellspacing="15px" border="0px">
<tr>


<?php /****************** Filters ***************/ ?>
<?php if (isset($out['filters'])): ?>
<td valign="middle">
<form name="filters">
<?php foreach ($out['filters'] as $key=>$filter) : ?>
<select name="<?php echo $key ?>" OnChange="document.location.href=document.filters.<?php echo $key ?>.options[selectedIndex].value">
<option value="">
<?php echo translate('filter_intro') ?>
<?php echo $filter['filter_name'] ?></option>
<option value="<?php echo $_SERVER['PHP_SELF'] ?>?table=<?php echo $table ?>&sort=<?php echo $sort_row ?>&action=remove_filter&filter=<?php echo $key ?>">
<?php echo translate('filter_show_all') ?></option>
<?php foreach ($filter['data'] as $data) : ?>
<option value="<?php echo $_SERVER['PHP_SELF'] ?>?table=<?php echo $table ?>&sort=<?php echo $sort_row ?>&filter=<?php echo $key ?>&action=add_filter&filter_value=<?php echo $data['value'] ?>"
<?php if ($data['selected']) echo "selected";?>">
<?php echo $data['label'] ?></option>
<?php endforeach; ?>
</select>
</td>
<td valign="middle">
<?php endforeach; ?></form>
</td>
<?php endif; ?>



<?php /****************** Power edit ***************/ ?>
<!--
<?php if (!isset($enable_power_edit)): ?>
<td valign="middle">
<table border="0" cellspacing="0" cellpadding="0" class="power_list_tools_table">
<th class="table_list_tools_header">
<a class="white_link" href="list.php?table=<?php echo $table ?>&enable_power_edit=yes"><?php echo translate('power_edit_enable')?></a>
</th>
</table>
</td>
<?php else: ?>
<td valign="middle">
<table border="0" cellspacing="0" cellpadding="0" class="power_list_tools_table">
<th class="table_list_tools_header_on">
<a class="white_link" href="list.php?table=<?php echo $table ?>&enable_power_edit=no"><?php echo translate('power_edit_enable')?></a>
</th>
</table>
</td>
<?php endif; ?>

-->
</tr>
</table>

<!--
current letter : <?php echo $_SESSION[$table]['alpha']['letter'] = $letter ?>

Current page : <?php echo $_SESSION[$table]['batch']['page'] ?>
-->


<?php /****************** Alpha batch ***************/ ?>
<?php if (isset($out['alpha']['enable'])): ?>

<!--
<div class="alpha">
Lettres :
<?php foreach ($out['alpha']['data'] as $letter) : ?>
<?php if ($out['alpha']['letter'] == $letter): ?>

<b><?php echo $letter ?></b> |

<?php else: ?>

<a href="list.php?table=<?php echo $table ?>&letter=<?php echo $letter ?>"><?php echo $letter ?></a> |

<?php endif; ?>  
<?php endforeach; ?>

</div>
-->


<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<img src="icons/batch_bkg.gif" alt="" width="15px" height="19" border="0"></td>
<?php $i=0 ?>
<?php foreach ($out['alpha']['data'] as $letter) : ?>
<?php if ($letter == '') $letter = "..." ?>
<?php if ($out['alpha']['letter'] == $letter): ?>

<?php if ($i == 0): ?>
<td>
<img src="icons/batch_1.gif" alt="" width="2" height="19" border="0"></td>
<?php else: ?>
<td>
<img src="icons/batch_2.gif" alt="" width="3" height="19" border="0"></td>
<?php endif; ?>
<td align="center" valign="middle" width="17" background="icons/batch_on.gif">
<div class="alpha_letters">


<?php echo $letter ?>
</div>
</td>

<?php else: ?>

<?php if ($i == 0): ?>
<td>
<img src="icons/batch_1.gif" alt="" width="2" height="19" border="0"></td>
<?php else: ?>
<td>
<img src="icons/batch_3.gif" alt="" width="3" height="19" border="0"></td>
<?php endif; ?>

<td align="center" valign="middle" width="17" background="icons/batch_off.gif">
<div class="alpha_letters">

<a href="list.php?table=<?php echo $table ?>&letter=<?php echo $letter ?>">
<?php echo $letter ?></a>

</div>
</td>

<?php endif; ?>

<?php $i++ ?>

<?php endforeach; ?>
<td align="center" valign="middle">
<img src="icons/batch_4.gif" alt="" width="3" height="19" border="0"></td>
<td width="100%" background="icons/batch_bkg.gif" width="100%">
<img src="icons/batch_bkg.gif" alt="" width="100%" height="19" border="0"></td>
</tr>
</table>


<?php endif; ?>


<?php if (isset($out['alpha']['enable'])): ?>
</div>
<div class="content_tab">
<?php else: ?>
<?php endif; ?>

<div class="power_margin">

<?php if (isset($out['batch']['enable'])): ?>
<!--
Num of pages : <?php echo $out['batch']['num_of_pages'] ?>
/ 
Current page : <?php echo $out['batch']['current_page'] ?>
-->

<table cellpadding="0" cellspacing="0" border="0" class="power_numbers_table">
<tr>
<?php for ($i=0; $i < $out['batch']['num_of_pages']; $i++) : ?>
<?php if ($out['batch']['current_page'] == $i): ?>

<th class="table_numbers_header_on">
<b>
<?php echo $i+1 ?></b>
</th>

<?php else: ?>

<th class="table_numbers_header">
<a class="number" href="list.php?table=<?php echo $table ?>&page=<?php echo $i ?>">
<?php echo $i+1 ?></a>
</th>

<?php endif; ?>
<?php endfor; ?>
</tr>
</table>
<?php endif; ?>

<!--
<?php if (!$enable_power_edit): ?>	
<a class="power_button" href="list.php?table=<?php echo $table ?>&enable_power_edit=yes"><?php echo translate('power_edit_enable')?></a>
<?php else: ?>
<a class="power_button" href="list.php?table=<?php echo $table ?>&enable_power_edit=no"><?php echo translate('power_edit_disable')?></a>
<?php endif; ?>
-->


<table class="power_table" border="0" cellspacing="0" cellpadding="0">


<tr>


<?php /****************** Thumbnails / icons ***************/ ?>
<?php if (isset($out['enable_thumbnails'])) : ?>
<th class="table_header">
</th>
<?php endif; ?>


<?php /****************** Table header ***************/ ?>

<?php if (isset($out['field'])): ?>
<?php foreach ($out['field'] as $key=>$field) : ?>


<?php /****************** Sorting ***************/ ?>
<?php if (isset ($out['sort_field']) && $key==$out['sort_field']): ?>
<th class="table_header_on">
<?php echo $field['title']; ?>

<?php else: ?>
<th class="table_header">
<?php if (isset($field['sortable'])) : ?>
<a href="<?php echo $field['sort_url']; ?>">
<?php echo $field['title']; ?>
</a>
<?php endif; ?>

<?php endif; ?>


</th>

<?php endforeach; ?>
<?php endif; ?>



<?php /****************** TOOLS ***************/ ?>

<th class="table_header" width="55px">
<?php echo translate('tool_row'); ?></th>



<?php /****************** Order of items ***************/ ?>
<?php if (isset($out['enable_sort'])) : ?>
<th class="table_header" width="60px">
<?php echo translate('sort_row'); ?></th>
<?php endif; ?>
</tr>


<?php  $i=0 ?>


<?php /****************** Data loop ***************/ ?>

<?php if (isset($out['data'])): ?>

<?php foreach ($out['data'] as $id=>$data) : ?>

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

<!-- thumbnails -->
<?php if (isset($out['enable_thumbnails'])) : ?>
<td class="power_cell power_cell_border">
<img src="<?php echo $data['icon']?>"></td>
<?php endif; ?>



<?php 
// little trick, we use the field list instead of the raw datas, so only needed data from the db is displayed
// also, the columns are synced with the headers.
?> 

<?php foreach ($out['field'] as $key=>$field) : ?>



<td class="power_cell power_cell_border" style="cursor:pointer" onClick="document.location.href='<?php echo $data['edit_url']?>'">
<a href="<?php echo $data['edit_url']?>">

<?php echo $data['field'][$key]; ?>


</a>
</td>
<?php endforeach; ?>



<!-- tools follow : -->
<td class="power_cell_border" align="center" width="55px">

<?php if (isset($out['mode']) && $out['mode'] == 'relation'): ?>
<a class="action_url" href="<?php echo $data['relate_url']?>">
<?php echo translate('make_relation'); ?>
</a>
<?php endif; ?>

<a href="<?php echo $data['edit_url']?>">
<img src="ressource/image/icon/small/accessories-text-editor.png" border="0" alt="<?php echo translate('edit'); ?>">
</a>

<a href="<?php echo $data['delete_url']?>" onClick="JavaScript:confirm_link('<?php echo translate('confirm_delete') ?>', '<?php echo $data['delete_url']?>'); return false;">
<img src="ressource/image/icon/small/edit-delete.png" border="0"></a>


<?php if (isset ($out['plugins'])) : ?>

<?php foreach($out['plugins'] as $plugin) : ?>

<?php if ($plugin['use']['tool_row'] == 'true') : ?>
<a target="_blank" href="<?php echo $plugin['plugin_file'] ?>?table=<?php echo $out['table']?>&db_locale=<?php echo get_preferred_locale() ?>">
<img src="icons/<?php echo $plugin['icon']?>"></a>
<?php endif; ?>

<?php endforeach; ?>

<?php endif; ?>

</td>



</td>


<?php if (isset($out['enable_sort'])) : ?>
<td align="center" valign="middle">

<a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&table=<?php echo $out['table']?>&action=move_top">
<img src="./icons/order_top.gif"></a>
<img src="./icons/pixel.gif" width="1" height="1">
<a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&table=<?php echo $out['table']?>&action=move_up">
<img src="./icons/order_up.gif"></a>
<img src="./icons/pixel.gif" width="1" height="1">
<a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&table=<?php echo $out['table']?>&action=move_down">
<img src="./icons/order_down.gif"></a>
<img src="./icons/pixel.gif" width="1" height="1">
<a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&table=<?php echo $out['table']?>&action=move_bottom">
<img src="./icons/order_bottom.gif"></a>
<?php // echo $data[$preferred_locale]['order_by']?>

</td>
<?php endif; ?>



</tr>
<?php endforeach; ?>

<?php /****************** if no data ***************/ ?>

<?php else: ?>
<tr>
<td>
<?php echo translate('nothing_in_list') ?></td>
</tr>
<?php endif; ?>
</tbody>
</table>

<br>

<?php /****************** global tools ***************/ ?>


<?php if (isset($out['global_action'])): ?>
<table border="0" cellspacing="0" cellpadding="0" class="power_list_tools_table">
<?php foreach ($out['global_action'] as $action): ?>
<th class="action_button">
<a class="white_link" href="<?php echo $action['url']?>"><?php echo $action['title']?></a>
</th>
<?php endforeach; ?>
</table>
<?php endif; ?>



</div>

</div>