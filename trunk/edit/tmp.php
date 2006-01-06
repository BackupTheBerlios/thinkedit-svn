 
	 
	 
	 
	 		 <?php else: ?>
		     <?php if (! is_null($data[$the_locale])) : ?>
	             <a class="translated" href="edit.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $the_locale ?>"><img src="./icons/<?php echo $the_locale ?>.on.gif"></a>
	       <?php else : ?>
		        <a class="not_translated" href="add.php?id=<?php echo $data[$preferred_locale]['id']?>&module=<?php echo $out['module']?>&db_locale=<?php echo $the_locale ?>"><img src="./icons/<?php echo $the_locale ?>.off.gif"></a>
		     <?php endif; ?>


	   <?php endif; ?>
  
	
	 <?php endforeach; ?>
	 
	 <?php endif; ?>