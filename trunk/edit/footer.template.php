      <div class="footer">
        &reg; <a href="http://www.thinkedit.com" class="adress_link">THINKEDIT.COM open source CMS</a>
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
  </body>
</html>
