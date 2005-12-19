<?php
$page->startPanel('title', 'title');
$page->add('Thinkedit 2.0');
$page->endPanel('title');


$menu = '<a class="content" href="' . $url->render('content.php') . '">' . translate('content') . '</a>';
$menu .= ' | ';
$menu .= '<a class="structure" href="' . $url->render('structure.php') . '">' . translate('structure') . '</a>';
$menu .= ' | ';
$menu .= '<a class="files" href="' . $url->render('files.php') . '">' . translate('files') . '</a>';
$menu .= ' | ';
$menu .= '<a class="help" href="' . $url->render('help.php') . '">' . translate('help') . '</a>';

$page->startPanel('menu', 'menu');
$page->add($menu);
$page->endPanel('menu');

?>
