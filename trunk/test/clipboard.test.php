<?php
require_once '../thinkedit.init.php';
require_once ROOT . '/class/clipboard.class.php';

echo '<pre>';

$root = $thinkedit->newNode();

$root->loadRootNode();

$tmp = $thinkedit->newRecord('page');
$tmp->setTitle('testing_clipboard');
$tmp->save();

$tmp_node = $root->add($tmp);


$tmp2 = $thinkedit->newRecord('page');
$tmp2->setTitle('testing_clipboard 2, in root later');
$tmp2->save();

$tmp_node2 = $tmp_node->add($tmp2);


// now we try to mode tmp_node2 into root

$clipboard = new clipboard();

$clipboard->clear();

$clipboard->cut($tmp_node2);

$clipboard->paste($root);

echo $clipboard->debug();

print_r($_SESSION);



/*
$tmp_node->delete();
$tmp_node2->delete();
*/
?>
