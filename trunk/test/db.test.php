<?php
  require_once '../class/db.class.php';

  $db = new db('localhost', 'philippe', 'popol', 'philippe');

  echo '<pre>';
  print_r ($db->query("select * from article where id='1'"));

  print_r ($db->query("select * from article"));

?>