<?php
include_once('common.inc.php');

//check_user
check_user();


$root = $thinkedit->newNode();

$root->loadRootNode();

// include template :
include('header.template.php');
include('structure2.template.php');
include('footer.template.php');
?>
