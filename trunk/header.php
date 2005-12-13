<?php
$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');


$menu = '<a href="' . $url->render('content.php') . '">' . translate('content') . '</a>';
$menu .= ' | ';
$menu .= '<a href="' . $url->render('structure.php') . '">' . translate('structure') . '</a>';
$menu .= ' | ';
$menu .= '<a href="' . $url->render('files.php') . '">' . translate('files') . '</a>';
$menu .= ' | ';
$menu .= '<a href="' . $url->render('help.php') . '">' . translate('help') . '</a>';

$page->startPanel('menu', 'menu');
$page->add($menu);
$page->endPanel('menu');

?>
