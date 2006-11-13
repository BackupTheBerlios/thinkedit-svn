<?php
require_once 'src/stringparser.class.php';
require 'src/stringparser_bbcode.class.php';


$old_text = "ceci est un [b]test[/b] 

je vais à la ligne 

je continue";


$bbcode = new StringParser_BBCode ();
$bbcode->setGlobalCaseSensitive (false);
$bbcode->setRootParagraphHandling (true);
$bbcode->addCode ('b', 'simple_replace', null, array ('start_tag' => '<b>', 'end_tag' => '</b>'), 'inline', array ('block', 'inline'), array ());

// further PHP code


$new_text = $bbcode->parse ($old_text);


echo '<h1>Old text</h1>';
echo '<pre>';
echo $old_text;
echo '</pre>';


echo '<h1>New text</h1>';
//echo '<pre>';
echo $new_text;
//echo '</pre>';



?>
