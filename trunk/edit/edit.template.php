


<?php if (isset($out['wysiwyg_editor_needed'])): ?>
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


	
	
	<script language="javascript"> 
function adjustIFrameSize (iframeWindow) {
  if (iframeWindow.document.height) {
    var iframeElement = parent.document.getElementById(iframeWindow.name);
    iframeElement.style.height = iframeWindow.document.height +  'px';
    }
  else if (document.all) {
    var iframeElement = parent.document.all[iframeWindow.name];
    if (iframeWindow.document.compatMode && iframeWindow.document.compatMode != 'BackCompat') 
    {
      iframeElement.style.height = iframeWindow.document.documentElement.scrollHeight +  5 +  'px';

    }
    else {
      iframeElement.style.height = iframeWindow.document.body.scrollHeight  + 5 +  'px';
    }
  }
}
</script>
		
		
		

<div class="content">

<table width="580px" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td>



			
<div class="detail_margin">


<?php if (isset($out['error'])) :?>
<div class="error"><?php echo translate('error') ?> : <?php echo $out['error'] ?></div>
<?php endif;?>

			
<form name="edit_form" action="<?php echo $out['save_url']?>" method="post" onsubmit="return submitForm();">			

<?php /****************** start field rendering ***********/ ?>

<?php if (isset($out['field'])): ?>

<?php foreach ($out['field'] as $field): ?>
<div class="detail_items_title">
<?php echo $field['title']; ?> :
</div>

<?php echo $field['ui']; ?>
<hr/>
<br/>

<?php endforeach; ?>

<?php endif; ?>

<?php /****************** stop field rendering ***********/ ?>



<?php /****************** Relations ***********/ ?>

<?php if (isset($out['relation'])) : ?>
<div class="detail_items_title">
<?php echo translate('relation'); ?> :
</div>

<iframe src="<?php echo $out['relation']['url']?>" name="relation" width="600" height="200"></iframe>

<?php endif; ?>



<?php if(isset($out['element'])): ?>
<?php foreach ($out['element'] as $element_name=>$element) : ?>			
			
<div class="detail_items_title">
<a name="<?php echo $element['field']; ?>">
<?php echo $element['title']; ?>
</div>			

<div>
<?php echo $element['help']; ?>
</div>





  <?php if ($element['type']=='text'): ?>
	
	
<?php if ($element['wysiwyg']): ?>
<script language="JavaScript" type="text/javascript">
//Usage: writeRichText(fieldname, html, width, height, buttons)
writeRichText('<?php echo $element['field']; ?>', '<?php echo RTESafe($out['data'][$element['field']])?>', 520, 300, true, false);
</script>

<noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

	
	
<?php else: ?>
	<?php $rows = intval( (strlen($out['data'][$element['field']]) / 60) + 3 ) ?>
  <textarea id="<?php echo $element['field']; ?>" name="<?php echo $element['field']; ?>" rows="<?php echo $rows ?>" cols="60"><?php echo $out['data'][$element['field']]?></textarea>
<?php endif; ?>
	
	
	
	
  <?php elseif ($element['type']=='string'): ?>
	
	<?php 
	$size = strlen($out['data'][$element['field']]) + 10;
	if ($size > 80) $size = 80;
	// finally, it is better to use fixed size
	$size = 80;
	?>
  <input type="text" id="<?php echo $element['field']; ?>" size="<?php echo $size ?>" name="<?php echo $element['field']; ?>" value="<?php echo $out['data'][$element['field']]?>" >
  

	
  <?php elseif ($element['type']=='password'): ?>
	
  <input type="password" id="<?php echo $element['field']; ?>" name="<?php echo $element['field']; ?>" value="<?php echo $out['data'][$element['field']]?>" >
  

	
	
	
  <?php elseif ($element['type']=='checkbox'): ?>
	
  <input type="checkbox" id="<?php echo $element['field']; ?>" name="<?php echo $element['field']; ?>" <?php if ($out['data'][$element['field']] > 0) echo 'checked' ?> >
  

	

	
	
	
	<?php elseif ($element['type']=='list'): ?>
  <select name="<?php echo $element['field']; ?>">

    <?php foreach ($element['combo'] as $combo) : ?>
      <?php if ($out['data'][$element['field']] == $combo['value']): ?>
      <option value="<?php echo $combo['value']; ?>" selected="selected"><?php echo $combo['label']; ?></option>
      <?php else: ?>
      <option value="<?php echo $combo['value']; ?>"><?php echo $combo['label']; ?></option>
      <?php endif; ?>
    <?php endforeach; ?>

  </select>


<a class="action_button" href="<?php echo $element['manage_list_url'] ?>" target="_blank"><?php echo translate('edit_manage_list_button') ?></a>




  <?php elseif ($element['type']=='image'): ?>
   
	 
	 <!--<img src="<?php echo $element['path']; ?>/<?php echo $out['data'][$element['field']]?>.interface" border="0"><br> -->
<div>
	 <img src="<?php echo thumbnail_path($element['source'], $out['data'][$element['field']]) ?>">
</div>	 

<!--<?php echo $element['path']; ?>-->

<!--<div style="visibility:hidden">-->
	 <input class="input" type="text" name="<?php echo $element['field']; ?>" value="<?php echo $out['data'][$element['field']]?>" size="50">
<!--</div>	--> 
	 <a href="image_browser.php?table=<?php echo $element['source']?>&element=<?php echo $element['field'] ?>" target="_blank" onClick="javascript: 
        find_window=window.open('image_browser.php?table=<?php echo $element['source']?>&element=<?php echo $element['field'] ?>','find','scrollbars=yes, toolbar=no,top=105,left=145,width=250,height=500,alwaysRaised, resizable=yes'); return false;" class="action_button">
<?php echo translate('browse_button') ?>
</a>	


<?php elseif ($element['type']=='date'): ?>



<input class="input" type="text" id="<?php echo $element['field']; ?>" name="<?php echo $element['field']; ?>" value="<?php echo $out['data'][$element['field']]?>"/>


<button id="<?php echo $element['field']; ?>_trigger">...</button>
	
	<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "<?php echo $element['field']; ?>",      // ID of the input field
      ifFormat    : "y-mm-dd",    // the date format
      button      : "<?php echo $element['field']; ?>_trigger"    // ID of the button
    }
  );
</script>
	


  <?php elseif ($element['type']=='relation'): ?>
	 
	 <div class="relation">
	 <p>
	 
	 

	 
	 
	 <iframe name="<?php echo $element['field']; ?>" id="<?php echo $element['field']; ?>" 
scrolling="no" width="500" frameborder="0" marginheight="0"
marginwidth="0" src="relation.php?table=<?php echo $table ?>&element=<?php echo $element['field']; ?>&id=<?php echo $_REQUEST['id']; ?>">
	 </iframe>
	 </div>
	 
	 
	<?php elseif ($element['type']=='color'): ?> 

	<?php require_once('colors.inc.php'); ?>
	

	
	<select name="<?php echo $element['field']; ?>">

	<option style="background: #<?php echo $out['data'][$element['field']]; ?>" value="<?php echo $out['data'][$element['field']]; ?>" selected="selected"><?php echo $out['data'][$element['field']]; ?></option>

	<?php foreach ($colors as $color): ?>
      <option style="background: #<?php echo $color; ?>" value="<?php echo $color; ?>"><?php echo $color; ?></option>
	<?php endforeach; ?>
	
	
	</select>
	
	<table width="20" height="20">
	<tr>
	<td bgcolor="#<?php echo $out['data'][$element['field']] ?>">&nbsp;</td>
	</tr>
	</table>
	 
	 
  <?php elseif ($element['type']=='filename'): ?>
	Image ou ic�ne ici pour le filemanager
	 
	 
		 
	<?php elseif ($element['type']=='plugin'): ?> 

	<?php require_once($element['plugin_file']); ?>
	
 
	 
	 
  <?php else: ?>
  <?php echo translate('not_yet') ?>
  <?php endif; ?>



<hr/>
<br/>

<?php endforeach; ?>			
<?php endif; ?>
<input class="action_button" type="submit" value="<?php echo translate('save_button') ?>" name="save">
<input class="action_button" type="submit" value="<?php echo translate('save_and_return_to_list_button') ?>" name="save_and_return_to_list">

</form>
		
			</div>
</div>
</td></tr>
</table>