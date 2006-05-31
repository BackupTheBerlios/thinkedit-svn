<?php
  require_once '../init.inc.php';
  require_once '../class/browser.class.php';
  require_once '../class/url.class.php';
  require_once '../class/node.class.php';

  $url = new url();


  if ($url->getParam('id'))
  {
    $id = $url->getParam('id');
  }
  else
  {
    $id = 1;
  }

  //  $node = new node($id);

  $node = new node($id);

  $browser = new browser($node);


  // because we are in a test folder todo : fix path handling, find a VERY GOOD solution
  $browser->setDecorationPath('../decoration/');

  echo $browser->render();

?>