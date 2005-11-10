<?php
require_once '../init.inc.php';
require_once '../class/pager.class.php';
// require_once '../class/session.class.php';
// $session = new session();

// uncomment the lines about session in order to have a persistent pager (within a session)



$pager = new pager();
$pager->setId('test_pager');
$pager->setTotal(100);
$pager->enablePaginationDropDown();

// $session->persist($pager);


echo $pager->render();

echo '<hr>';
echo 'Current page is : ' . $pager->getCurrentPage();

?>
