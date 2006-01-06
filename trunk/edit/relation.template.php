<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>

    <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />

    <meta name="generator" content="La Petite Usine &reg;"/>

    <title>
        </title>

    <link type="text/css" href="style.css" rel="stylesheet"
    media="screen"/>


		
<script LANGUAGE="JavaScript">
<!--

function jump(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

		
		
		
  </head>
  <body class="white" onLoad="if (parent.adjustIFrameSize) parent.adjustIFrameSize(window);">


	<div class="path_chooser">

<?php if ($out['folders']) : ?>
<select size="1" onChange="jump('window',this,0)">
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

<option value="<?php echo $out['url'] ?>&path=<?php echo $folder->path ?>" <?php echo $selected ?> ><?php echo  $folder->path ?></option>

<?php endforeach; ?>
</select>
<?php endif; ?>

</div>
	
	
<table class="power_table" border="0" cellspacing="0" cellpadding="0">
			<tr class="relation_inset" height="100%">
				<td valign="top" height="100%">
					<table class="relation_inset" border="0" cellspacing="0" cellpadding="0" height="100%">
						<tr>
							<td class="table_header"><?php echo translate('relations_available_elements') ?></td>
						</tr>
						<tr>
							<td  valign="top" height="100%">
								<table class="relation_table" border="0" cellspacing="0" cellpadding="2">
									
								<?php if (is_array($out['source'])): ?>
								
								<?php  $i=0 ?>
								
								<?php foreach ($out['source'] as $source): ?>
								
								
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

									<tr class="<?php echo $class?>" style="cursor:pointer" onClick="document.location.href='<?php echo $out['url'] . '&action=relate&relate_to='. $source['id'] ?>'">
										<td width="100%">
										<?php if ($out['enable_thumbnails']) : ?>
										<!--<img src="thumbnail.php?file_id=<?php echo $source['id'] ?>">-->
										<img src="<?php echo thumbnail_path($source_module, $source['id']) ?>">
										<td>
										<?php echo $source['title'] ?>
										</td>
										
										<?php else: ?>
										<?php echo $source['title'] ?>
										<?php endif; ?>
										
										</td>
										<td><a href="<?php echo $out['url'] . '&action=relate&relate_to='. $source['id'] ?>">--&gt;</a></td>
									</tr>
								<?php endforeach; ?>
								
								<?php else: ?>
								<tr><td>
								<?php echo translate('nothing_in_list') ?>
								</td></tr>
								<?php endif; ?>
								
									
								</table>
							</td>
						</tr>
					</table>
				</td>
				
				
				
				<td valign="top" width="10" height="100%"></td>
				
				
				
				<td valign="top" height="100%">
					<table class="relation_inset" border="0" cellspacing="0" cellpadding="0" height="100%">
						<tr>
							<td class="table_header"><?php echo translate('relations_selected_elements') ?></td>
						</tr>
						<tr>
							<td valign="top" height="100%">
								<table class="relation_table" border="0" cellspacing="0" cellpadding="2">
									
								<?php if (is_array($out['existing'])): ?>
								
								<?php  $i=0 ?>
								
								<?php foreach ($out['existing'] as $existing): ?>
								
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

									<tr class="<?php echo $class ?>" style="cursor:pointer">
										<td onClick="document.location.href='<?php echo $out['url'] . '&action=unrelate&unrelate_to='. $existing['id'] ?>'"><a href="<?php echo $out['url'] . '&action=unrelate&unrelate_to='. $existing['id'] ?>"><--</a></td>
									  <td onClick="document.location.href='<?php echo $out['url'] . '&action=unrelate&unrelate_to='. $existing['id'] ?>'">
									<a href="<?php echo $out['url'] . '&action=unrelate&unrelate_to='. $existing['id'] ?>">
										
										<?php if ($out['enable_thumbnails']) : ?>
										<!--<img src="thumbnail.php?file_id=<?php echo $existing['id'] ?>">-->
										<img src="<?php echo thumbnail_path($source_module, $existing['id']) ?>">
									
									</a>
										
										<td>
										<a href="<?php echo $out['url'] . '&action=unrelate&unrelate_to='. $existing['id'] ?>">
										<?php echo $existing['title'] ?>
										</a>
										</td>
										
										<?php else: ?>
										<a href="<?php echo $out['url'] . '&action=unrelate&unrelate_to='. $existing['id'] ?>">
										<?php echo $existing['title'] ?>
										</a>
										<?php endif; ?>
										 <!--(<?php echo $existing['order'] ?> )-->
										</td>
										<td>
										
										<?php if ($out['enable_sort']): ?>
															
										<a href="<?php echo $out['url']?>&action=move_top&item_to_move=<?php echo $existing['id'] ?>"><img src="./icons/order_top.gif"></a><a href="<?php echo $out['url']?>&action=move_up&item_to_move=<?php echo $existing['id'] ?>"><img src="./icons/order_up.gif"></a><a href="<?php echo $out['url']?>&action=move_down&item_to_move=<?php echo $existing['id'] ?>"><img src="./icons/order_down.gif"></a><a href="<?php echo $out['url']?>&action=move_bottom&item_to_move=<?php echo $existing['id'] ?>"><img src="./icons/order_bottom.gif"></a>
										
										
										<?php endif; ?>
										
										</td>
									</tr>
								<?php endforeach; ?>
								
								<?php else: ?>
								<tr><td>
								<?php echo translate('nothing_in_list') ?>
								</td></tr>
								<?php endif; ?>
								
									
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		
</body>
</html>