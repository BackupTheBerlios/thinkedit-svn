      <div class="footer">
        &reg; <a href="http://www.thinkedit.org" class="adress_link">THINKEDIT.ORG open source CMS</a>
				| 
				<?php 
				$db = $thinkedit->getDb();
				echo $db->getTotalQueries() ;
				?> queries.
				| 
				<?php
				$timer = $thinkedit->getTimer();
				echo $timer->render(); 
				?>
				elapsed time
				
    </div>
		</td>
		</tr>
	</table>
	
	<?php
	if (function_exists('xdebug_dump_function_profile') && !$thinkedit->isInProduction())
	{
			//xdebug_dump_function_profile(4);
	}
	?>

  </body>
</html>
