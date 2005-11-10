<?php
  require_once '../init.inc.php';
  require_once '../class/node.class.php';
  require_once '../class/module.sql.class.php';
  require_once '../class/browser.class.php';


  //print_r($thinkedit->config);

  $root = new node(1);

  $browser = new browser($root);

  echo $browser->render();




?>