
      <div class="footer">
			
			&reg; <a href="http://www.thinkedit.org">THINKEDIT.ORG open source CMS</a>
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

			</div>
			
			<?php
			if (function_exists('xdebug_dump_function_profile') && !$thinkedit->isInProduction())
			{
					//xdebug_dump_function_profile(4);
			}
			?>
			
			
			<script type="text/javascript" src="<?php echo ROOT_URL?>/lib/prototype/prototype.js"></script>				
			<script src="thinkedit.js" type="text/javascript"></script>
			
			</body>
			</html>
