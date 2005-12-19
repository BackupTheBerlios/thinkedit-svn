<?php
  require_once '../thinkedit.init.php';

	
  $db = $thinkedit->getDb();

  echo '<pre>';
  print_r ($db->select("select * from article where id='1'"));

  print_r ($db->select("select * from article"));

	
	
	// 
	
	if (!$db->hasTable('test2'))
	{
			$db->createTable('test2');
	}
	
?>