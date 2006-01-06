<script language="JavaScript">
<!--

function confirm_link(message, url)
{
input_box=confirm(message);
if (input_box==true)

{ 
// Output when OK is clicked
window.location.href=url; 
}

else
{
return false;
}

}
-->
</script>



<?php if ($out['alpha']['enable']): ?>
<div class="content_alpha">
<?php else: ?>
<div class="content">
<?php endif; ?>
  	<table cellpadding="0px" cellspacing="15px" border="0px">
<tr>
			 <?php if ($out['filters']): ?>
			 <td valign="middle">

									<form name="filters">

  											<?php foreach ($out['filters'] as $key=>$filter) : ?>
   														 <select name="<?php echo $key ?>" OnChange="document.location.href=document.filters.<?php echo $key ?>.options[selectedIndex].value">
															 <option value=""><?php echo translate('filter_intro') ?> <?php echo $filter['filter_name'] ?></option>
															 <option value="<?php echo $_SERVER['PHP_SELF'] ?>?module=<?php echo $module ?>&sort=<?php echo $sort_row ?>&action=remove_filter&filter=<?php echo $key ?>"><?php echo translate('filter_show_all') ?></option>		
												<?php foreach ($filter['data'] as $data) : ?>
      												 <option value="<?php echo $_SERVER['PHP_SELF'] ?>?module=<?php echo $module ?>&sort=<?php echo $sort_row ?>&filter=<?php echo $key ?>&action=add_filter&filter_value=<?php echo $data['value'] ?>"
															 <?php if ($data['selected']) echo "selected" ; ?> >
															 <?php echo $data['label'] ?></option>
															 <?php endforeach; ?>
															 </select>
															 </td><td valign="middle">
															 <?php endforeach; ?>
															 </form>
									
			 </td>
			 <?php endif; ?>

				<?php if (!$enable_power_edit): ?>
			  <td valign="middle">
					<table border="0" cellspacing="0" cellpadding="0" class="power_list_tools_table">
							<th class="table_list_tools_header">
									<a class="white_link" href="list.php?module=<?php echo $module ?>&enable_power_edit=yes"><?php echo translate('power_edit_enable')?></a>
							</th>
					</table>
				</td>
				<?php else: ?>
				<td valign="middle">
					<table border="0" cellspacing="0" cellpadding="0" class="power_list_tools_table">
							<th class="table_list_tools_header_on">
								  <a class="white_link" href="list.php?module=<?php echo $module ?>&enable_power_edit=no"><?php echo translate('power_edit_enable')?></a>
							</th>
					</table>
				</td>
			 <?php endif; ?>

</tr>
</table>

<!--
current letter : <?php echo $_SESSION[$module]['alpha']['letter'] = $letter ?>

Current page : <?php echo $_SESSION[$module]['batch']['page'] ?>
-->



<?php if ($out['alpha']['enable']): ?>

<!--
<div class="alpha">
Lettres :
<?php foreach ($out['alpha']['data'] as $letter) : ?>
  <?php if ($out['alpha']['letter'] == $letter): ?>

    <b><?php echo $letter ?></b> |

  <?php else: ?>
  
	  <a href="list.php?module=<?php echo $module ?>&letter=<?php echo $letter ?>"><?php echo $letter ?></a> |
  
	<?php endif; ?>  
<?php endforeach; ?>

</div>
-->


<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="icons/batch_bkg.gif" alt="" width="15px" height="19" border="0"></td>
<?php $i=0 ?>
<?php foreach ($out['alpha']['data'] as $letter) : ?>
<?php if ($letter == '') $letter = "..." ?>
<?php if ($out['alpha']['letter'] == $letter): ?>

	<?php if ($i == 0): ?>
	<td><img src="icons/batch_1.gif" alt="" width="2" height="19" border="0"></td>
	<?php else: ?>
	<td><img src="icons/batch_2.gif" alt="" width="3" height="19" border="0"></td>
	<?php endif; ?>
	<td align="center" valign="middle" width="17" background="icons/batch_on.gif">
					<div class="alpha_letters">
	
	
	<?php echo $letter ?>
				  </div>
	</td>
	
  <?php else: ?>

	<?php if ($i == 0): ?>
	<td><img src="icons/batch_1.gif" alt="" width="2" height="19" border="0"></td>
	<?php else: ?>
	<td><img src="icons/batch_3.gif" alt="" width="3" height="19" border="0"></td>
	<?php endif; ?>	
	
  <td align="center" valign="middle" width="17" background="icons/batch_off.gif">
					<div class="alpha_letters">
					
	  <a href="list.php?module=<?php echo $module ?>&letter=<?php echo $letter ?>"><?php echo $letter ?></a>
  		 		
					</div>
	</td>
				
	<?php endif; ?>
	
	<?php $i++ ?>
			
<?php endforeach; ?>
			<td align="center" valign="middle"><img src="icons/batch_4.gif" alt="" width="3" height="19" border="0"></td>
			<td width="100%" background="icons/batch_bkg.gif" width="100%"><img src="icons/batch_bkg.gif" alt="" width="100%" height="19" border="0"></td>
		</tr>
</table>

		
<?php endif; ?>	


<?php if ($out['alpha']['enable']): ?>
</div>
<div class="content_tab">
<?php else: ?>
<?php endif; ?>	

<div class="power_margin">

<?php if ($out['batch']['enable']): ?>
<!--
Num of pages : <?php echo $out['batch']['num_of_pages'] ?>
 / 
Current page : <?php echo $out['batch']['current_page'] ?>
-->

<table cellpadding="0" cellspacing="0" border="0" class="power_numbers_table">
<tr>				
<?php for ($i=0; $i < $out['batch']['num_of_pages']; $i++) : ?>
  <?php if ($out['batch']['current_page'] == $i): ?>

    <th class="table_numbers_header_on"><b><?php echo $i+1 ?></b></th>

  <?php else: ?>
  
	  <th class="table_numbers_header"><a class="number" href="list.php?module=<?php echo $module ?>&page=<?php echo $i ?>"><?php echo $i+1 ?></a></th>
  
	<?php endif; ?>  
<?php endfor; ?>
</tr>
</table>
<?php endif; ?>

<!--
<?php if (!$enable_power_edit): ?>	
<a class="power_button" href="list.php?module=<?php echo $module ?>&enable_power_edit=yes"><?php echo translate('power_edit_enable')?></a>
<?php else: ?>
<a class="power_button" href="list.php?module=<?php echo $module ?>&enable_power_edit=no"><?php echo translate('power_edit_disable')?></a>
<?php endif; ?>
-->

<!-- check if we have the poweredit -->
<?php if (!$enable_power_edit): ?>	


		
<table class="power_table" border="0" cellspacing="0" cellpadding="0">


<tr>


<?php if ($out['enable_thumbnails']) : ?>
<th class="table_header">
Icon
</th>
<?php endif; ?>

<?php if ($out['element']): ?>
<?php foreach ($out['element'] as $key=>$element) : ?>

<?php if ($key==$sort_field): ?>
<th class="table_header_on">
<?php echo $element['title']; ?>

<?php else: ?>
<th class="table_header" style="cursor:pointer" onClick="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?module=<?php echo $module ?>&sort=<?php echo $key ?>'">
<a href="<?php echo $_SERVER['PHP_SELF'] ?>?module=<?php echo $module ?>&sort=<?php echo $key ?>"><?php echo $element['title']; ?></a>
<?php endif; ?>	 

   
   </th>
   
<?php endforeach; ?>   
<?php endif; ?>

										




<?php if ($enable_publish): ?>	
	 <?php foreach (get_all_locales() as $the_locale): ?>
	 <th class="table_header">
	 <?php echo $the_locale ?>
	 </th>
	 <?php endforeach; ?>

<?php endif; ?>

<th class="table_header"  width="55px">
   <?php echo translate('tool_row'); ?>
</th>




<?php if ($out['enable_sort']) : ?>
<th class="table_header" width="60px">
   <?php echo translate('sort_row'); ?>
</th>
<?php endif; ?>
</tr>


<?php  $i=0 ?>

<?php if ($out['data']): ?>
<?php foreach ($out['data'] as $id=>$data) : ?>



<?php 
//print_a( $data);

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

<?php 
// define prefered locale for the current item;

//	 $preferred_locale ;
	 
	 
	 if (! is_null($data[get_main_locale()]))
	 {
	 $preferred_locale = get_main_locale();
	 }
	 else
	 {
	 // a revoir !!!!
	 $loc = each ($data);
	 $preferred_locale = $loc[0];
	 }
	 
	 if (!$out['multilingual'])
	 {
	 $preferred_locale = 'int';
	 }



?>


<tr class="<?php echo $class?>">

<?php if ($out['enable_thumbnails']) : ?>
<td class="power_cell power_cell_border">
<img src="<?php echo thumbnail_path($module, $id) ?>">
</td>
<?php endif; ?>



   <?php 
   // little trick, we use the element list instead of the raw datas, so only needed data from the db is displayed
   // also, the columns are synced with the headers. 
   foreach ($out['element'] as $key=>$element) : ?>
   
	 
	 
	 
	 
	 <!--<td class="power_cell power_cell_border" style="cursor:pointer" onClick="document.location.href='edit.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $preferred_locale?>'"> -->
   
	 <td class="power_cell power_cell_border" style="cursor:pointer" onClick="document.location.href='edit.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>'">
	 
	 
	 <!-- <a href="edit.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $preferred_locale?>"> -->
	 
	 
	 <a href="edit.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>">
	
	<?php if ($element['type']=='image') : ?>
  
	<img src="<?php echo $element['path'] ?>/<?php echo $data[$preferred_locale][$key] ?>.interface" border="0"> <?php echo $data[$preferred_locale][$key] ?>
	
	<?php else : ?>
	
	      <?php  if ($preferred_locale == get_main_locale() or !$out['multilingual']): ?>
	 
	          <?php echo $data[$preferred_locale][$key]; ?>
	 
	      <?php else: ?>
	 
	          [<?php echo $data[$preferred_locale][$key]?>]
	 
	      <?php endif;?>
	 
	 <?php endif; ?>
	 	 
	 </a> 
	 </td>
   
	 <?php endforeach; ?>
	 
	 
	 
	 
	 
	 <?php if ($enable_publish): ?>
	 
	 <?php // if we have a site with more than one locale ?>
	 <?php if (get_num_locales() > 1) : ?>
	 
	   <?php foreach (get_all_locales() as $the_locale): ?>

	 
       <?php if	(isset($data[$the_locale]['publish'])) : ?>
	 	 <td class="power_cell_border" align="center" >
		 
		 <table align="left" width="13" height="13">
		 <tr>
		 <td bgcolor="#<?php echo $out['publish'][$data[$the_locale]['publish']]['color'] ?>"></td>
		 </tr>
	 	 </table>

		 		 
		 
		 
		 
		 <a href="edit.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $the_locale ?>"><?php echo $out['publish'][$data[$the_locale]['publish']]['code'] ?></a>
       <?php else : ?>
	 	 <td class="power_cell_border" align="center">
     <a class="action_button" href="add.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $the_locale ?>"><?php echo translate('add_element_button')?></a>   
	     <?php endif; ?>
	 </td>

	   <?php endforeach; ?>
		 
	<?php else: ?>
	
	
	<?php 
	$the_locale = "int";
	$preferred_locale = 'int';
	 ?>
	 
	 
	 <?php if	(isset($data[$the_locale]['publish'])) : ?>
	 	 <td class="power_cell_border" align="center" >
		 
		 <table align="left" width="13" height="13">
		 <tr>
		 <td bgcolor="#<?php echo $out['publish'][$data[$the_locale]['publish']]['color'] ?>"></td>
		 </tr>
	 	 </table>

		 		 
		 
		 
		 
		 <a href="edit.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $the_locale ?>"><?php echo $out['publish'][$data[$the_locale]['publish']]['code'] ?></a>
       <?php else : ?>
	 	 <td class="power_cell_border" align="center">
     <a class="action_button" href="add.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $the_locale ?>"><?php echo translate('add_element_button')?></a>   
	     <?php endif; ?>
	 </td>
	
	
	
	<?php endif; ?>	 

<?php endif; ?> 

	 
	 <!-- tools follow : -->
	 <td class="power_cell_border" align="center" width="55px">
	 
	 <a href="delete.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo get_preferred_locale()?>" onClick="JavaScript:confirm_link('<?php echo translate('confirm_delete') ?>', 'delete.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo get_preferred_locale() ?>'); return false;"><img src="trash.gif" border="0"></a>
	 
	 
	 <?php if (isset ($out['plugins'])) : ?>

<?php foreach($out['plugins'] as $plugin) : ?>

<?php if ($plugin['use']['tool_row'] == 'true') : ?>
<a target="_blank" href="<?php echo $plugin['plugin_file'] ?>?module=<?php echo $out['module']?>&db_locale=<?php echo get_preferred_locale() ?>">
<img src="icons/<?php echo $plugin['icon']?>">
</a>
<?php endif; ?> 

<?php endforeach; ?>

<?php endif; ?>
	 
	 </td>

	
	 
	 </td>
	 
	 
<?php if ($out['enable_sort']) : ?>
	 <td align="center" valign="middle">
 
<a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&action=move_top"><img src="./icons/order_top.gif"></a><img src="./icons/pixel.gif" width="1" height="1"><a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&action=move_up"><img src="./icons/order_up.gif"></a><img src="./icons/pixel.gif" width="1" height="1"><a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&action=move_down"><img src="./icons/order_down.gif"></a><img src="./icons/pixel.gif" width="1" height="1"><a href="change_order.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&action=move_bottom"><img src="./icons/order_bottom.gif"></a>	 
	    <?php // echo $data[$preferred_locale]['order_by']?>
	 
	 </td>
<?php endif; ?>


	 
</tr>   
<?php endforeach; ?>   

<?php else: ?>
<tr>
<td>
<?php echo translate('nothing_in_list') ?>
</td>
</tr>
<?php endif; ?>
</tbody></table>

<br>


			 

			<?php if ($out['buttons'] <> 'false') : ?>
			<table border="0" cellspacing="0" cellpadding="0" class="power_list_tools_table">
			 <th class="action_button">
			 <a class="white_link" href="add.php?module=<?php echo $out['module']?>&db_locale=<?php echo get_preferred_locale() ?>">Ajouter</a>
			 </th>


<!-- affichage des boutons plug-in's -->
<?php if (isset ($out['plugins'])) : ?>

<?php foreach($out['plugins'] as $plugin) : ?>

<?php if ($plugin['use']['list'] == 'true') : ?>
<th class="action_button">
<a class="white_link" target="_blank" href="<?php echo $plugin['plugin_file'] ?>?module=<?php echo $out['module']?>&db_locale=<?php echo get_preferred_locale() ?>">
<?php echo $plugin['title'][$interface_locale] ?>
</a></th>
<?php endif; ?> 

<?php endforeach; ?>

<?php endif; ?>

</table>
<?php endif; ?> 

<!-- affichage du "Power edit" si il est activé-->
<?php else: ?>


<?php include('power_edit.template.php'); ?>


<?php endif; ?>

</div>
		
</div>