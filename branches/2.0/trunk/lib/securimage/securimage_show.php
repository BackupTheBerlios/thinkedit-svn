<?php

include("securimage.php");

$img = new securimage();
$img->text_color = 1;
$img->draw_lines = false;
$img->draw_angled_lines = false;
$img->code_length = 4;
//$img->show("trees.jpg");
$img->show();

?>
